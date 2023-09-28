<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Customer;
use Config;
use Session;
use Image;
use App\Helpers\Helper;
use App\Helpers\CustomerHelper;
use App\AssistantBoyBooking;
use App\AssistantCancelBooking;
use Mail;
use DB;
use App\AssistantReview;
use App\CustomerPrescription;
use Validator;
use App\VendorPrescription;
use App\AlltypeAd;
use App\VendorInvoice;
use App\BookingCommision;
use Carbon\Carbon;
use App\CoinTransfer;
use App\Coupon;
use App\ReferalBonus;

class UserController extends \App\Http\Controllers\Controller {

    public function myaccount() {
        return view('frontend-source.customer-dashboard.dashboard');
    }

    public function userProfile() {
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        $meta = json_decode($data->meta, true);
        return view('frontend-source.customer-dashboard.user-profile', ['account_prefix' => $account_prefix, 'data' => $data, 'meta' => $meta]);
    }
    public function patientDetails(){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        $meta = json_decode($data->meta, true);
        $meta['age'] = Carbon::parse($meta['dob'])->age;
        return response()->json(['code' => 200,'account_prefix' => $account_prefix, 'data' => $data, 'meta' => $meta]);
    }

    public function updateUserProfile(Request $request)
    {   
        $req_data = $request->all();
        //dd($req_data);
        $this->validate(
            $request, [
            
            'email' => 'required|email|unique:customers,email,'. Session::get('userId')
            
            ]
        );
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
                $photo_img->save(public_path() . '/user/' . $res_photo);
                $req_data = $decode_data;
                $req_data['photo'] = $res_photo;

                
                $updateDetails = [
                    'meta' => json_encode($req_data),
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





        if($req_data['gender'] ==1){
            $req_data['gender']="Male";
        }elseif($req_data['gender'] ==2){
            $req_data['gender']="Female";
        }elseif($req_data['gender'] ==3){
            $req_data['gender']="Others";
        }

        if($req_data['dob']){
            $bday = Date('Y-m-d',strtotime($req_data['dob']));
           
            $req_data['age']= $years = \Carbon\Carbon::parse($bday)->age;
        }
        $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        $decode_data = json_decode($data->meta, true);

        //Upload photo
        if ($request->hasFile('photo')) {
            $config = CustomerHelper::configData('user_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];

            //            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {
            //                $img_path= public_path('user/' . $decode_data['photo']);
            //                if (file_exists($img_path)) {
            //                    unlink($img_path);
            //                }
            //            }
            //upload Image
            $photo = bcrypt(date('dmy').time().$request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/user/' . $res_photo);
            $req_data['photo'] = $res_photo;
        }else{
            $req_data['photo'] = $decode_data['photo'] ?? null;
        }

        //Upload identity information
        if($request->hasFile('identity_information')){
            if (isset($decode_data['identity_information']) && !empty($decode_data['identity_information'])) {
                $img_path= public_path('user_identity_information/' . $decode_data['identity_information']);
                if (file_exists($img_path)) {
                    unlink($img_path);
                }
            }
            //upload Image
            $identity_information = bcrypt(date('dmy').time().$request->input('last_name'));
            $res_identity_information = preg_replace("/[^A-Za-z0-9\-]/", "", $identity_information).'.'.$request->file('identity_information')->getClientOriginalExtension();

            $identity_information_img = Image::make($request->file('identity_information')->getRealPath())->resize($img_width, $img_height);
            $identity_information_img->save(public_path() . '/user_identity_information/' . $res_identity_information);
            $req_data['identity_information'] = $res_identity_information;
        }else{
            $req_data['identity_information'] = $decode_data['identity_information'] ?? null;
        }

        $updateDetails = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'meta' => json_encode($req_data),
            'pincode' => $request->pincode,
        ];
       // dd($updateDetails);
        $update = Customer::find(Session::get('userId'))->update($updateDetails);
        if($update){
            return redirect($account_prefix.'/dashboard')->with('success', "Your profile has been successfully updated")->with('account', Config::get('constants.accountType.user'));
        } else {
            return redirect($account_prefix.'/dashboard')->with('error', "Something went wrong !")->with('account', Config::get('constants.accountType.user'));
        }
    }

    public function bookings() {
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $booking = AssistantBoyBooking::where('customer_id', Session::get('userId'))->orderBy('id', 'DESC')->get();
        //dd($booking);
        return view('frontend-source.customer-dashboard.user.bookings', ['account_prefix' => $account_prefix, 'data' => $booking]);
    }

    public function bookingsDetails($bookingId) {
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        //DB::enableQueryLog();
        $data = AssistantBoyBooking::with('FwrdData','reviewData','prescription')->where('booking_id',$bookingId)->first();
        //dd(DB::getQueryLog());
        //dd($data);
        $price = $data->total_price + $data->pickup_price;
        $desc = json_encode([
            "next_url" => "/user/bookings/".$bookingId,
            "booking_id" => $bookingId,
            "type" => "Service Close",
            "price" => $price
        ]);

    
        $booking_desc = CustomerHelper::setdataencrypt($desc);
        return view('frontend-source.customer-dashboard.user.booking-details', ['account_prefix' => $account_prefix, 'value' => $data,'booking_desc' => $booking_desc,'amount'=>$price]);
    }

    public function bookingInfo(Request $request) {
        $booking = AssistantBoyBooking::select('id', 'assistant_boy_meta', 'booking_id')->where([['customer_id', '=', Session::get('userId')], ['booking_id', '=', $request->dataId]])->first();
        if ($booking) {
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Data successfully fached', 'data' => $booking]);
        } else {
            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Data not found!']);
        }
    }

    public function cancelBooking(Request $request) {
        //dd($request->all());
        $cancel_booking = AssistantCancelBooking::create($request->all());
        if ($cancel_booking) {
            $update_status = AssistantBoyBooking::where('id', $request->booking_id)->update(['booking_status' => 4]);

            $det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta','booking_id','assistant_boy_id')->where('id', $request->booking_id)->first();
            $customer_det = json_decode($det->customer_meta,true);
            $assistant_boy_det = json_decode($det->assistant_boy_meta,true);
            //Send to email
            //User Email
            $data = array(
                'email' => $customer_det['patient_email'],
                'subject' => 'Booking Request Cancelled #' . $det->booking_id,
                'customer_det' => $customer_det,
                'assistant_boy_det' => $assistant_boy_det,
                'booking_id' => $request->dataId,
                'logo_url' => env('LOGO_URL'),
            );
            if(env('APP_ENV')!='local'){
                $email = Mail::send('frontend-source.emails.user-cancel-booking', compact('data'), function($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                    $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                });
            }

            //Assistant Email
            if($det->assistant_boy_id){
                $assistant_data = array(
                    'email' => $assistant_boy_det['email'],
                    'subject' => 'Booking Cancelled By User ' . $customer_det['patient_name'],
                    'customer_det' => $customer_det,
                    'assistant_boy_det' => $assistant_boy_det,
                    'cancel_reason' => $request->cancel_reason,
                    'booking_id' => $request->dataId,
                    'logo_url' => env('LOGO_URL'),
                );
                if(env('APP_ENV')!='local'){
                $assistant_email = Mail::send('frontend-source.emails.user-cancel-booking-assistant', compact('assistant_data'), function($message) use ($assistant_data) {
                    $message->to($assistant_data['email']);
                    $message->subject($assistant_data['subject']);
                    $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                });
                }
            }
            //Admin Email
            $admin_data = array(
                'subject' => 'Booking Cancelled By User ' . $customer_det['patient_name'],
                'customer_det' => $customer_det,
                'assistant_boy_det' => $assistant_boy_det,
                'cancel_reason' => $request->cancel_reason,
                'booking_id' => $request->dataId,
                'logo_url' => env('LOGO_URL'),
            );
            if(env('APP_ENV')!='local'){
            $admin_email = Mail::send('frontend-source.emails.user-cancel-booking-admin', compact('admin_data'), function($message) use ($admin_data) {
                $message->to(Helper::adminInfo()->email);
                $message->subject($admin_data['subject']);
                $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
            });
            }
            if ($update_status) {
                return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully cancelled your booking']);
            } else {
                return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);
            }
        } else {
            return response()->json(['code' => 205, 'response' => "ERROR", 'message' => 'Please try again!']);
        }
    }
    public function cancelPrescription(Request $request) {
        //dd($request->all());
        $cancel_booking = CustomerPrescription::where('order_id', $request->booking_id)->first();
        if ($cancel_booking) {
            $update_status = CustomerPrescription::where('order_id', $request->booking_id)->update(['customer_status' => 0]);

            // $det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta','booking_id','assistant_boy_id')->where('id', $request->booking_id)->first();
            // $customer_det = json_decode($det->customer_meta,true);
            // $assistant_boy_det = json_decode($det->assistant_boy_meta,true);
            //Send to email
            //User Email
            // $data = array(
            //     'email' => $customer_det['patient_email'],
            //     'subject' => 'Booking Request Cancelled #' . $det->booking_id,
            //     'customer_det' => $customer_det,
            //     'assistant_boy_det' => $assistant_boy_det,
            //     'booking_id' => $request->dataId,
            //     'logo_url' => env('LOGO_URL'),
            // );
            // if(env('APP_ENV')!='local'){
            //     $email = Mail::send('frontend-source.emails.user-cancel-booking', compact('data'), function($message) use ($data) {
            //         $message->to($data['email']);
            //         $message->subject($data['subject']);
            //         $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
            //     });
            // }

            //Assistant Email
            // if($det->assistant_boy_id){
            //     $assistant_data = array(
            //         'email' => $assistant_boy_det['email'],
            //         'subject' => 'Booking Cancelled By User ' . $customer_det['patient_name'],
            //         'customer_det' => $customer_det,
            //         'assistant_boy_det' => $assistant_boy_det,
            //         'cancel_reason' => $request->cancel_reason,
            //         'booking_id' => $request->dataId,
            //         'logo_url' => env('LOGO_URL'),
            //     );
            //     if(env('APP_ENV')!='local'){
            //     $assistant_email = Mail::send('frontend-source.emails.user-cancel-booking-assistant', compact('assistant_data'), function($message) use ($assistant_data) {
            //         $message->to($assistant_data['email']);
            //         $message->subject($assistant_data['subject']);
            //         $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
            //     });
            //     }
            // }
            //Admin Email
            // $admin_data = array(
            //     'subject' => 'Booking Cancelled By User ' . $customer_det['patient_name'],
            //     'customer_det' => $customer_det,
            //     'assistant_boy_det' => $assistant_boy_det,
            //     'cancel_reason' => $request->cancel_reason,
            //     'booking_id' => $request->dataId,
            //     'logo_url' => env('LOGO_URL'),
            // );
            // if(env('APP_ENV')!='local'){
            // $admin_email = Mail::send('frontend-source.emails.user-cancel-booking-admin', compact('admin_data'), function($message) use ($admin_data) {
            //     $message->to(Helper::adminInfo()->email);
            //     $message->subject($admin_data['subject']);
            //     $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
            // });
            // }
            if ($update_status) {
                return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully cancelled your booking']);
            } else {
                return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);
            }
        } else {
            return response()->json(['code' => 205, 'response' => "ERROR", 'message' => 'Please try again!']);
        }
    }


