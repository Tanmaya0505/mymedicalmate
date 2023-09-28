<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
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

use DB;

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
use App\BookingDeliveryRequest;
use Carbon\Carbon;

class DeliveryboyController extends Controller
{
    public function myaccount() {

        return view('frontend-source.customer-dashboard.dashboard');

    }



    public function userProfile(){

        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();

        $meta = json_decode($data->meta, true);

        return view('frontend-source.customer-dashboard.user-profile', ['account_prefix' => $account_prefix, 'data' => $data, 'meta' => $meta]);

    }

    public function updateUserProfile(Request $request)

    {   
        if (!$request->has('only_photo')){
            $this->validate(
                $request, [
                
                'email' => 'required|email|unique:customers,email,'. Session::get('userId')
                
                ]
            );
        }

        $req_data = $request->all();

        unset($req_data['_token']);

        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        

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
                $photo_img->save(public_path() . '/delivery-boy/' . $res_photo);
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

        $list_of_pincodes = $req_data['list_of_pincodes'];

        $req_data['list_of_pincodes'] = trim(implode(',', $req_data['list_of_pincodes']),',');
        $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();

        $decode_data = json_decode($data->meta, true);

        

        //Upload photo

        if($request->hasFile('photo')){

            $config = CustomerHelper::configData('assistant_config');

            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;

            $size_explode = explode('*', $profile_img_size);

            $img_width = $size_explode[0];

            $img_height = $size_explode[1];

            //upload Image

            $photo = bcrypt(date('dmy').time().$request->input('first_name'));

            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('photo')->getClientOriginalExtension();



            $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);

            $photo_img->save(public_path() . '/delivery-boy/' . $res_photo);

            $req_data['photo'] = $res_photo;

        }else{

            $req_data['photo'] = $decode_data['photo'] ?? null;

        }

        if($request->hasFile('bike_photo')){

            $config = CustomerHelper::configData('assistant_config');

            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;

            $size_explode = explode('*', $profile_img_size);

            $img_width = $size_explode[0];

            $img_height = $size_explode[1];

            //upload Image

            $photo = bcrypt(date('dmy').time().$request->input('first_name'));

            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('bike_photo')->getClientOriginalExtension();



            $photo_img = Image::make($request->file('bike_photo')->getRealPath())->resize($img_width, $img_height);

            $photo_img->save(public_path() . '/delivery-boy/' . $res_photo);

            $req_data['bike_photo'] = $res_photo;

        }else{

            $req_data['bike_photo'] = $decode_data['bike_photo'] ?? null;

        }

        if($request->hasFile('adhere_photo')){

            $config = CustomerHelper::configData('assistant_config');

            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;

            $size_explode = explode('*', $profile_img_size);

            $img_width = $size_explode[0];

            $img_height = $size_explode[1];

            //upload Image

            $photo = bcrypt(date('dmy').time().$request->input('first_name'));

            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('adhere_photo')->getClientOriginalExtension();



            $photo_img = Image::make($request->file('adhere_photo')->getRealPath())->resize($img_width, $img_height);

            $photo_img->save(public_path() . '/delivery-boy/' . $res_photo);

            $req_data['adhere_photo'] = $res_photo;

        }else{

            $req_data['adhere_photo'] = $decode_data['adhere_photo'] ?? null;

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

            $identity_information_img->save(public_path() . '/delivery-boy/' . $res_identity_information);

            $req_data['identity_information'] = $res_identity_information;

        }else{

            $req_data['identity_information'] = $decode_data['identity_information'] ?? null;

        }


        if($req_data['dob']){
            $bday = Date('Y-m-d',strtotime($req_data['dob']));
           
            $req_data['age']= $years = \Carbon\Carbon::parse($bday)->age;
        }

        

        $updateDetails = [

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'meta' => json_encode($req_data),
            'pincode' => $req_data['pincode'],
            'is_profile_setup' => 1

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
    public function bookings(Request $request){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        $bookings = BookingDeliveryRequest::with('booking')->where('delivery_id',Session::get('userId'))
        ->orderBy('id','DESC')
        ->get();

        return view('frontend-source.customer-dashboard.deliveryboy.bookings',compact('bookings','account_prefix'));
    }
    public function acceptBooking(Request $request){

        
        if($request->type==2){
            $status = 'Cancel';
        }else{
            $status = 'Accept';
        }
        $update_status = BookingDeliveryRequest::where('order_id', $request->dataId)
        ->where('status','<>','Cancel')
        ->where('delivery_id',Session::get('userId'))->update(['status' => $status]);

        if($request->type==1){
            $det = CustomerPrescription::where('order_id', $request->dataId)->first();
            $det->customer_status = 11;
            $det->save();

            $update_status_rest = BookingDeliveryRequest::where('order_id', $request->dataId)
            
            ->where('delivery_id','<>',Session::get('userId'))->update(['status' => 'Cancel']);

            
        }

        

        //Send to email

        // $data = array(

        //     'subject' => 'Booking id ' . $request->dataId . ' Confirmed',

        //     'email' => $customer_det['patient_email'],

        //     'customer_det' => $customer_det,

        //     'assistant_boy_det' => $assistant_boy_det,

        //     'booking_id' => $request->dataId,

        //     'logo_url' => env('LOGO_URL'),

        // );
        // if(env('APP_ENV')!='local'){
        //     $email = Mail::send('frontend-source.emails.booking-confirm', compact('data'), function($message) use ($data) {

        //         $message->to($data['email']);

        //         $message->subject($data['subject']);

        //         $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);

        //     });
        // }

        if($update_status){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully '.$status.'<br>Booking ID: '.$request->dataId]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }

    }
    public function bookingsDetails(Request $request,$bookingId){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        
        
        $prescription = CustomerPrescription::with('deliveryboy')->where('order_id',$bookingId)->first();

      
         $assistant_data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Config::get('constants.accountType.deliveryboy')]])->first();
        
            return view('frontend-source.customer-dashboard.deliveryboy.booking-details', ['account_prefix' => $account_prefix, 'prescription' => $prescription]);
        
    }

    public function deliveryBooking(Request $request,$order_id){
        //$order_id = $request->dataId;

        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
        $prescription->customer_status = '6';
        $prescription->save();
        
        $update_status = BookingDeliveryRequest::where('order_id', $order_id)
        ->where('status','Accept')
        ->where('delivery_id',Session::get('userId'))->update(['status' => 'Delivered','delivery_datetime'=>Carbon::now(),'delivery_commision_by_admin'=>20]);
        //return back();

        if($update_status){

             return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully Delivered<br>Booking ID: '.$request->dataId]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }

    }
}
