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
use Validator;
use DB;
use App\Configuration;
use Mail;
use App\CustomerPrescription;
use App\AssistantReview;
use App\VendorPrescription;
use App\VendorInvoice;
use App\OrderMedmate;
use Carbon;
use App\Payment;
use App\Http\Controllers\PaymentController;


class BookingController extends \App\Http\Controllers\Controller {

	public function bookMedicalMateSerial(Request $request){

        return view('frontend-source.customer-dashboard.user.serialbooking.book-medical-mate', ['assistant' => [], 'data'=>[], 'photo'=>'']);
	}

    public function bookMedicalMateSerialPayment(Request $request,$id){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $medmateconfig = CustomerHelper::configData('assistant_config');
        $price = $medmateconfig['serial_no_booking_charge'];
        $post = AssistantBoyBooking::where('booking_id',$id)->first();
        $seconds = strtotime('+'.Config::get('constants.bookStartMinute').' minutes', time());
            $rounded_seconds = ceil($seconds / (Config::get('constants.bookINTVL') * 60)) * (Config::get('constants.bookINTVL') * 60);
            $startTime = date('H:i', $rounded_seconds);
            $getTime = CustomerHelper::createTimeRange($startTime, '23:30');
            $booking_id = $id;
            if($post->assistant_boy_id){
                $desc = json_encode([
                    "next_url" => "/user/bookings/".$booking_id,
                    "booking_id" => $booking_id,
                    "type" => "Serial Booking",
                    "price" => $price
                ]);
            }else{

                $desc = json_encode([
                    "next_url" => "/direct-booking/search-medmate/".$booking_id,
                    "booking_id" => $booking_id,
                    "type" => "Serial Booking",
                    "price" => $price
                ]);

            }
            $booking_desc = CustomerHelper::setdataencrypt($desc);

            //(new PaymentController)->razorpay($booking_desc,$id);

        return view('frontend-source.customer-dashboard.user.serialbooking.payment', compact('post','account_prefix','id','getTime','booking_id','medmateconfig','booking_desc','price'));
        
    }

    public function bookMedicalMateSerialPaymentCallback(Request $request,$id){
         $booking = AssistantBoyBooking::where('booking_id',$id)->first();
         $assistantconfig = \App\Helpers\CustomerHelper::configData('assistant_config');
         $booking->advance_price = $assistantconfig['serial_no_booking_charge'];
         $booking->grand_price = $assistantconfig['serial_no_booking_charge'];
         $booking->total_price = $assistantconfig['serial_no_booking_charge'];
         $booking->payment_receive_status = 2;
         $booking->save();

        if($booking->assistant_boy_id){
            return redirect()->to('/medihelp/booking-success/'.$booking->booking_id);
        }else{
            return redirect()->to('/direct-booking/search-medmate/'.$booking->booking_id);
            
        }
    }

	public function bookMedicalMateFullService(Request $request){
		$seconds = strtotime('+'.Config::get('constants.bookStartMinute').' minutes', time());
            $rounded_seconds = ceil($seconds / (Config::get('constants.bookINTVL') * 60)) * (Config::get('constants.bookINTVL') * 60);
            $startTime = date('H:i', $rounded_seconds);
            $getTime = CustomerHelper::createTimeRange($startTime, '23:30');
            $admindata = Configuration::first();
            $data = getAdminConfig(json_decode($admindata->assistant_config,1));
        //dd($data);
        return view('frontend-source.customer-dashboard.user.directbooking.book-medical-mate', ['assistant' => [], 'data'=>$data, 'photo'=>'', 'getTime'=>$getTime]);
	}

