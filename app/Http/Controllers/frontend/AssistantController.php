<?php



namespace App\Http\Controllers\frontend;



use Illuminate\Http\Request;

use App\Customer;

use Config;

use Session;

use Image;

use App\Helpers\CustomerHelper;

use App\Helpers\Helper;

use App\AssistantBoyBooking;

use App\AssistantFwrdBooking;

use App\Reason;


use Illuminate\Support\Facades\DB;
use Mail;
use App\CustomerPrescription;
use App\AssistantReview;
use App\VendorPrescription;
use App\VendorInvoice;
use App\BookingCommision;
use Auth;
use App\OrderMedmate;
use App\VendorRelatedPincode;
use App\PaymentRequest;
use App\Coupon;


class AssistantController extends \App\Http\Controllers\Controller {



    public function myaccount() {

        return view('frontend-source.customer-dashboard.dashboard');

    }



    public function userProfile(){

        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();

        $meta = json_decode($data->meta, true);

        return view('frontend-source.customer-dashboard.user-profile', ['account_prefix' => $account_prefix, 'data' => $data, 'meta' => $meta]);

    }
    public function addReferance(Request $request){
        $is_admin = @Auth::user();
        $input_data = $request->all();
        $referance_data = [];

        unset($input_data['_token']);
        if($is_admin){
            unset($input_data['cus_id']);
            $data = Customer::select('id','meta')->where('id', '=', $request->cus_id)->first();
        }else{
            $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
            $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        }

        $decode_data = json_decode($data->meta, true);
        $req_data = $decode_data;
        if(isset($req_data['referance_list'])){
        $referance_data = json_decode($req_data['referance_list'],true);
        }
        $referance_data[] = $input_data;
        $req_data['referance_list'] = json_encode($referance_data);

        

        //$update = Customer::find($request->cus_id);

        $data->meta = json_encode($req_data);

        $data->save();

        $leveltitle = \Lang::get('leveltitle');
        $decode_data = json_decode($data->meta, true);
        
        if(isset($decode_data['referance_list'])){
            $referance_data = json_decode($decode_data['referance_list'],true);
        }

        if($data){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Referance added successfully', 
                'data' => $referance_data,
                 'ref_title' => $leveltitle
                  ]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }
    }
    public function removeReferance(Request $request,$id){
        
        $referance_data = [];

        
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();

        $decode_data = json_decode($data->meta, true);
        $req_data = $decode_data;
        if(isset($req_data['referance_list'])){
        $referance_data1 = json_decode($req_data['referance_list'],true);
        }
        
        array_splice($referance_data1, $id, 1);
        $referance_data = array_values($referance_data1);
        $req_data['referance_list'] = json_encode($referance_data);

        //dd($referance_data);

        $update = Customer::find(Session::get('userId'));

        $update->meta = json_encode($req_data);

        $update->save();

        $leveltitle = \Lang::get('leveltitle');
        $decode_data = json_decode($update->meta, true);
        
        if(isset($decode_data['referance_list'])){
            $referance_data = json_decode($decode_data['referance_list'],true);
        }

        if($update){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Referance Remove successfully', 
                'data' => $referance_data,
                 'ref_title' => $leveltitle
                  ]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }
    }


    public function updateUserProfile(Request $request)

    {
        $this->validate(
            $request, [
            
            'email' => 'required|email|unique:customers,email,'. Session::get('userId')
            
            ]
        );

        $req_data = $request->all();

        unset($req_data['_token']);

        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $list_of_pincodes = $req_data['list_of_pincodes'];

        $req_data['list_of_pincodes'] = trim(implode(',', $req_data['list_of_pincodes']),',');
        $req_data['available'] = trim(implode(',', $req_data['available']),',');

        if ($request->has('only_photo')){

            $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
                $decode_data = json_decode($data->meta, true);

            if($request->hasFile('photo')) {
                $config = CustomerHelper::configData('user_config');
                $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
                $size_explode = explode('*', $profile_img_size);
                $img_width = $size_explode[0];
                $img_height = $size_explode[1];

            
                //upload Image
                $photo = bcrypt(date('dmy').time().$decode_data['first_name']);
                $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('photo')->getClientOriginalExtension();

                $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);
                $photo_img->save(public_path() . '/assistant/' . $res_photo);
                $req_data = $decode_data;
                $req_data['photo'] = $res_photo;

                
                $updateDetails = [
                    'meta' => json_encode($req_data)
                ];
                $update = Customer::find(Session::get('userId'))->update($updateDetails);
                if($update){
                    return redirect($account_prefix.'/my-profile')->with('success', "Your profile Photo has been successfully updated")->with('account', Config::get('constants.accountType.user'));
                } else {
                    return redirect($account_prefix.'/my-profile')->with('error', "Something went wrong !")->with('account', Config::get('constants.accountType.user'));
                }
            }else{
                return redirect($account_prefix.'/my-profile');
            }
        }


        $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();

        $decode_data = json_decode($data->meta, true);

        

        //Upload photo

        if($request->hasFile('photo')){

            $config = CustomerHelper::configData('assistant_config');

            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;

            $size_explode = explode('*', $profile_img_size);

            $img_width = $size_explode[0];

            $img_height = $size_explode[1];

            

            //            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {

            //                $img_path= public_path('assistant/' . $decode_data['photo']);

            //                if (file_exists($img_path)) {

            //                    unlink($img_path);

            //                }

            //            }

            //upload Image

            $photo = bcrypt(date('dmy').time().$request->input('first_name'));

            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('photo')->getClientOriginalExtension();



            $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);

            $photo_img->save(public_path() . '/assistant/' . $res_photo);

            $req_data['photo'] = $res_photo;

        }else{

            $req_data['photo'] = $decode_data['photo'] ?? null;

        }
        $req_data['referance_list'] = $decode_data['referance_list'] ?? null;


        //Upload identity information

        if($request->hasFile('identity_information')){

            $config = CustomerHelper::configData('assistant_config');

            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;

            $size_explode = explode('*', $profile_img_size);

            $img_width = $size_explode[0];

            $img_height = $size_explode[1];

            if (isset($decode_data['identity_information']) && !empty($decode_data['identity_information'])) {

                $img_path= public_path('identity_information/' . $decode_data['identity_information']);

                if (file_exists($img_path)) {

                    unlink($img_path);

                }

            }

            //upload Image

            $identity_information = bcrypt(date('dmy').time().$request->input('last_name'));

            $res_identity_information = preg_replace("/[^A-Za-z0-9\-]/", "", $identity_information).'.'.$request->file('identity_information')->getClientOriginalExtension();



            $identity_information_img = Image::make($request->file('identity_information')->getRealPath())->resize($img_width, $img_height);

            $identity_information_img->save(public_path() . '/assistant/' . $res_identity_information);

            $req_data['identity_information'] = $res_identity_information;

        }else{

            $req_data['identity_information'] = $decode_data['identity_information'] ?? null;

        }


        if($req_data['dob']){
            $bday = Date('Y-m-d',strtotime($req_data['dob']));
           
            $req_data['age']= $years = \Carbon\Carbon::parse($bday)->age;
        }

        if($req_data['service_provided_type']){
            if($req_data['service_provided_type']=='Day'){
                $booking_type = 1;
            }else
            if($req_data['service_provided_type']=='Night'){
                $booking_type = 2;
            }else
            if($req_data['service_provided_type']=='Day & Night'){
                $booking_type = 3;
            }else
            {
                $booking_type = 4;
            }
        }

        $updateDetails = [

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'meta' => json_encode($req_data),
            'pincode' => $req_data['pincode'],
            'is_profile_setup' => 1,
            'booking_type' => $booking_type

        ];
        //dd($updateDetails);

        $update = Customer::find(Session::get('userId'))->update($updateDetails);

        VendorRelatedPincode::where('vendor_id',Session::get('userId'))->delete();
        foreach($list_of_pincodes as $pincode){
            $pincodevendor = new VendorRelatedPincode();
            $pincodevendor->vendor_id = Session::get('userId');
            $pincodevendor->pincode = $pincode;
            $pincodevendor->save();
        }

        if($update){

            return redirect($account_prefix.'/dashboard')->with('success', "Your profile has been successfully updated")->with('account', Config::get('constants.accountType.assistant'));

        } else {

            return redirect($account_prefix.'/dashboard')->with('error', "Something went wrong !")->with('account', Config::get('constants.accountType.assistant'));

        }

    }

    

    public function onlineStatus(Request $request){

        $update_status = Customer::where('id', Session::get('userId'))->update(['online_status' => $request->online_status]);

        if($update_status){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Your profile successfully updated']);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }

    }



    public function bookings() {

        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $booking = AssistantBoyBooking::where('assistant_boy_id', Session::get('userId'))->orderBy('id', 'DESC')->get();
        $curbooking = AssistantBoyBooking::where('assistant_boy_id', Session::get('userId'))->orderBy('id', 'DESC')->whereIN('booking_status',[2,3])->first();

        

        $medicalmate_fwrd_reasons = CustomerHelper::getReasons(Session::get('accountId'), 'forwarding');

        $fwrd_reasons             = json_decode($medicalmate_fwrd_reasons->reasons,true);

        //dd(Session::get('accountId'));

        return view('frontend-source.customer-dashboard.assistant.bookings', ['account_prefix' => $account_prefix, 'data' => $booking,'curbooking' => $curbooking, 'fwrd_reasons' => $fwrd_reasons]);

    }

    public function coupon() {

        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $booking = Coupon::where('account_id', Session::get('accountId'))->orderBy('id', 'DESC')->get();
        $curbooking = AssistantBoyBooking::where('assistant_boy_id', Session::get('userId'))->orderBy('id', 'DESC')->whereIN('booking_status',[2,3])->first();

        

        $medicalmate_fwrd_reasons = CustomerHelper::getReasons(Session::get('accountId'), 'forwarding');

        $fwrd_reasons             = json_decode($medicalmate_fwrd_reasons->reasons,true);
        //$booking = DB::table('coupons')->where('account_id', Session::get('userId'))->get();

       // dd($booking);

        return view('frontend-source.customer-dashboard.assistant.coupon', ['account_prefix' => $account_prefix, 'data' => $booking,'curbooking' => $curbooking, 'fwrd_reasons' => $fwrd_reasons]);

    }



    public function bookingsDetails($bookingId) {

        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $data = AssistantBoyBooking::with('FwrdData','reviewData','assistantData')->where('booking_id',$bookingId)->first();

        if($data->book_date){
            $time_arr = $data->arrival_time ? $data->arrival_time :'00:00';
            $booking_date_time = \Carbon\Carbon::parse($data->book_date.' '.$time_arr);
            $now = \Carbon\Carbon::now();

            $booking_date_time_diff = $now->diffInDays($booking_date_time);
        }else{
            $booking_date_time_diff='';
            $booking_date_time = "";
        }
        //dd($booking_date_time_diff);
        $medmate = OrderMedmate::where('booking_id',$bookingId)->where('medmate_id', Session::get('userId'))->first();

        if(!empty($data->assistant_boy_id) && $data->assistant_boy_id!=Session::get('userId')){
            return redirect()->to('/assistant/booking-request');
        }
        
        $prescription = CustomerPrescription::where('order_id',$bookingId)->first();

        $medicalmate_fwrd_reasons = CustomerHelper::getReasons(Session::get('accountId'), 'forwarding');

        $fwrd_reasons             = json_decode($medicalmate_fwrd_reasons->reasons,true);

         $assistant_data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Config::get('constants.accountType.assistant')]])->first();
        //dd($data);
        $price = $data->total_price + $data->pickup_price;
        $desc = json_encode([
            "next_url" => "/assistant/bookings/".$bookingId,
            "booking_id" => $bookingId,
            "type" => "Service Close",
            "price" => $price
        ]);

    
        $booking_desc = CustomerHelper::setdataencrypt($desc);
        
        if($data->booking_type=='serial'){
            return view('frontend-source.customer-dashboard.assistant.booking-details-serial', ['account_prefix' => $account_prefix, 'value' => $data, 'fwrd_reasons' => $fwrd_reasons,'prescription' => $prescription , 'assistant' => $assistant_data,'booking_date_time'=>$booking_date_time,'booking_desc'=>$booking_desc,'amount'=>$price]);
        }else if($data->booking_type=='fullbook' && !$data->assistant_boy_id){

            return view('frontend-source.customer-dashboard.assistant.booking-details-direct', ['account_prefix' => $account_prefix, 'value' => $data, 'fwrd_reasons' => $fwrd_reasons,'prescription' => $prescription , 'assistant' => $assistant_data,'medmate' => $medmate,'booking_date_time'=>$booking_date_time,'booking_desc'=>$booking_desc,'amount'=>$price]);

        }else{
            return view('frontend-source.customer-dashboard.assistant.booking-details', ['account_prefix' => $account_prefix, 'value' => $data, 'fwrd_reasons' => $fwrd_reasons,'prescription' => $prescription,'booking_date_time'=>$booking_date_time,'booking_desc'=>$booking_desc,'amount'=>$price]);
        }

    }



    public function acceptBooking(Request $request){

        //dd($request->all());

        $update_status = AssistantBoyBooking::where('booking_id', $request->dataId)->update(['booking_status' => 2]);



        $det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta')->where('booking_id', $request->dataId)->first();

        $customer_det = json_decode($det->customer_meta,true);

        $assistant_boy_det = json_decode($det->assistant_boy_meta,true);

        //Send to email

        $data = array(

            'subject' => 'Booking id ' . $request->dataId . ' Confirmed',

            'email' => $customer_det['patient_email'],

            'customer_det' => $customer_det,

            'assistant_boy_det' => $assistant_boy_det,

            'booking_id' => $request->dataId,

            'logo_url' => env('LOGO_URL'),

        );
        if(env('APP_ENV')!='local'){
            $email = Mail::send('frontend-source.emails.booking-confirm', compact('data'), function($message) use ($data) {

                $message->to($data['email']);

                $message->subject($data['subject']);

                $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);

            });
        }

        if($update_status){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully accepted<br>Booking ID: '.$request->dataId]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }

    }



    public function forwardBooking(Request $request){

        //dd($request->all());

        //DB::enableQueryLog();

        $bk_assistant_data = AssistantBoyBooking::select('id','assistant_boy_id','assistant_boy_meta','customer_meta','book_date','booking_id','booking_status','arrival_time','pickup_status','arrival_km','booking_criteria','total_price')->where([['assistant_boy_id', '=', Session::get('userId')],['booking_id', '=', $request->booking_id],['booking_status', '=', 1]])->first();

        //dd(DB::getQueryLog());

        $bk_decode_assistant_data = json_decode($bk_assistant_data->assistant_boy_meta,true);

        $bk_service_area = $bk_decode_assistant_data['service_area'];



        //DB::enableQueryLog();

        $find_fwrd_assistant = AssistantFwrdBooking::where([['booking_id', '=', $bk_assistant_data->id]])->get();

        //dd(DB::getQueryLog());

        $fwrd_assistant_ids = [];

        foreach($find_fwrd_assistant as $fwrdKey=>$fwrdVal){

            if(!in_array($fwrdVal['assistant_boy_fwrd_to_id'], $fwrd_assistant_ids, true)){

                array_push($fwrd_assistant_ids, $fwrdVal['assistant_boy_fwrd_to_id']);

            }



            if(!in_array($fwrdVal['assistant_boy_fwrd_from_id'], $fwrd_assistant_ids, true)){

                array_push($fwrd_assistant_ids, $fwrdVal['assistant_boy_fwrd_from_id']);

            }

        }



        //echo "<pre>";

        //print_r($fwrd_assistant_ids); exit;

        //DB::enableQueryLog();

        $get_all_assistant = Customer::select('id','meta')->where([['account_id', '=', Session::get('accountId')],['status', '=', 1],['online_status', '=', 1],['admin_status', '=', 1]])->whereNotIn('id',$fwrd_assistant_ids)->get();

        //dd(DB::getQueryLog());



        //dd($get_all_assistant); exit;

        $sm_area_assistant = [];

        $sm_assistant_ids = [];

        foreach($get_all_assistant as $key=>$val){

            $assistant_meta = CustomerHelper::decodeAssistantData(json_decode($val['meta'], true));

            $pickup_status = 0;

            if($bk_assistant_data->pickup_status && isset($assistant_meta['is_bike']) && $assistant_meta['is_bike']){

                $pickup_status = 1;

            }

            if($assistant_meta['service_area'] == $bk_service_area && $val['id'] != $bk_assistant_data->assistant_boy_id && $pickup_status == $bk_assistant_data->pickup_status){

                if($bk_assistant_data->booking_criteria == 1) {

                    $assistant_price = $assistant_meta['day_charges'];

                } elseif($bk_assistant_data->booking_criteria == 2) {

                    $assistant_price = $assistant_meta['night_charges'];

                } else {

                    $assistant_price = $assistant_meta['day_charges'] + $assistant_meta['night_charges'];

                }

                

                if($bk_assistant_data->pickup_status){

                    $explode_arrival = explode('-', $bk_assistant_data->arrival_km);

                    $assistant_price = $assistant_price+(($explode_arrival[0]+Config::get('constants.distanceKm'))*$assistant_meta['per_km_harges']);

                }

        

                if($bk_assistant_data->total_price == $assistant_price){

                    $check_book_date = AssistantBoyBooking::where([['assistant_boy_id', '=', $val['id']],['book_date', '=', $bk_assistant_data->book_date]])->count();

                    if(empty($check_book_date)){

                        $sm_area_assistant[$key]['assistant_id'] = $val['id'];

                        $sm_area_assistant[$key]['assistant_meta'] = $assistant_meta;

                        array_push($sm_assistant_ids,$val['id']);

                    }

                }

            }

        }

        //echo "<pre>";

        //print_r($sm_assistant_ids); exit;

        if(count($sm_assistant_ids)){

            $rand_key = array_rand($sm_assistant_ids,1);

            $assistant_boy_fwrd_to_id = $sm_assistant_ids[$rand_key];

            $assistant_boy_fwrd_to_meta = [];

            foreach($sm_area_assistant as $smMetaKey => $smMetaVal){

                if($smMetaVal['assistant_id'] == $assistant_boy_fwrd_to_id){

                    array_push($assistant_boy_fwrd_to_meta, $smMetaVal['assistant_meta']);

                }

            }



            $fwrd_data['booking_id'] = $bk_assistant_data->id;

            $fwrd_data['assistant_boy_fwrd_from_id'] = $bk_assistant_data->assistant_boy_id;

            $fwrd_data['assistant_boy_fwrd_from_meta'] = $bk_assistant_data->assistant_boy_meta;

            $fwrd_data['assistant_boy_fwrd_comment'] = $request->assistant_boy_fwrd_comment;

            $fwrd_data['assistant_boy_fwrd_to_id'] = $assistant_boy_fwrd_to_id;

            $fwrd_data['assistant_boy_fwrd_to_meta'] = json_encode($assistant_boy_fwrd_to_meta[0]);

            $fwrd_customer = AssistantFwrdBooking::create($fwrd_data);

            if($fwrd_customer){

                if($bk_assistant_data->booking_criteria == 1){

                    $price = $assistant_boy_fwrd_to_meta[0]['day_charges'];

                } elseif($bk_assistant_data->booking_criteria == 2){

                    $price = $assistant_boy_fwrd_to_meta[0]['night_charges'];

                } else {

                    $price = $assistant_boy_fwrd_to_meta[0]['day_charges'] + $assistant_boy_fwrd_to_meta[0]['night_charges'];

                }

                $update_assistant_data = [

                    'assistant_boy_id' => $assistant_boy_fwrd_to_id,

                    'assistant_boy_meta' => json_encode($assistant_boy_fwrd_to_meta[0]),

                    'total_price' => $price,

                    'grand_price' => $price

                ];

                $update_assistant = AssistantBoyBooking::where('id', $bk_assistant_data->id)->update($update_assistant_data);

                if($update_assistant){

                    //Email code here

                    //Assistant Email

                    $assistant_config = CustomerHelper::configData('assistant_config');

                    $data = array(

                        'subject' => 'New Forward Booking Request #' . $bk_assistant_data->booking_id,

                        'email' => $assistant_boy_fwrd_to_meta[0]['email'],

                        'assistant_from_meta' => json_decode($bk_assistant_data->assistant_boy_meta, true),

                        'customer_meta' => json_decode($bk_assistant_data->customer_meta, true),

                        'forward_reasons' => $request->assistant_boy_fwrd_comment,

                        'booking_id' => $bk_assistant_data->booking_id,

                        'book_date' => $bk_assistant_data->book_date,

                        'arrival_time' => $bk_assistant_data->arrival_time,

                        'pickup_status' => $bk_assistant_data->pickup_status,

                        'auto_forward_request' =>  $assistant_config['auto_forward_request'],

                        'logo_url' => env('LOGO_URL'),

                    );
                    if(env('APP_ENV')!='local'){
                        $email = Mail::send('frontend-source.emails.assistant-forward-booked', compact('data'), function($message) use ($data) {

                            $message->to($data['email']);

                            $message->subject($data['subject']);

                            $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);

                        });
                    }

                    //End email function



                    return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully Forwarded<br>Booking ID: '.$bk_assistant_data->booking_id]);

                } else {

                    return response()->json(['code' => 201, 'response' => "ERROR", 'message' => 'Assistant not updated']);

                }

            } else {

                return response()->json(['code' => 202, 'response' => "ERROR", 'message' => 'Forwarded data not inserted']);

            }

        } else {

            //Admin forward

            $admin_info = Helper::adminInfo();

            $admin_meta['name'] = $admin_info->name;

            $admin_meta['email'] = $admin_info->email;

            $admin_meta['photo'] = env('LOGO_URL');



            $fwrd_data['booking_id'] = $bk_assistant_data->id;

            $fwrd_data['assistant_boy_fwrd_from_id'] = $bk_assistant_data->assistant_boy_id;

            $fwrd_data['assistant_boy_fwrd_from_meta'] = $bk_assistant_data->assistant_boy_meta;

            $fwrd_data['assistant_boy_fwrd_comment'] = $request->assistant_boy_fwrd_comment;

            $fwrd_data['assistant_boy_fwrd_to_id'] = null;

            $fwrd_data['assistant_boy_fwrd_to_meta'] = json_encode($admin_meta);

            $fwrd_customer = AssistantFwrdBooking::create($fwrd_data);

            if($fwrd_customer){

                $update_assistant_data = [

                    'assistant_boy_id' => null,

                    'assistant_boy_meta' => json_encode($admin_meta),

                    'total_price' => '0.00',

                    'grand_price' => '0.00',

                    'fwrd_status' => 1

                ];

                $update_assistant = AssistantBoyBooking::where('id', $bk_assistant_data->id)->update($update_assistant_data);

                if($update_assistant){

                    //Email code here

                    $assistant_config = CustomerHelper::configData('assistant_config');

                    $data = array(

                        'subject' => 'New Forward Booking Request #' . $bk_assistant_data->booking_id,

                        'email' => $admin_meta['email'],

                        'assistant_from_meta' => json_decode($bk_assistant_data->assistant_boy_meta, true),

                        'customer_meta' => json_decode($bk_assistant_data->customer_meta, true),

                        'forward_reasons' => $request->assistant_boy_fwrd_comment,

                        'booking_id' => $bk_assistant_data->booking_id,

                        'book_date' => $bk_assistant_data->book_date,

                        'arrival_time' => $bk_assistant_data->arrival_time,

                        'pickup_status' => $bk_assistant_data->pickup_status,

                        'auto_forward_request' =>  $assistant_config['auto_forward_request'],

                        'logo_url' => env('LOGO_URL'),

                    );
                    if(env('APP_ENV')!='local'){
                    $email = Mail::send('frontend-source.emails.assistant-forward-admin-booked', compact('data'), function($message) use ($data) {

                        $message->to($data['email']);

                        $message->subject($data['subject']);

                        $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);

                    });
                    }

                    //End email function

                    return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully Forwarded<br>Booking ID: '.$bk_assistant_data->booking_id]);

                } else {

                    return response()->json(['code' => 201, 'response' => "ERROR", 'message' => 'Assistant not updated']);

                }

            } else {

                return response()->json(['code' => 202, 'response' => "ERROR", 'message' => 'Forwarded data not inserted']);

            }

        }

    }

    public function prescriptionDetails($orderId){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        //$data               = CustomerPrescription::where([['customer_id', '=', Session::get('userId')],['order_id', '=', $orderId]])->first();
        $data = CustomerPrescription::with('booking','vendorprescriptions')->where('order_id', '=', $orderId)->first();
        if($data->customer_status==3){
            Session::put('check_prescription_status',4);
        }else
        if($data->vendorprescriptions->where('status',4)->first()){
            Session::put('check_prescription_status',3);
        }elseif($data->vendorprescriptions->where('status',1)->first()){
            Session::put('check_prescription_status',2);
        }elseif(!$data->vendorprescriptions->where('status',1)->first()){
            Session::put('check_prescription_status',1);
        }
        $value = AssistantBoyBooking::with('FwrdData','reviewData')->where('booking_id',$orderId)->first();
        $prescription_photo = asset('prescription/'. $data['prescription_photo']);
        if(empty($data['prescription_photo']) || !file_exists(public_path('prescription/'. $data['prescription_photo']))){
            $prescription_photo = null;
        }
        $medicines          = json_decode($data->medicine, true);
        $delivery_address   = json_decode($data->delivery_address, true);
        //dd($medicines);
        //dd($data);
        return view('frontend-source.customer-dashboard.assistant.prescription-details', ['account_prefix' => $account_prefix,'value' => $value, 'data' => $data, 'prescription_photo' => $prescription_photo, 'medicines' => $medicines, 'delivery_address' => $delivery_address]);
    }

    public function statusChange(Request $request,$status,$vendor_id,$id){
            $prescription = CustomerPrescription::where('order_id',$id)->first();
            //$vendor_id = $prescription->customer_id;
            $prescription_id = $prescription->id;
            if($status==2){
                $prescription->customer_status = $status;
                $prescription->is_vendor_assigned =1;
                $prescription->save();
                
                $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('vendor_id',$vendor_id)->first();
                $VendorPrescriptionexist->status=4;
                
                $VendorPrescriptionexist->save();
                return back()->with('success', 'Request Processed successfully');;
            }
            
            if($status==3){
                $prescription->is_vendor_assigned =0;
                $prescription->save();
                $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('vendor_id',$vendor_id)->first();
                $VendorPrescriptionexist->status=2;
                $VendorPrescriptionexist->save();
                VendorPrescription::where('prescription_id',$prescription_id)->where('status',3)->update(['status'=> 0]);
                return back()->with('success', 'Request Cancel successfully');;
            }
            //directprescription upload
            if($status==4){
                $prescription->customer_status = 9;
                $prescription->save();
                
                return back()->with('success', 'Request Send to Vendor successfully');;
            }
            
    }

    public function createInvoice($order_id){
        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
            //$vendor_id = $prescription->customer_id;
            $prescription_id = $prescription->id;
        $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('status',4)->first();
        $vendor_id = $VendorPrescriptionexist->vendor_id;
        $vendor = Customer::where('account_id',4)->where('id',$vendor_id)->first();
        $customer = AssistantBoyBooking::where('booking_id',$order_id)->first();
        $vendorDetails = json_decode($vendor->meta);
        $medicines          = json_decode($prescription->medicine, true);
        $customer_address   = json_decode($customer->customer_meta, true);
        
        $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();
        //dd($vendorDetails);
        return view('frontend-source.customer-dashboard.assistant.create-invoice',compact('vendor','vendorDetails','prescription','allmedicines','medicines','customer_address','VendorPrescriptionexist'));
    }

    public function downloadInvoice(Request $request,$order_id){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
            //$vendor_id = $prescription->customer_id;
            $prescription_id = $prescription->id;
        $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('status',4)->first();
        if(!$VendorPrescriptionexist){
            $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('payment_status',1)->first();
        }
        if(!$VendorPrescriptionexist){
            if($request->segment(2)=='download-uploadprescription-invoice'){
               return redirect()->to('/assistant/uploadprescription/'.$order_id);
            }else{
                return redirect()->to('/assistant/bookings/'.$order_id);
            }
        }
        $vendor_id = $VendorPrescriptionexist->vendor_id;
        $vendor = Customer::where('account_id',4)->where('id',$vendor_id)->first();
        $customer = AssistantBoyBooking::where('booking_id',$order_id)->first();
        $vendorDetails = json_decode($vendor->meta);
        $medicines          = json_decode($prescription->medicine, true);
        $customer_address   = json_decode($customer->customer_meta, true);
        
        $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();
        //dd($vendorDetails);
        return view('frontend-source.customer-dashboard.assistant.view-invoice',compact('vendor','vendorDetails','prescription','allmedicines','medicines','customer_address','account_prefix','VendorPrescriptionexist','customer'));
    }

    public function cancelBooking(Request $request) {
        //dd($request->all());
        $cancel_booking = CustomerPrescription::where('order_id', $request->booking_id)->update(['customer_status' => 0]);;
        if ($cancel_booking) {
            
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully cancelled your booking','order_id'=> $request->booking_id]);
            
        } else {
            return response()->json(['code' => 205, 'response' => "ERROR", 'message' => 'Please try again!']);
        }
    }
    public function cancelPrescription(Request $request){
        $cancel_booking = CustomerPrescription::where('order_id', $request->booking_id)->first();
        $cancel_booking->customer_status = 0;
        $cancel_booking->save();
        $data = VendorPrescription::where('vendor_id', $request->vendor_id)->where('prescription_id', $cancel_booking->id)->update(['cancel_reason' => $request->cancel_reason]);
        if ($cancel_booking) {
            
            return redirect('assistant/bookings/'.$request->booking_id)->with(['message' => 'You have successfully cancelled your booking']);
            
        } else {
            return back()->with(['message' => 'Please try again!']);
            
        }

    }

    public function paymentPrescription(Request $request){
        //dd($request->all());
        $order_id = $request->booking_id;
        $cancel_booking = CustomerPrescription::with('booking')->where('order_id', $request->booking_id)->first();
       
        if ($request->hasFile('file')) {
            $photo = bcrypt(date('dmy') . time());
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo) . '.' . $request->file('file')->getClientOriginalExtension();
            
            $request->file('file')->move(public_path('/paymentreceipt/'), $res_photo);
        } else {
            $res_photo = null;
        }

        $data = VendorPrescription::where('vendor_id', $request->vendor_id)->where('prescription_id', $cancel_booking->id)->first();
        $data->payment_receipt = $res_photo;
        $data->payment_status = 1;
        $data->paid_amount = $request->total_amount;
        $data->status=5;
        $data->save();
        $user = Customer::find(Session::get('userId'));
        if($request->has('is_apply_coin')){
         $user->total_coin = $user->total_coin - $request->coin_amount;
         $user->save();
        }

         if($cancel_booking->booking){
            $Booking = AssistantBoyBooking::where('booking_id',$order_id)->first();
            $Booking->payment_receive_status =1;
            $Booking->save();
        }
        ///

         $total_price = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->sum('total_price');
         //dd($total_price);
        $admin_percent = 5;
        $medmate_percent = 3;
        $admin_amount = ($total_price*($admin_percent/100));
        $medmate_amount = ($admin_amount*($medmate_percent/100));
        //dd($admin_amount);
        $booking = new BookingCommision();
        $booking->booking_id = $order_id;
        $booking->admin_prcnt = $admin_percent;
        $booking->admin_amt = $admin_amount;
        $booking->vendor_id = $request->vendor_id;
        $booking->admin_id = 1;
        if($cancel_booking->booking){
            $booking->mademate_prcnt = $medmate_percent;
            $booking->mademate_amt = $medmate_amount;
            $booking->mademate_id = $Booking->assistant_boy_id;
        }
        $booking->save();
        
        
        //     $booking = new BookingCommision();
        //     $booking->booking_id = $order_id;
            
        //     $booking->save();
        // }
        
        if ($cancel_booking) {

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully payment Prescription', 'data' => $data]);
            
            // return redirect('assistant/bookings/'.$request->booking_id)->with(['message' => 'You have successfully payment Prescription ']);
            
        } else {
            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Data not found!']);
            //return back()->with(['message' => 'Please try again!']);
            
        }

    }

    public function onBusy(Request $request){

        $update_status = AssistantBoyBooking::where('id', $request->bookingId)->update(['booking_status' => 3]);

        if($update_status){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully Onbusy']);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }

    }

    public function startServiceBooking(Request $request){

        $det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta')->where('booking_id', $request->dataId)->first();

        $customer_det = json_decode($det->customer_meta,true);

        $assistant_boy_det = json_decode($det->assistant_boy_meta,true);

        //Send to email

        

        if(Session::get('otp')) {
                Session::forget('otp');
        }
        $otp = mt_rand(100000, 999999);
        Session::put('otp', $otp);
        //Send an email to the customer from the admin email address to confirm an email address.
        $data = array(
            'email' => $customer_det['patient_email'],
            'guest_name' => $customer_det['patient_name'],
            'subject' => 'OTP Verification',
            'logo_url' => env('LOGO_URL'),
            'otp' => $otp
        );
        //$email = true;
        // $email = Mail::send('frontend-source.emails.verification-code', compact('data'), function($message) use ($data) {
        //             $message->to($data['email']);
        //             $message->subject($data['subject']);
        //             $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
        //         });

        //if($email) {
            return response()->json(['code' => 200,'response' => "SUCCESS",'otp' => $otp, 'message' => "Verification code sent to ".$customer_det['patient_email']]);
        //}else{
            //return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Oops!! Verification code not sent"]);
        //}

    }

    public function otpVerifyBooking(Request $request){

        $booking = AssistantBoyBooking::where('booking_id', $request->booking_id)->first();

        $user = Customer::select('id','meta','pin')->where([['id', '=', $booking->customer_id]])->first();

        if($request->input('otp') != $booking->booking_pin) {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please enter valid OTP"]);
        }
        $update_status = AssistantBoyBooking::where('booking_id', $request->booking_id)->update(['booking_status' => 3,'service_start_time' => now()]);



        // $det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta')->where('booking_id', $request->dataId)->first();

        // $customer_det = json_decode($det->customer_meta,true);

        // $assistant_boy_det = json_decode($det->assistant_boy_meta,true);

        // //Send to email

        // $data = array(

        //     'subject' => 'Booking id ' . $request->dataId . ' Confirmed',

        //     'email' => $customer_det['patient_email'],

        //     'customer_det' => $customer_det,

        //     'assistant_boy_det' => $assistant_boy_det,

        //     'booking_id' => $request->dataId,

        //     'logo_url' => env('LOGO_URL'),

        // );

        // $email = Mail::send('frontend-source.emails.booking-confirm', compact('data'), function($message) use ($data) {

        //     $message->to($data['email']);

        //     $message->subject($data['subject']);

        //     $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);

        // });

        if($update_status){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Service started successfully againest <br>Booking ID: '.$request->booking_id]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }

    }

    public function deliveryBooking(Request $request,$order_id){
        //$order_id = $request->dataId;

        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
        $prescription->customer_status = '6';
        $prescription->save();
        return back();

        // if($update_status){

             // return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully Delivered<br>Booking ID: '.$request->dataId]);

        // } else {

        //     return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        // }

    }
    public function bookingSuccess($bookingId){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        if(!empty($bookingId)){
            $booking = AssistantBoyBooking::where('booking_id', $bookingId)->first();
            if(!empty($booking)){
                return view('frontend-source.customer-dashboard.assistant.booking-success', ['account_prefix' => $account_prefix, 'booking' => $booking]);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    public function addReview(Request $request){
        //Upload photo
        $bookingId =  $request->booking_id;
        $booking = AssistantBoyBooking::where('booking_id', $bookingId)->first();
        $rating = new AssistantReview();
        $rating->medmate_id = Session::get('userId');
        $rating->booking_id = $booking->id;
        $rating->pb_rating = $request->submit_star_pb_review;
        $rating->pc_rating = $request->submit_star_pc_review;
        $rating->pp_rating = $request->submit_star_pp_review;
        $rating->rating = $request->submit_star_review;

        $rating->save();
        $request->session()->flash('success', 'Review added successfully.');
        return redirect('assistant/bookings');
    }

    public function extendTimeBooking(Request $request){
        $booking = AssistantBoyBooking::where('booking_id', $request->booking_id)->first();
        $assistant_boy_det = json_decode($booking->assistant_boy_meta,true);
        //dd($assistant_boy_det);
        $booking->extend_hour = $booking->extend_hour+$request->extend_time;
        $booking->extend_amount = $booking->extend_amount+($request->extend_time*$assistant_boy_det['hourly_charges']);
        $booking->grand_price = $booking->grand_price+($request->extend_time*$assistant_boy_det['hourly_charges']);
        $booking->save();

        if($booking){

            return response()->json(['code' => 200,'order_id' =>$request->booking_id , 'response' => "SUCCESS", 'message' => 'Service Time Extend successfully againest <br>Booking ID: '.$request->booking_id]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }
    }

    public function ConfirmMessageBooking(Request $request){
        
        $booking = AssistantBoyBooking::where('booking_id', $request->booking_id)->first();
        $assistant_boy_det = json_decode($booking->assistant_boy_meta,true);
        if($request->message=='no'){
            $booking->assistant_boy_id = null;
            $booking->booking_status = 1;
            $booking->assistant_boy_meta = null;

        }
       
            $booking->confirm_message_assistant_boy = $request->message;
        
        $booking->save();

        if($booking){

            return response()->json(['code' => 200,'order_id' =>$request->booking_id , 'response' => "SUCCESS", 'message' => 'Service Time Extend successfully againest <br>Booking ID: '.$request->booking_id]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }
    }
    public function commision(Request $request){

        $commisionlist = BookingCommision::orderBy('id','DESC')
            ->where(function($query) use ($request){
                if($request->medmate){
                    $query->where('mademate_id', $request->medmate);
                }
            })->get();
        $users = Customer::where('account_id',2)->orderBy('first_name','ASC')->get();
        return view('frontend-source.customer-dashboard.assistant.commision',compact('commisionlist','users'));

    }
    public function PaymentRequestAdmin(Request $request){

        $booking_id_list = explode(',',$request->booking_ids);
        $total_amount = BookingCommision::whereIn('booking_id',$booking_id_list)->sum('mademate_amt');
        
        $payment = new PaymentRequest();
        $payment->to_user = 1;
        $payment->from_user = Session::get('userId');
        $payment->type = 'Admin';
        $payment->booking_ids = $request->booking_ids;
        $payment->total_amount = $total_amount;
        $payment->status = 'Request From Medmate';
        $payment->save();

        

        BookingCommision::whereIn('booking_id',$booking_id_list)->update(['status'=>'Request Sent']);
        return back();

    }
    public function serialBooking(Request $request){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $booking = AssistantBoyBooking::where('assistant_boy_id', Session::get('userId'))->where('booking_type','serial')->where('booking_status',5)->orderBy('id', 'DESC')->get();
        

        return view('frontend-source.customer-dashboard.assistant.serial-payment', ['account_prefix' => $account_prefix, 'data' => $booking]);

    }
    public function fullBooking(Request $request){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $booking = AssistantBoyBooking::where('assistant_boy_id', Session::get('userId'))->where('booking_type','fullbook')->where('booking_status',5)->orderBy('id', 'DESC')->get();
        

        return view('frontend-source.customer-dashboard.assistant.fullbook-payment', ['account_prefix' => $account_prefix, 'data' => $booking]);

    }

}

