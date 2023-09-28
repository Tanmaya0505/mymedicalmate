<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Helpers\Helper;

use App\Customer;

use App\AccountType;

use Auth;

use DB;

use Mail;

use Image;

use App\Helpers\CustomerHelper;

use Config;



class CustomerController extends Controller {



    public function __construct() {

        $this->middleware('auth');

    }

    public function getUserList(){
        $customers = Customer::select('id',DB::raw("CONCAT(first_name, ' ', last_name) as name"))->get();
        return ['code'=> 200,'userlist' => $customers];
    }

    //Page account setting

    public function customerListing(Request $request) {

        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Customer listing"]

        ];

        $types = AccountType::get();

        $input_value = $request->all();

        $filters = [];

        $filters['admin_status'] = isset($input_value['admin_status']) ? $input_value['admin_status'] : '';

        $filters['status'] = isset($input_value['customer_status']) ? $input_value['customer_status'] : '';

        $filters['account_id'] = isset($input_value['account_type']) ? $input_value['account_type'] : '';

        

        //DB::enableQueryLog();

        $customers = Customer::with(['accountType'=>function($query){

            $query->select('id', 'account_name','account_name_slug');

        }])->where(function($query) use ($filters){

            foreach($filters as $column => $val){

                if($val != '') $query->where($column, $val);

            }

        })->get();

        //dd(DB::getQueryLog());

        //dd($customers);