    public function verifybookingComplete(Request $request){
        $det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta')->where('booking_id', $request->booking_id)->first();

        $customer_det = json_decode($det->customer_meta,true);

        $assistant_boy_det = json_decode($det->assistant_boy_meta,true);

        //Send to email
        if(Session::get('otp')) {
                Session::forget('otp');
        }
        $otp = mt_rand(100000, 999999);
        Session::put('otp', $otp);
        //Send an email to the customer from the admin email address to confirm an email address.
        if($request->user==1){
            $data = array(
                'email' => $assistant_boy_det['email'],
                'guest_name' => $assistant_boy_det['first_name'].' '.$assistant_boy_det['last_name'],
                'subject' => 'OTP Verification for Complete the Service',
                'logo_url' => env('LOGO_URL'),
                'otp' => $otp
            );
        }else{
            $data = array(
                'email' => $customer_det['patient_email'],
                'guest_name' => $customer_det['patient_name'],
                'subject' => 'OTP Verification for Complete the Service',
                'logo_url' => env('LOGO_URL'),
                'otp' => $otp
            );
        }
        //$email = true;
        if(env('APP_ENV')!='local'){
        $email = Mail::send('frontend-source.emails.verification-code', compact('data'), function($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                    $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                });
        }

        //if($email) {
            return response()->json(['code' => 200,'response' => "SUCCESS",'otp' => $otp, 'message' => "Verification code sent to ".$data['guest_name']]);
        //}else{
            //return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Oops!! Verification code not sent"]);
        //}
    }
    
    