	public function bookAssistant(Request $request){
		//dd($request->all());
        //  $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        // $data = Customer::select('id','meta','pin')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        
        $customer_meta = [];
        $customer_meta['patient_from']  = $request->location;
        $customer_meta['patient_name']  = $request->patient_name;
        $customer_meta['patient_mobile']= $request->patient_mobile;
        $customer_meta['whats_app_no']  = $request->whats_app_no;
        $customer_meta['patient_email'] = $request->patient_email;
        $customer_meta['gender']        = $request->gender;
        $customer_meta['age']           = $request->age;
        $customer_meta['patient_type']           = $request->patient_type;
        $customer_meta['hospital']           = $request->hospital;
        $customer_meta['specific_doctor']           = $request->specific_doctor;
        $customer_meta['destination_address']           = $request->destination_address;
        $customer_meta['location_pincode']           = $request->location_pincode;
        $customer_meta['old_prescription']           = $request->upfile;
        $default_extend_time = 1;
        if($request->assistant_boy_id){
            $assistant_data = Customer::where([['id', '=', $request->assistant_boy_id], ['account_id', '=', Config::get('constants.accountType.assistant')]])->first();
            $assistant_meta = json_decode($assistant_data->meta, true);
            $decode_assistant_data = CustomerHelper::decodeAssistantData($assistant_meta);
            if($request->booking == 1){
                $price = $decode_assistant_data['day_charges'];
                $default_extend_time = 8;
            } else if($request->booking == 2){
                $price = $decode_assistant_data['night_charges'];
                $default_extend_time = 8;
            } else if($request->booking == 3){
                $default_extend_time = 16;
                $price = $decode_assistant_data['day_charges'] + $decode_assistant_data['night_charges'];
            } else {
                $price = $decode_assistant_data['hourly_charges']*3;
                $default_extend_time = 3;
            }
            if($request->booking_type=='serial'){
                $default_extend_time = 1;
                $assistantconfig = \App\Helpers\CustomerHelper::configData('assistant_config');
                $price = $assistantconfig['serial_no_booking_charge'];
            }
        }
        
        
        
        $pickup_price = 0;
        
        $booking_id = random_int(100000, 999999);
        $postAll = [];
        $postAll['customer_id']         = Session::get('userId') ?? null;
        if($request->assistant_boy_id){
            $postAll['assistant_boy_id']    = $request->assistant_boy_id ?? '';
            $postAll['assistant_boy_meta']  = json_encode($decode_assistant_data);
            $postAll['total_price']  = $price;
            $postAll['grand_price']  = $price;
        }
        $postAll['customer_meta']       = json_encode($customer_meta);
        $postAll['book_date']           = $request->book_date;
        $postAll['extend_hour']         = $default_extend_time;
        //$postAll['arrival_time']        = $request->arrival_time;
        //$postAll['pickup_status']       = $request->pickup_status ?? 0;
        //$postAll['arrival_km']          = ($postAll['pickup_status'] == 1) ? $request->arrival_km : null;
        $postAll['booking_type'] = $request->booking_type ?? 0;
        
        $postAll['payment_mode']        = $request->payment_mode;
        $postAll['booking_id']          = $booking_id;
        $postAll['booking_pin']          = rand(10000,99999);;
        $post = AssistantBoyBooking::create($postAll);
        //$booking_id = 'MMM'.str_pad($post->id,5,0,STR_PAD_LEFT);
        //$update = AssistantBoyBooking::find($post->id)->update(['booking_id'=>$booking_id]);
        if($post){
            return response()->json(['code' => 200,'response' => "SUCCESS", 'payment_mode' => $request->payment_mode, 'message' => "You successfully created your booking", 'booking_id' => $booking_id ,'assistant_boy_id' => $request->assistant_boy_id]);
        } else {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please try again"]);
        }
    }

