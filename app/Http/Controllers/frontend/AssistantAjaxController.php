<?php
namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Helpers\CustomerHelper;
use App\AssistantBoyBooking;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use App\Helpers\Helper;
use App\Customer;
use Config;
use Razorpay\Api\Api;
use App\Payment;
use Carbon\Carbon;
use App\Coupon;

class AssistantAjaxController extends \App\Http\Controllers\Controller
{
    public function checkAvailabilityAssistant(Request $request){
        $book_date = date('d-m-Y' ,strtotime($request['date']));
        $response = [];
        $config = CustomerHelper::configData('user_config');
        //DB::enableQueryLog();
        $check_date = AssistantBoyBooking::where([
                ['assistant_boy_id', '=', $request['assistant_boy_id']],
                ['book_date', '=', $book_date]
            ])->whereIn('booking_status', [1,2])->count();
        
        if(strtotime($request['date']) > strtotime(date('d-m-Y'))){
            $getTime = CustomerHelper::createTimeRange('00:00', '23:30');
        } else {
            $seconds = strtotime('+'.Config::get('constants.bookStartMinute').' minutes', time());
            $rounded_seconds = ceil($seconds / (Config::get('constants.bookINTVL') * 60)) * (Config::get('constants.bookINTVL') * 60);
            $startTime = date('H:i', $rounded_seconds);
            $getTime = CustomerHelper::createTimeRange($startTime, '23:30');
        }
        //dd(DB::getQueryLog());
        if(empty($check_date)){
            $response['status']  = 'SUCCESS';
            $response['code']    = 200;
            $response['getTime'] = $getTime;
            $response['message'] = "success";
        } else {
            $response['status']  = 'ERROR';
            $response['code']    = 204;
            $response['getTime'] = $getTime;
            $response['message'] = $config['assistant_not_available'];
        }
        return $response;
    }
    public function bookingSummery(Request $request){

       // dd($request->assistant_boy_id);
        
        $get_medicalmate_det = Customer::select('meta')->where('id',$request->assistant_boy_id)->first();
        $assistant_meta = json_decode($get_medicalmate_det->meta, true);
        $decode_data = CustomerHelper::decodeAssistantData($assistant_meta);
        
        $booking_type = '';
        if(isset($request->booking)){
            if($request->booking == 1){
                $booking_type = 'Day';
            } elseif($request->booking == 2){
                $booking_type = 'Night';
            }else {
                $booking_type = '24Hours';
            }
        }
        $arrival_km = '00-00 KM';
        if(isset($request->pickup_status) && $request->pickup_status){
            $arrival_km = $request->arrival_km;
        }
       // $copunfetchall=DB::select("SELECT * FROM `coupons` WHERE user_ids LIKE '$request->assistant_boy_id%'");
        $couponstypepublic = DB::select('select * from coupons where coupon_type = ?', ['PUBLIC']); 
        //dd($couponstypepublic);
        $couponstypeprivate = DB::select('select * from coupons where coupon_type = ?', ['PRIVATE']);
       // if(!empty($copunfetchall)){}
            if($couponstypeprivate){
                $coupons = DB::select('select * from coupons where coupon_type = ?', ['PRIVATE']); 
                //dd( $coupons); 
                if($coupons[0]->coupon_discount_type=='FIXED')
                {$totalpat_amount=$request->total_price-$coupons[0]->coupon_value; $dedtion=$coupons[0]->coupon_value;}
                elseif($coupons[0]->coupon_discount_type=='PERCENTAGE'){$totalpat_amount = ($coupons[0]->coupon_value / 100) * $request->total_price; $dedtion=$coupons[0]->coupon_value.'%';} 
            }elseif($couponstypepublic){

                $coupons = DB::select('select * from coupons where coupon_type = ?', ['PUBLIC']); 
                //dd( $coupons); 
                if($coupons[0]->coupon_discount_type=='FIXED')
                {$totalpat_amount=$request->total_price-$coupons[0]->coupon_value; $dedtion=$coupons[0]->coupon_value;}
                elseif($coupons[0]->coupon_discount_type=='PERCENTAGE'){$totalpat_amount = ($coupons[0]->coupon_value / 100) * $request->total_price; $dedtion=$coupons[0]->coupon_value.'%';} 

            }
         
        $dom_html = '<div class="text-center mt50">
                    <h4>Booking Summery</h4>
                </div>
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle tab-1">1</a>
                            <p>Patient Details</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle tab-2" disabled="disabled">2</a>
                            <p>Booking Summary</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle tab-3" disabled="disabled">3</a>
                            <p>Payment</p>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="row setup-content" id="step-1">
                        <div class="col-md-12">
                            <div class="mm-book-table-data">
                                <div class="name">PATIENT: '. $request->patient_name .'<span>'. $request->gender .'</span></div>
                                <div class="content">
                                    <ul>
                                        <li><strong><i class="fas fa-map-marker-alt"></i> Patient From:</strong> '. $request->location .'</li>
                                        <li><strong><i class="fas fa-calendar-alt"></i> Booking Date & Time:</strong> '. date('d F Y') ." (". date('H:i A') .')</li>
                                        <li><strong><i class="fas fa-calendar-alt"></i> Service Date:</strong> '. date('d F Y' ,strtotime($request->book_date)) .'</li>
                                        <li><strong><i class="fas fa-clock"></i> Arrival Time:</strong> '. $request->arrival_time .'</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center step-btn">
                                <a href="javascript:void(0)" class="btn btn-md bg-info btn-fill prvBtn">Back</a>
                                <a href="javascript:void(0)" class="btn btn-md bg-primary btn-fill nextBtn">Next</a>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-2">
                        <div class="col-md-12">
                            <div class="mm-book-table-data">
                            <div class="name">MEDICAL MATE: '. $decode_data['first_name'] ." ". $decode_data['last_name'] .' <span>'. $decode_data['gender'] .'</span></div>
                                <div class="content">
                                    <ul>
                                        <li><strong><i class="fas fa-map-marker-alt"></i> Service Area:</strong> '. $decode_data['service_area'] .'</li>
                                        <li><strong><i class="fas fa-rupee-sign"></i> Service Charge:</strong> Rs.'. $request->price .'/'.$booking_type.'</li>
                                        <li><strong><i class="fas fa-motorcycle"></i> Bike Charge:</strong> '. $arrival_km .'</li>
                                        <li><strong><i class="fas fa fa-gift"></i> Coupon Code:</strong> 
                                            <div class="col-md-2"><input type="text" id="coupon-code" readonly="readonly" value="'.$coupons[0]->coupon_name.'"  required name="coupon_name"  class="form-control" data-validation-required-message="This type field is required">
                                            <input id="Button1" class="btn btn-md bg-primary type="button" value="Apply" onclick="switchVisible();"/>
                                            </div>
                                        </li>
                                    </ul>   
                                    