    public function bookingComplete(Request $request){
        if($request->input('otp') != session::get('otp')) {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please enter valid OTP"]);
        }
        $update_status = AssistantBoyBooking::where('booking_id', $request->booking_id)->update(['booking_status' => 5,'paid_by' => $request->paid_by]);

        if ($update_status) {
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Booking successfully completed <br />Booking ID:'.$request->booking_id]);
        } else {
            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);
        }
    }

    public function serviceComplete(Request $request){

        //dd($request->all());

        $hospitals = $request->hospital;
        $doctors = $request->doctor;
        $specialized = $request->specialized;
        $details = [];
        foreach($hospitals as $key => $val){
            $details[$key]['hospital'] = $val;
            $details[$key]['doctor'] = $doctors[$key];
            $details[$key]['specialized'] = $specialized[$key];
        }
        
        $update_status = AssistantBoyBooking::where('booking_id', $request->booking_id)
        ->update(['service_detail_meta' => json_encode($details),"service_close_request" => $request->service_close_with]);

        if ($update_status) {
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Booking successfully completed <br />Booking ID:'.$request->booking_id]);
        } else {
            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);
        }
    }

    

    public function addReview(Request $request){
        //Upload photo
       $postAll = $request->all();
       $postAll['user_id'] = Session::get('userId');
        if ($request->hasFile('photo')) {
            $config = CustomerHelper::configData('user_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];

            //upload Image
            $photo = bcrypt(date('dmy') . time() . $request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo) . '.' . $request->file('photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/user/review/' . $res_photo);
            
            $postAll['photo'] = $res_photo;
        }
        //dd($postAll);
        AssistantReview::create($postAll);
        $request->session()->flash('success', 'Review added successfully.');
        return back();
    }

    public function prescription(){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = CustomerPrescription::doesnthave('booking')->where('customer_id', Session::get('userId'))->orderBy('id', 'DESC')->get();
        //dd($booking);
        return view('frontend-source.customer-dashboard.user.prescription', ['account_prefix' => $account_prefix, 'data' => $data]);
    }

    public function prescriptionDetails($orderId){
        //dd($orderId);
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
        return view('frontend-source.customer-dashboard.user.prescription-details', ['account_prefix' => $account_prefix,'value' => $value, 'data' => $data, 'prescription_photo' => $prescription_photo, 'medicines' => $medicines, 'delivery_address' => $delivery_address]);
    }

    public function uploadprescriptionDetails($orderId){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        //$data               = CustomerPrescription::where([['customer_id', '=', Session::get('userId')],['order_id', '=', $orderId]])->first();
        $data = CustomerPrescription::with('booking','customer')->where('order_id', '=', $orderId)->first();
        if($data->customer_status==3){
            Session::put('check_prescription_status',4);
        }elseif($data->vendorprescriptions->where('status',5)->first()){
            Session::put('check_prescription_status',5);
        }elseif($data->vendorprescriptions->where('status',4)->first()){
            Session::put('check_prescription_status',3);
        }elseif($data->vendorprescriptions->where('status',1)->first()){
            Session::put('check_prescription_status',2);
        }elseif(!$data->vendorprescriptions->where('status',1)->first()){
            Session::put('check_prescription_status',1);
        }
        $prescription_photo = asset('prescription/'. $data['prescription_photo']);
        if(empty($data['prescription_photo']) || !file_exists(public_path('prescription/'. $data['prescription_photo']))){
            $prescription_photo = null;
        }
        $medicines          = json_decode($data->medicine, true);
        $delivery_address   = json_decode($data->delivery_address, true);
        $patient_details = json_decode($data->customer->meta);
        //dd($data->customer);
        //dd($data);
        return view('frontend-source.customer-dashboard.user.uploadprescription.prescription-details', ['account_prefix' => $account_prefix, 'data' => $data, 'prescription_photo' => $prescription_photo, 'medicines' => $medicines, 'delivery_address' => $delivery_address,'patient_details' => $patient_details]);
    }

    public function bookingsOne(){
        return view('frontend-source.customer-dashboard.user.bookings1');
    }
    public function bookingsTwo(){
        return view('frontend-source.customer-dashboard.user.bookings2');
    }
    public function Uploadprescription(Request $request,$booking_id=null){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $booking = AssistantBoyBooking::where('booking_id',$booking_id)->first();
        $patient_details = json_decode($booking->customer_meta);
        return view('frontend-source.customer-dashboard.user.upload-prescription', ['account_prefix' => $account_prefix, 'patient_details' => $patient_details]);
    }
    public function submitUploadPrescription(Request $request)
    {    //dd($request->all());
        $this->validate(
            $request, [
            'full_name' => 'required|string|max:20',
            //'mobile_no' => 'required',
            'gender' => 'required',
            'age' => 'required|string',
            // 'ship_type'=> 'required',
            // 'address'=> 'required'
            ]
        );
        $booking = AssistantBoyBooking::where('booking_id',$request->booking_id)->first();
        //Upload prescription photo
        if ($request->hasFile('prescription_photo')) {
            $photo = bcrypt(date('dmy') . time() . $request->input('full_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo) . '.' . $request->file('prescription_photo')->getClientOriginalExtension();
            //$photo_img = Image::make($request->file('prescription_photo')->getRealPath());
            //$photo_img->save(public_path() . '/prescription/' . $res_photo);
            $request->file('prescription_photo')->move(public_path('/prescription/'), $res_photo);
        } else {
            $res_photo = null;
        }
        $medicine_array = [];

        foreach ($request->medicine as $key => $val ) {
            $medicine_res_photo = null;
            if($request->hasFile('photo_'.$key)) {
                $medicine_photo = bcrypt(date('dmy') . time() . $key . $request->input('full_name'));
                $medicine_res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $medicine_photo) . '.' . $request->file('photo_'.$key)->getClientOriginalExtension();
                //$medicine_photo_img = Image::make($request->file('photo_'.$key)->getRealPath());
                //$medicine_photo_img->save(public_path() . '/prescription/photos/' . $medicine_res_photo);
                $request->file('photo_'.$key)->move(public_path('/prescription/photos/'), $medicine_res_photo);
            }
            $medicine_array[] = [ 'medicine'=>$val ?? null, 'quantity'=>$request->quantity[$key] ?? null, 'photo'=>$medicine_res_photo];
        }
       // dd($medicine_array);
        $medicine = json_encode($medicine_array);
        $address['city'] = $request->city;
        $address['state'] = $request->state;
        $address['zip'] = $request->zip;
        $address['country'] = $request->country;
        $address['bus_name'] = $request->bus_name;
        $address['from_arrival'] = $request->from_arrival;
        $address['to_arrival'] = $request->to_arrival;
        $address['address'] = $request->address;
        $delivery_address = json_encode(array_filter($address));

        $postAll = [];
        $postAll['customer_id'] = @$booking->customer_id ?? null;
        $postAll['prescription_photo'] = $res_photo;
        $postAll['medicine'] = $medicine;
        $postAll['full_name'] = $request->full_name;
        $postAll['mobile_no'] = $request->mobile_no;
        $postAll['gender'] = $request->gender;
        $postAll['age'] = $request->age;
        $postAll['ship_type'] = $request->ship_type ?? 3;
        $postAll['delivery_address'] = $delivery_address;
        $postAll['note'] = $request->note;
        $postAll['order_id'] = @$booking->booking_id ?? '';
        CustomerPrescription::create($postAll);
        return redirect('/assistant/medmate-search/'.$booking->booking_id)->with('success', 'Prescription uploaded successfully');
    }
    public function prescriptionSearch(Request $request,$id){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $login_user = Customer::where('id',Session::get('userId'))->where('status',1)->first(); 

        $pin = $request->pincode ? $request->pincode : 'All';
        //dd($login_user);
        $vendor = Customer::where('account_id',4)
        ->where('status',1);
        if($pin!='All'){
            $vendor->whereHas('relatedarea',function($q) use ($request){
                $q->where('pincode',$request->pincode);
            });
        
        }
        if($request->store_name){
            $vendor->where('name_of_store','LIKE','%'.$request->store_name.'%');
        
        }
        if($request->discount){
            $vendor->where('name_of_store','LIKE','%'.$request->store_name.'%');
        
        }
            $vendors = $vendor->inRandomOrder()->get();
        
        //dd($vendors);

        return view('frontend-source.customer-dashboard.user.search-prescription',compact('vendors','account_prefix','id','pin'));
    }
    public function prescriptionSend(Request $request,$id){
        
        $validator = Validator::make($request->all(), [
            'vendorids' => 'required|array|between:1,5'
        ],['vendorids.required' =>'You have to choose vendors from 1 to 5 number',
                'vendorids.between' =>'You have to choose vendors from 1 to 5 number'
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $login_user = Customer::where('id',Session::get('userId'))->first(); 
        $prescription = CustomerPrescription::where('order_id',$id)->first();
        //$det = AssistantBoyBooking::where('booking_id', $id)->first();
        $vendoruser = Customer::whereIn('id',$request->vendorids)->get()->keyBy('id');
        $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription->id)->get();
        if(count($VendorPrescriptionexist)==0){
            foreach($request->vendorids as $vendor){
                $VendorPrescription = new VendorPrescription();
                $VendorPrescription->prescription_id=$prescription->id;
                $VendorPrescription->vendor_id=$vendor;
                $VendorPrescription->save();
                
                //Send to email
                //User Email
                $data = array(
                    'email' => $vendoruser[$vendor]->email,
                    'subject' => 'New Booking Request #' . $id,
                    'customer_det' => $prescription,
                    'vendor_det' => $vendoruser[$vendor],
                    'booking_id' => $id,
                    'logo_url' => env('LOGO_URL'),
                );
                if(env('APP_ENV')!='local'){
                    $email = Mail::send('frontend-source.emails.vendor-prescription-request-booking', compact('data'), function($message) use ($data) {
                        $message->to($data['email']);
                        $message->subject($data['subject']);
                        $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                    });
                }
            }

            // if($det){
            //     $det->booking_status = 1;
            //     $det->assistant_boy_id = '';
            //     $det->assistant_boy_meta = '';
            //     $det->total_price = '0.00';
            //     $det->pickup_price = '0.00';
            //     $det->grand_price = '0.00';;
            //     $det->save();
            // }

        }

        
        if($login_user->account_id==1){
            return redirect()->to('/user/prescription')->with('success', 'Send Request  successfully');;
        }
        if($login_user->account_id==2){
            Session::put('check_prescription_status',1);
            return redirect()->to('/assistant/prescription/'.$id)->with('success', 'Send Request  successfully');;
        }
    }
    public function newBooking(Request $request){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        return view('frontend-source.customer-dashboard.user.new-booking', ['account_prefix' => $account_prefix, 'data' => []]);
    }
    public function postnewBooking(Request $request){
        $req_data=[];
        $updateDetails = [
            'first_name' => $request->patient_name,
            'last_name' => $request->patient_name,
            'email' => $request->patient_email,
            'phone' => $request->patient_mobile,
            'meta' => json_encode($req_data),
            'account_id' => 1,
        ];
        $customer_id = Customer::insertGetId($updateDetails);


        $customer_meta = [];
        $customer_meta['patient_from']  = $request->location;
        $customer_meta['patient_name']  = $request->patient_name;
        $customer_meta['patient_mobile']= $request->patient_mobile;
        $customer_meta['whats_app_no']  = $request->whats_app_no;
        $customer_meta['patient_email'] = $request->patient_email;
        $customer_meta['gender']        = $request->gender;
        $customer_meta['age']           = $request->age;
        
        $assistant_data = Customer::where([['id', '=', $request->input('assistant_boy_id')], ['account_id', '=', Config::get('constants.accountType.assistant')]])->first();
        $assistant_meta = json_decode($assistant_data->meta, true);
        $decode_assistant_data = CustomerHelper::decodeAssistantData($assistant_meta);
        if($request->booking == 1){
            $price = $decode_assistant_data['day_charges'];
        } else if($request->booking == 2){
            $price = $decode_assistant_data['night_charges'];
        } else if($request->booking == 3){
            $price = $decode_assistant_data['day_charges'] + $decode_assistant_data['night_charges'];
        } else {
            $price = $decode_assistant_data['day_charges'];
        }
        $pickup_price = 0;
        if($request->pickup_status){
            $explode_arrival = explode('-', $request->arrival_km);
            $total_km = str_replace("km","",strtolower($explode_arrival[1]));
            $pickup_price = $total_km*$decode_assistant_data['per_km_harges'];
        }
        $booking_id = random_int(100000, 999999);
        $postAll = [];
        $postAll['customer_id']         = $customer_id ?? null;
        $postAll['assistant_boy_id']    = $request->assistant_boy_id;
        $postAll['assistant_boy_meta']  = json_encode($decode_assistant_data);
        $postAll['customer_meta']       = json_encode($customer_meta);
        $postAll['book_date']           = $request->book_date;
        $postAll['arrival_time']        = $request->arrival_time;
        $postAll['pickup_status']       = $request->pickup_status ?? 0;
        $postAll['arrival_km']          = ($postAll['pickup_status'] == 1) ? $request->arrival_km : null;
        $postAll['early_serial_status'] = $request->early_serial_status ?? 0;
        $postAll['early_serial']        = ($postAll['early_serial_status'] == 1) ? $request->early_serial : null;
        $postAll['fooding_status']      = $request->fooding_status ?? 0;
        $postAll['booking_criteria']    = $request->booking;
        $postAll['total_price']         = $price;
        $postAll['pickup_price']        = $pickup_price;
        $postAll['discount_price']      = '0.00';
        $postAll['grand_price']         = ($price+$pickup_price);
        $postAll['payment_mode']        = $request->payment_mode ?? 2;
        $postAll['booking_id']          = $booking_id;
        $post_id = AssistantBoyBooking::insertGetId($postAll);
        $Booking = AssistantBoyBooking::where('id',$post_id)->first();
        return redirect()->to('assistant/upload-prescription/'.$Booking->booking_id);

    }
    public function addalltypeads(Request $request){
        //     $config = CustomerHelper::configData('admin_config');
        // $pageConfigs = ['pageHeader' => true];
        // $breadcrumbs = [
        //     ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        // ];
        $data = [];
        return view('pages.add_all_ads', ['data'=> $data
        ]);
    }
    public function postalltypeads(Request $request){
        $this->validate($request, [
            //'title' => 'required|string|max:255',
            'type_user' => 'required|string|max:255',
            //'video' => 'required|file|mimetypes:video/mp4',
            'video' => 'required|file',
        ]);
                $customer = new AlltypeAd();
                $customer->staff_id=Session::get('userId');
                $customer->type_user=$request->type_user;
                $customer->file_type='video';
                $customer->status=0;
                //$customer->title=$request->title;
                
                if ($request->hasFile('video'))
                {
                     $path = $request->file('video')->store('videos', ['disk' =>      'my_files']);
                    $customer->file_path = $path;
                }
                $customer->save();
                
         
        
            return back();

    }
    public function createInvoice($order_id){
        $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();
        $medicine = $allmedicines->first();
        $vendor = Customer::where('id',$medicine->vendor_id)->first();
        //dd($vendor);
        $vendorDetails = json_decode($vendor->meta);
        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
        
        //dd($vendorDetails);
        return view('frontend-source.customer-dashboard.user.create-invoice',compact('vendor','vendorDetails','prescription','allmedicines'));
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
               return redirect()->to('/user/uploadprescription/'.$order_id);
            }else{
                return redirect()->to('/user/prescription/'.$order_id);
            }
        }
        $vendor_id = $VendorPrescriptionexist->vendor_id;
        $vendor = Customer::where('account_id',4)->where('id',$vendor_id)->first();
        $user = Customer::where('account_id',1)->where('id',$prescription->customer_id)->first();
        $customer = AssistantBoyBooking::where('booking_id',$order_id)->first();
        $vendorDetails = json_decode($vendor->meta);
        $medicines = [];
        $customer_address = [];
        if($customer){
            $medicines          = json_decode($prescription->medicine, true);
            $customer_address   = json_decode($customer->customer_meta, true);
        }
        
        $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();
        //dd($vendorDetails);
        if($request->segment(2)=='download-uploadprescription-invoice'){
            return view('frontend-source.customer-dashboard.user.uploadprescription.view-invoice',compact('vendor','vendorDetails','prescription','allmedicines','medicines','customer_address','account_prefix','user','VendorPrescriptionexist','customer'));
        }else{
            return view('frontend-source.customer-dashboard.user.view-invoice',compact('vendor','vendorDetails','prescription','allmedicines','medicines','customer_address','account_prefix','user','VendorPrescriptionexist','customer'));
        }
    }
    public function payment($order_id){
        $prescription = CustomerPrescription::with('booking')->where('order_id',$order_id)->first();
        $prescription->customer_status = '5';
        $prescription->payment_status=1;
        $prescription->save();

        // $total_price = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->sum('total_price');
        // $admin_percent = 5;
        // $vendor_percent = 10;
        // $admin_amount = ($total_price - ($total_price*($admin_percent/100)));
        // $booking = new BookingCommision();
        // $booking->booking_id = $order_id;
        // $booking->save();
        // if($prescription->booking){
        //     $Booking = AssistantBoyBooking::where('booking_id',$order_id)->first();
        //     $Booking->payment_receive_status =1;
        //     $Booking->save();
        // }
        return back();
    }

    public function bookingpayment($order_id){
        // $prescription = CustomerPrescription::with('booking')->where('order_id',$order_id)->first();
        // $prescription->customer_status = '5';
        // $prescription->payment_status=1;
        // $prescription->save();
        // if($prescription->booking){
            $Booking = AssistantBoyBooking::where('booking_id',$order_id)->first();
            $Booking->payment_receive_status =1;
            $Booking->save();
        //}
        return back();
    }

    public function Cointransfer(Request $request){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = CoinTransfer::where('user_id',Session::get('userId'))->get();
        $user = Customer::where('id',Session::get('userId'))->first();
        return view('frontend-source.customer-dashboard.user.coins.index',compact('data','account_prefix','user'));
    }
    
    public function AddCointransfer(Request $request){

        $user = Customer::where('id',Session::get('userId'))->first();
        if($user->total_coin > $request->coin_transfer){
            $coin = new CoinTransfer();
            $coin->user_id  = Session::get('userId');
            $coin->total_amount  = $user->total_coin-$request->coin_transfer;
            $coin->transfer_coins = $request->coin_transfer;
            $coin->converted_price = $request->coin_transfer/10;
            $coin->save();
            $user->total_coin =  $user->total_coin-$request->coin_transfer;
            $user->save();
        }
        return back()->with('success', 'Coin Converted Successfully');;

    }
    public function mycoupons(Request $request){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = Coupon::where('coupon_type','PUBLIC')->orderBy('id','DESC')->get();
        $user = Customer::where('id',Session::get('userId'))->first();
        return view('frontend-source.customer-dashboard.user.report.coupons',compact('data','account_prefix','user'));
    }
    public function myreferals(Request $request){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = ReferalBonus::where('user_id',Session::get('userId'))->Orwhere('ref_id',Session::get('userId'))->orderBy('id','DESC')->get();
        $customer = Customer::where('id',Session::get('userId'))->first();
        return view('frontend-source.customer-dashboard.user.report.referals',compact('data','account_prefix','customer'));

    }
}