    public function bookMedicalMateSearchMedmate(Request $request,$id){

    	$account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $login_user = Customer::where('id',Session::get('userId'))->first(); 
        $value = AssistantBoyBooking::with('medmaterequestlists')->where('booking_id',$id)->first();
        OrderMedmate::where('booking_id',$id)->delete();
        //dd($login_user);
        $assistants = Customer::where('account_id',2)->where('admin_status',1);

        $customer_meta = json_decode($value->customer_meta,1);
        //->where('pincode',$login_user->pincode)
        if($request->name){
            $assistants->where('first_name','LIKE','%'.$request->name.'%')->Orwhere('last_name','LIKE','%'.$request->name.'%');
        
        }
        if($request->pincode){
            $assistants->whereHas('relatedarea',function($q) use ($request){
                $q->where('pincode',$request->pincode);
            });
        
        }
        if($request->booking_type){
            $assistants->where('booking_type',$request->booking_type);
        }
        
        
        $assistant = $assistants->inRandomOrder()->get();

        if($value->booking_type=='fullbook'){
            return view('frontend-source.customer-dashboard.user.directbooking.search-medical-mate', compact('assistant','account_prefix','id','customer_meta'));
        }else{
        
        return view('frontend-source.customer-dashboard.user.serialbooking.search-medical-mate', compact('assistant','account_prefix','id','customer_meta'));
        }
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
        $det = AssistantBoyBooking::where('booking_id', $id)->first();
        $VendorPrescriptionexist = OrderMedmate::where('booking_id',$id)->get();
        if(count($VendorPrescriptionexist)==0){
            foreach($request->vendorids as $vendor){
                $VendorPrescription = new OrderMedmate();
                $VendorPrescription->booking_id=$id;
                $VendorPrescription->medmate_id=$vendor;
                $VendorPrescription->save();
            }
            if($det){
                $det->booking_status = 1;
                $det->assistant_boy_id = NULL;
                $det->assistant_boy_meta = NULL;
                $det->total_price = '0.00';
                $det->pickup_price = '0.00';
                $det->grand_price = '0.00';;
                $det->save();
            }

        }
        
        if($login_user->account_id==1){
            return redirect()->to('/user/medmate-bookings-listing/'.$id)->with('success', 'Send Request  successfully');;
        }
        
    }
    public function medmatelist(Request $request,$id){
    	$account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $login_user = Customer::where('id',Session::get('userId'))->first(); 
        //dd($login_user);
        $value = AssistantBoyBooking::with('medmaterequestlists')->where('booking_id',$id)->first();
        if(!$value->assistant_boy_id){
        	Session::put('check_prescription_status',1);
    	}else{
    		Session::put('check_prescription_status',2);
    	}
        //dd($value);
        
        return view('frontend-source.customer-dashboard.user.serialbooking.search-medical-matelist', compact('value','account_prefix','id'));
        
    }

    public function bookingRequest(Request $request){
    	$account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $login_user = Customer::where('id',Session::get('userId'))->first(); 
        //dd($login_user);
        $data = AssistantBoyBooking::with('medmaterequestlists')
        ->whereHas('medmaterequestlists',function($q){
        	$q->where('medmate_id',Session::get('userId'))->where('status',0);
        })->orderBy('id','DESC')
        ->whereNull('assistant_boy_id')->get();
        //dd($data);
        
        
        return view('frontend-source.customer-dashboard.assistant.booking-request', compact('data','account_prefix'));
    }