        return view('pages.customer-listing', ['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'types' => $types, 'customers' => $customers]);

    }

    public function customerListingType(Request $request,$type){
        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Customer listing"]

        ];

        $types = AccountType::get();

        $input_value = $request->all();

        $filters = [];

        $filters['admin_status'] = isset($input_value['admin_status']) ? $input_value['admin_status'] : '';

        $filters['status'] = isset($input_value['customer_status']) ? $input_value['customer_status'] : '';

       // $filters['account_id'] = isset($input_value['account_type']) ? $input_value['account_type'] : '';

        

        //DB::enableQueryLog();
        if($type=='user'){
            $account_id=1;
        }     
        if($type=='medicalmate'){
            $account_id=2;
        } 
        if($type=='doctor'){
            $account_id=3;
        } 
        if($type=='vendor'){
            $account_id=4;
        }    

        $customers = Customer::with(['accountType'=>function($query){

            $query->select('id', 'account_name','account_name_slug');

        }])->where(function($query) use ($filters){

            foreach($filters as $column => $val){

                if($val != '') $query->where($column, $val);

            }

        })->where('account_id',$account_id)->get();

        //dd(DB::getQueryLog());

        //dd($customers);

        return view('pages.customer-listing-type', ['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'types' => $types, 'customers' => $customers]);
    }

    

    public function customerView($id){
        //dd(Auth::user()->user_role);
        $configData = CustomerHelper::configData('admin_config');

        $types = AccountType::get();

        $customer = Customer::with(['accountType'=>function($query){

            $query->select('id', 'account_name','account_name_slug');

        }])->where('id', $id)->first();

        $restricted_reason  = CustomerHelper::getReasons($customer->account_id, 'restricted');

        $restricted_msg     = $restricted_reason ? json_decode($restricted_reason->reasons,true) : [];

        $meta = [];

        $data = [];

        if(!empty($customer->account_id)){

            $meta = json_decode($customer->meta, true);

            if($customer->account_id == Config::get('constants.accountType.user')){

                $data = CustomerHelper::decodeUserData($meta);

            } elseif($customer->account_id == Config::get('constants.accountType.assistant')) {

                $data = CustomerHelper::decodeAssistantData($meta);

            } elseif($customer->account_id == Config::get('constants.accountType.doctor')) {

                $decode_data = CustomerHelper::decodeDoctorData($meta);

            } else {

                $decode_data = CustomerHelper::decodeVendorData($meta);

            }

        }

        return view('pages.customer-view', ['configData' => $configData, 'types' => $types, 'customer' => $customer,'restricted_msg' =>$restricted_msg, 'meta' => $meta,'data' => $data]);

    }

    

    public function updateCustomer(Request $request){

        $configData = CustomerHelper::configData('admin_config');

        $this->validate($request, [

            'first_name' => 'required|string|max:20',

            'last_name' => 'required|string|max:20',

        ]);

        

        $req_data = $request->all();

        unset($req_data['_token']);

        unset($req_data['id']);

        $customer = Customer::select('id','account_id','first_name','last_name','email','phone','meta')->where('id', $request->id)->first();

        $decode_data = json_decode($customer->meta, true);

        

        if($customer->account_id == Config::get('constants.accountType.user')){

            $config = CustomerHelper::configData('user_config');

            $decode_data = CustomerHelper::decodeUserData(json_decode($customer->meta, true));

            $img_storage_path = 'user/';

            $identity_information_storage_path = 'user_identity_information/';

        } elseif($customer->account_id == Config::get('constants.accountType.assistant')) {

            $config = CustomerHelper::configData('assistant_config');

            $decode_data = CustomerHelper::decodeAssistantData(json_decode($customer->meta, true));

            $img_storage_path = 'assistant/';

            $identity_information_storage_path = 'identity_information/';

        } elseif($customer->account_id == Config::get('constants.accountType.doctor')) {

            $config = CustomerHelper::configData('doctor_config');

            $decode_data = CustomerHelper::decodeDoctorData(json_decode($customer->meta, true));

            $img_storage_path = 'doctor/';

            $identity_information_storage_path = 'doctor_identity_information/';

        } else {

            $config = CustomerHelper::configData('vendor_config');

            $decode_data = CustomerHelper::decodeVendorData(json_decode($customer->meta, true));

            $img_storage_path = 'vendor/';

        }

        $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266*266;

        $size_explode = explode('*',$profile_img_size);

        $img_width = $size_explode[0];

        $img_height = $size_explode[1];

        

        //Upload photo

        if($request->hasFile('photo')){

//            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {

//                $img_path= public_path($img_storage_path . $decode_data['photo']);

//                if (file_exists($img_path)) {

//                    unlink($img_path);

//                }

//            }

            //upload Image

            $photo = bcrypt(date('dmy').time().$request->input('first_name'));

            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('photo')->getClientOriginalExtension();



            $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);

            $photo_img->save(public_path() . '/'. $img_storage_path . $res_photo);

            $req_data['photo'] = $res_photo;

        } else {

            $req_data['photo'] = $decode_data['photo'] ?? null;

        }
        $req_data['referance_list'] = $decode_data['referance_list'] ?? null;
        

        //Upload identity information

        if($request->hasFile('identity_information')){

            if (isset($decode_data['identity_information']) && !empty($decode_data['identity_information'])) {

                $img_path= public_path($identity_information_storage_path . $decode_data['identity_information']);

                if (file_exists($img_path)) {

                    unlink($img_path);

                }

            }

            //upload Image

            $identity_information = bcrypt(date('dmy').time().$request->input('last_name'));

            $res_identity_information = preg_replace("/[^A-Za-z0-9\-]/", "", $identity_information).'.'.$request->file('identity_information')->getClientOriginalExtension();



            $identity_information_img = Image::make($request->file('identity_information')->getRealPath())->resize($img_width, $img_height);

            $identity_information_img->save(public_path() . '/'. $identity_information_storage_path . $res_identity_information);

            $req_data['identity_information'] = $res_identity_information;

        }else{

            $req_data['identity_information'] = $decode_data['identity_information'] ?? null;

        }
        

        

        $updateDetails = [

            'first_name'=> $request->first_name,

            'last_name' => $request->last_name,

            'email'     => $request->email,

            'phone'     => $request->phone,

            'status'    => $request->status,

            'restricted_reason' => $request->restricted_reason,

            'meta'      => json_encode($req_data)

        ];

        if(isset($request->admin_status)){

            $updateDetails['admin_status'] = $request->admin_status;

        }

        

        if($request->admin_status && $customer->account_id == Config::get('constants.accountType.assistant')){

            $data = array(

                'email' => $customer->email,

                'guest_name' => $customer->first_name . ' ' . $customer->last_name,

                'subject' => 'Verified by My medical Mate',

                'logo_url' => env('LOGO_URL')

            );


            if(env('APP_ENV')!='local'){
            Mail::send('frontend-source.emails.assistant-approval', compact('data'), function($message) use ($data) {

                $message->to($data['email']);

                $message->subject($data['subject']);

                $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);

            });
            }

        }

        $update = Customer::find($request->id)->update($updateDetails);

        if($update){

            return redirect($configData['route'].'/customer-listing/'.$request->id.'/view')->with('success', "Customer updated successfully");

        } else {

            return redirect($configData['route'].'/customer-listing/'.$request->id.'/view')->with('error', "Something went wrong !");

        }

    }

    

}