                                </div>
                                <div class="name pay-summary"><strong>Payment Summary</strong></div>
                                <div class="content">
                                    <table>
                                        <tr>
                                            <td>Medical Mate Service Charge Rs.'.$request->price .'</td>
                                            <td>(1 Item)</td>
                                        </tr>
                                        <tr id="Div1" style="display: none">
                                            <td>Deduction Coupen Charge Rs.'.$dedtion .'</td>
                                        </td>
                                        <tr>
                                            <td>Bike Charge Rs.'. $request->pickup_price .'</td>
                                            <td>(1 Item '. $arrival_km .')</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="name" id="Div3">Total Payable Amount: <strong>Rs.'. $request->total_price .'</strong></div>
                                <div style="display: none" id="Div2" class="name">Total Payable Amount: <strong>Rs.'. $totalpat_amount .'</strong></div>
                            </div>
                            <div class="text-center step-btn">
                                <a href="javascript:void(0)" class="btn btn-md bg-info btn-fill prvBtn">Back</a>
                                <a href="javascript:void(0)" class="btn btn-md bg-primary btn-fill nextBtn">Next</a>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-3">
                        <div class="col-md-12">
                            <div class="mm-book-table-data">
                                <div class="blue-bar"><i class="fal fa-check-circle"></i> Safe and secure payment, ease return 100% on valid cancellation T&C</div>
                                <div class="content">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="payment" value="1">Pay Online
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio"  class="form-check-input" name="payment" value="2">Pay After Service
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center step-btn">
                                <a href="javascript:void(0)" class="btn btn-md bg-info btn-fill prvBtn">Back</a>
                                <a href="javascript:void(0)" class="btn btn-md bg-success btn-fill submit-data">Submit Booking</a>
                            </div>
                        </div>
                    </div>
                </form>';
        return response()->json(['code' => 200,'response' => "SUCCESS", 'data' => $dom_html]);
        //return View::make('frontend-source.layouts.master', $coupons);
    }

   
    
    public function assistantBookingOtp(Request $request){
        if(Session::get('otp')) {
                Session::forget('otp');
        }
        $otp = mt_rand(100000, 999999);
        Session::put('otp', $otp);
        //Send an email to the customer from the admin email address to confirm an email address.
        $data = array(
            'email' => $request->input('email'),
            'guest_name' => $request->input('name'),
            'subject' => 'OTP Verification',
            'logo_url' => env('LOGO_URL'),
            'otp' => $otp
        );
        //$email = true;
        if(env('APP_ENV')!='local'){
        $email = Mail::send('frontend-source.emails.verification-code', compact('data'), function($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                    $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                });
            }
        //End email function
        
        //if($email) {
            return response()->json(['code' => 200,'response' => "SUCCESS",'otp' => $otp, 'message' => "Verification code sent to ".$request->input('email')]);
        //}else{
            //return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Oops!! Verification code not sent"]);
        //}
    }
    
    public function bookAssistant(Request $request){

        //  $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        // $data = Customer::select('id','meta','pin')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        if($request->input('otp') != Session::get('otp')) {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please enter valid PIN"]);
        }
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
        
        $assistant_data = Customer::where([['id', '=', $request->input('assistant_boy_id')], ['account_id', '=', Config::get('constants.accountType.assistant')]])->first();
        $assistant_meta = json_decode($assistant_data->meta, true);
        $decode_assistant_data = CustomerHelper::decodeAssistantData($assistant_meta);
        $default_extend_time = 8;
        if($request->booking == 1){
            $price = $decode_assistant_data['day_charges'];
            $default_extend_time = 8;
        } else if($request->booking == 2){
            $price = $decode_assistant_data['night_charges'];
            $default_extend_time = 8;
        } else if($request->booking == 3){
            $price = $decode_assistant_data['day_charges'] + $decode_assistant_data['night_charges'];
            $default_extend_time = 16;
        } else {
            $price = $decode_assistant_data['hourly_charges']*3;
            $default_extend_time = 3;
        }
        
        $pickup_price = 0;
        if($request->pickup_status){
            $explode_arrival = explode('-', $request->arrival_km);
            $total_km = $explode_arrival[1] ? str_replace("km","",strtolower($explode_arrival[1])):0;
            $pickup_price = $total_km*$decode_assistant_data['per_km_harges'];
        }
        $booking_id = random_int(100000, 999999);
        $postAll = [];
        $postAll['customer_id']         = Session::get('userId') ?? null;
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
        $postAll['payment_mode']        = $request->payment_mode;
        $postAll['booking_id']          = $booking_id;
        $postAll['booking_pin']          = rand(10000,99999);;
        $postAll['booking_type']          = 'fullbook';;
        $postAll['extend_hour']         = $default_extend_time;
        $post = AssistantBoyBooking::create($postAll);
        //$booking_id = 'MMM'.str_pad($post->id,5,0,STR_PAD_LEFT);
        //$update = AssistantBoyBooking::find($post->id)->update(['booking_id'=>$booking_id]);
        if($post){
            if($request->payment_mode == 1){
                $desc = json_encode([
                    "next_url" => "/user/bookings/".$booking_id,
                    "booking_id" => $booking_id,
                    "type" => "Full Booking",
                    "price" => ($price+$pickup_price)
                ]);
                $data = CustomerHelper::setdataencrypt($desc);
                $payment = Payment::where('booking_id',$booking_id)->first();
                if(!$payment){
                    $payment = new Payment();
                    $payment->booking_id = $booking_id;
                    $payment->transaction_id = uniqid();
                    $payment->booking_type  = 'Full Booking';
                    $payment->status  = 'Inprogress';
                    $payment->booking_start_date  = Carbon::now();
                    $payment->payment_start_response  = $data;
                    $payment->save();
                }   
                $data = array(
                    'code' => 200,
                    'response' => "SUCCESS",
                    'payment_mode' => $request->payment_mode,
                    'booking_id' => $booking_id,
                    'amount' => ($price+$pickup_price),
                    'key_id' => env('RAZOR_KEY'),
                    'name' => env('APP_NAME'),
                    'payment' => $payment
                );
                return response()->json($data);
            } else {
                //Send to 3 email (User, Assistant, Admin)
                //Assistant Email
                $assistant_config = CustomerHelper::configData('assistant_config');
                $data = array(
                    'subject' => 'New Booking Request #' . $booking_id,
                    'email' => $assistant_data->email,
                    'customer_meta' => $customer_meta,
                    'booking_id' => $booking_id,
                    'book_date' => $request->book_date,
                    'arrival_time' => $request->arrival_time,
                    'pickup_status' => $request->pickup_status,
                    'auto_forward_request' =>  $assistant_config['auto_forward_request'],
                    'logo_url' => env('LOGO_URL'),
                );
                if(env('APP_ENV')!='local'){
                $email = Mail::send('frontend-source.emails.assistant-booked', compact('data'), function($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                    $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                });
            }

                //Admin Email
                $adminData = array(
                    'subject' => 'New Booking Request For Assistant Boy ' . $assistant_data->first_name. ' '. $assistant_data->last_name,
                    'email' => Helper::adminInfo()->email,
                    'customer_meta' => $customer_meta,
                    'booking_id' => $booking_id,
                    'book_date' => $request->book_date,
                    'arrival_time' => $request->arrival_time,
                    'pickup_status' => $request->pickup_status,
                    'assistant_name' => $assistant_data->first_name. ' '. $assistant_data->last_name,
                    'logo_url' => env('LOGO_URL'),
                );
                if(env('APP_ENV')!='local'){
                $adminEmail = Mail::send('frontend-source.emails.assistant-booked-admin', compact('adminData'), function($message) use ($adminData) {
                    $message->to($adminData['email']);
                    $message->subject($adminData['subject']);
                    $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                }); 
                }
                //End email function
                return response()->json(['code' => 200,'response' => "SUCCESS", 'payment_mode' => $request->payment_mode, 'message' => "You successfully created your booking", 'booking_id' => $booking_id]);
            }
        } else {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please try again"]);
        }
    }
    
    public function updateTransaction(Request $request){
        //dd($request->all());
        $input = $request->all();       
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        $booking_id = $payment->description;
        $paymentdata = Payment::where('booking_id',$booking_id)->first();
        //dd($paymentdata);
        $booking = AssistantBoyBooking::where('booking_id',$booking_id)->first();
        $start_response = json_decode(CustomerHelper::getdataencrypt($paymentdata->payment_start_response));
        //dd($start_response->type);
        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                
                $booking_desc = CustomerHelper::setdataencrypt(json_encode($response->toArray()));
                $paymentdata->status  = 'Success';
                $paymentdata->booking_end_date  = Carbon::parse($response['created_at'])->format('Y-m-d H:i:s');
                $paymentdata->payment_end_response  = $booking_desc;
                $paymentdata->save();
                if($booking){
                    if($start_response->type=='Serial Booking'){
                        $booking->payment_receive_status = 3;
                        $booking->paid = 1;
                        $booking->save();
                    }
                    if($start_response->type == 'Service Close'){
                        $booking->paid = 1;
                        $booking->save();

                    }
                    if($start_response->type=='Full Booking'){
                        $booking->payment_receive_status = 3;
                        $booking->paid = 1;
                        $booking->save();
                    }
                }
            } 
            catch (\Exception $e) 
            {
                return response()->json(['code' => 204,'response' => "ERROR", 'message' => $e->getMessage(),"booking_id" => $booking_id]);
            }            
        }else{
            
                $paymentdata->status  = 'Failed';
                
                $paymentdata->save();
                //\Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
                return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Payment Failed ","booking_id" => $booking_id]);
        }
        
        //\Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        //return redirect()->to($start_response->next_url);
        return response()->json(['code' => 200,'response' => "SUCCESS", 'message' => "Payment Successfully Done ","booking_id" => $booking_id  ]);
    }
    
    public function bookingSuccess($bookingId){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        if(!empty($bookingId)){
            $booking = AssistantBoyBooking::where('booking_id', $bookingId)->first();
            if(!empty($booking)){
                return view('frontend-source.booking-success', ['account_prefix' => $account_prefix, 'booking' => $booking]);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