    public function acceptRequestBooking(Request $request){

        
        $assistant_data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Config::get('constants.accountType.assistant')]])->first();
        $assistant_meta = json_decode($assistant_data->meta, true);
        $decode_assistant_data = CustomerHelper::decodeAssistantData($assistant_meta);
        $det = AssistantBoyBooking::where('booking_id', $request->dataId)->first();
        if($det->assistant_boy_id && $det->assistant_boy_id!=Session::get('userId')){
            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try Another Request!']);
        }
        $assistantconfig = \App\Helpers\CustomerHelper::configData('assistant_config');
        if($det->booking_type=='serial' && $det->assistant_boy_id){

            $det->booking_status = 2;
            $price = $assistantconfig['serial_no_booking_charge'];
            $pickup_price='0.00';
            $det->total_price = $price;
            $det->pickup_price = '0.00';
            $det->grand_price = ($price+$pickup_price);;
            $det->save();

        }else{
            if($det->booking == 1){
                $price = $decode_assistant_data['day_charges'];
            } else if($det->booking == 2){
                $price = $decode_assistant_data['night_charges'];
            } else if($det->booking == 3){
                $price = $decode_assistant_data['day_charges'] + $decode_assistant_data['night_charges'];
            } else if($det->booking == 4){
                $price = $decode_assistant_data['hourly_charges'] * 3;
            }else{
                $price = $decode_assistant_data['hourly_charges'] ;
            }
            if($det->booking_type=='serial'){
                $price = $assistantconfig['serial_no_booking_charge'];
            }

            $pickup_price='0.00';
            if($det->pickup_status==1){
                $explode_arrival = explode('-', $det->arrival_km);
                $total_km = $explode_arrival[1] ? str_replace("km","",strtolower($explode_arrival[1])):0;
                $pickup_price = $total_km*$decode_assistant_data['per_km_harges'];
                //$pickup_price = $total_km*5;
            }

            $det->booking_status = 2;
            $det->assistant_boy_id = Session::get('userId');
            $det->assistant_boy_meta = json_encode($decode_assistant_data);
            $det->total_price = $price;
            $det->pickup_price = $pickup_price;
            $det->grand_price = ($price+$pickup_price);;
            $det->save();
        }

        // $update_status = AssistantBoyBooking::where('booking_id', $request->dataId)->update(['booking_status' => 2,'assistant_boy_id' => Session::get('userId'),'assistant_boy_meta'  => json_encode($decode_assistant_data),'total_price'=> $price,'grand_price'=> $price]);



        

        $customer_det = json_decode($det->customer_meta,true);

        $assistant_boy_det = json_decode($det->assistant_boy_meta,true);

        OrderMedmate::where('booking_id',$request->dataId)->where('medmate_id', Session::get('userId'))->update(['status' => 1]);

        $medmate_request = OrderMedmate::where('booking_id',$request->dataId)->where('status','!=', 1)->delete();

        //Send to email

        $data = array(

            'subject' => 'Booking id ' . $request->dataId . ' Confirmed',

            'email' => $customer_det['patient_email'],

            'customer_det' => $customer_det,

            'assistant_boy_det' => $assistant_boy_det,

            'booking_id' => $request->dataId,

            'logo_url' => env('LOGO_URL'),

        );

        // $email = Mail::send('frontend-source.emails.booking-confirm', compact('data'), function($message) use ($data) {

        //     $message->to($data['email']);

        //     $message->subject($data['subject']);

        //     $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);

        // });

        if($det->assistant_boy_id){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully accepted<br>Booking ID: '.$request->dataId]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }

    }

    public function declineRequestBooking(Request $request){
        $update_status = OrderMedmate::where('booking_id',$request->dataId)->where('medmate_id', Session::get('userId'))->update(['status' => 2]);

        if($update_status){

            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'You have successfully Declined<br>Booking ID: '.$request->dataId]);

        } else {

            return response()->json(['code' => 204, 'response' => "ERROR", 'message' => 'Please try again!']);

        }
    }

    public function bookingSummeryDirect(Request $request){
        
        $customer_meta = [];
        $customer_meta['patient_from']  = $request->location;
        $customer_meta['patient_name']  = $request->patient_name;
        $customer_meta['patient_mobile']= $request->patient_mobile;
        $customer_meta['whats_app_no']  = $request->whats_app_no;
        $customer_meta['patient_email'] = $request->patient_email;
        $customer_meta['gender']        = $request->gender;
        $customer_meta['age']           = $request->age;
        $customer_meta['patient_type']           = $request->patient_type;
        $customer_meta['hospital']           = $request->hospital;
        $customer_meta['specific_doctor']           = $request->specific_doctor;
        $customer_meta['destination_address']           = $request->destination_address;
        $customer_meta['old_prescription']           = $request->upfile;
        
        // $assistant_data = Customer::where([['id', '=', $request->input('assistant_boy_id')], ['account_id', '=', Config::get('constants.accountType.assistant')]])->first();
        // $assistant_meta = json_decode($assistant_data->meta, true);
        // $decode_assistant_data = CustomerHelper::decodeAssistantData($assistant_meta);
        $price =0;
        // if($request->booking == 1){
        //     $price = $decode_assistant_data['day_charges'];
        // } else if($request->booking == 2){
        //     $price = $decode_assistant_data['night_charges'];
        // } else if($request->booking == 3){
        //     $price = $decode_assistant_data['day_charges'] + $decode_assistant_data['night_charges'];
        // } else {
        //     $price = $decode_assistant_data['day_charges'];
        // }
        
        $pickup_price = 0;
        if($request->pickup_status==1){
            $explode_arrival = explode('-', $request->arrival_km);
            $total_km = $explode_arrival[1] ? str_replace("km","",strtolower($explode_arrival[1])):0;
            //$pickup_price = $total_km*$decode_assistant_data['per_km_harges'];
            $pickup_price = $total_km*5;
        }
        $booking_id = random_int(100000, 999999);
        $postAll = [];
        $postAll['customer_id']         = Session::get('userId') ?? null;
        //$postAll['assistant_boy_id']    = $request->assistant_boy_id;
        //$postAll['assistant_boy_meta']  = json_encode($decode_assistant_data);
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
        $postAll['pickup_price']        = '0.00';
        $postAll['discount_price']      = '0.00';
        $postAll['grand_price']         = '0.00';
        //$postAll['payment_mode']        = $request->payment_mode;
       
        $postAll['booking_type']          = 'fullbook';;

        if($request->booking_id){
            $post = AssistantBoyBooking::where('booking_id',$request->booking_id)->first();
            $booking_id = $post->booking_id;
        }else{
            $postAll['booking_id']          = $booking_id;
            $postAll['booking_pin']          = rand(10000,99999);;
        }

        //dd($postAll);
        if($request->step==1 && !$request->booking_id){
            $post = AssistantBoyBooking::create($postAll);
        }else if($request->step==1 && $request->booking_id){
            $post = AssistantBoyBooking::find($post->id)->update($postAll);

        }else if($request->step==3){
            $post = AssistantBoyBooking::where('booking_id',$request->booking_id)->first();
            $decode_data = json_decode($post->customer_meta, true);
            $decode_data['report_available'] = json_encode($request->Free_Blood_Group_Report);
            $post->customer_meta = json_encode($decode_data);
            $post->save();

        }

        if($request->step==3){
            return response()->json(['code' => 200,'response' => "SUCCESS", 'url' => '/direct-booking/search-medmate/'.$booking_id]);
        }else if($request->step==2){
            return response()->json(['code' => 200,'response' => "SUCCESS", 'url' => '/direct-booking/step-3/'.$booking_id]);
        }else{
             return response()->json(['code' => 200,'response' => "SUCCESS", 'url' => '/direct-booking/step-2/'.$booking_id]);
        }
        

    }

    public function bookingSummeryDirectstepTwo(Request $request,$id){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        
        $post = AssistantBoyBooking::where('booking_id',$id)->first();
        $seconds = strtotime('+'.Config::get('constants.bookStartMinute').' minutes', time());
            $rounded_seconds = ceil($seconds / (Config::get('constants.bookINTVL') * 60)) * (Config::get('constants.bookINTVL') * 60);
            $startTime = date('H:i', $rounded_seconds);
            $getTime = CustomerHelper::createTimeRange($startTime, '23:30');
        return view('frontend-source.customer-dashboard.user.directbooking.book-medical-mate-steptwo', compact('post','account_prefix','id','getTime'));
        

    }
    public function bookingSummeryDirectstepThree(Request $request,$id){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        
        $post = AssistantBoyBooking::where('booking_id',$id)->first();
        return view('frontend-source.customer-dashboard.user.directbooking.book-medical-mate-stepthree', compact('post','account_prefix','id'));
        

    }
}