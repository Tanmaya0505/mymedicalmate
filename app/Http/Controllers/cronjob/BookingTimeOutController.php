<?php

namespace App\Http\Controllers\cronjob;

use Illuminate\Http\Request;
use App\AssistantBoyBooking;
use App\AssistantFwrdBooking;
use App\AssistantCancelBooking;
use App\Customer;
use App\Helpers\CustomerHelper;
use App\Helpers\Helper;
use DB;
use Mail;
use Config;
use DateTime;
use Carbon\Carbon;
use App\BookingCommision;
use App\Notification;

class BookingTimeOutController extends \App\Http\Controllers\Controller
{

    public function BookingTimeOut(){
        $response = [];
        $assistant_config = CustomerHelper::configData('assistant_config');
        $date = new DateTime;
        //$date->modify('-' . $assistant_config['auto_forward_request'] . ' minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $bk_assistant_data = AssistantBoyBooking::select('id','assistant_boy_id','assistant_boy_meta','customer_meta','book_date','booking_id','booking_status','fwrd_status','created_at')
        ->where([['booking_status', '=', 1]])->get();
        
        if($bk_assistant_data->isNotEmpty()){
            foreach($bk_assistant_data as $bKey => $bVal){
                //print_r($bVal); exit;
                $startTime = Carbon::parse($bVal->created_at);
                $finishTime = Carbon::now();
                $totalDuration = $finishTime->diffInSeconds($startTime);
                if($totalDuration > 30){
                    $cancel_booking = [
                        'booking_id' => $bVal['id'],
                        'from_canceled' => 3,
                        'cancel_reason' => 'Auto Cancel'
                    ];
                    AssistantCancelBooking::create($cancel_booking);
                    
                    $update_assistant_data = [
                        'booking_status' => 4
                    ];
                    $update_assistant = AssistantBoyBooking::where('id', $bVal['id'])->update($update_assistant_data);
                    $customer_det = json_decode($bVal['customer_meta'], true);
                    if($update_assistant){
                        //Email code here
                        $data = array(
                            'subject' => 'Booking Request Cancelled #' . $bVal['booking_id'],
                            'email' => 'harapriyamahanta9@gmail.com',//$customer_det['patient_email'],
                            'booking_id' => $bVal['booking_id'],
                            'logo_url' => env('LOGO_URL'),
                        );
                        if(env('APP_ENV')!='local'){
                        $email = Mail::send('frontend-source.emails.auto-cancel-booking', compact('data'), function($message) use ($data) {
                            $message->to($data['email']);
                            $message->subject($data['subject']);
                            $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                        });
                        
                        $adminEmail = Mail::send('frontend-source.emails.auto-cancel-booking', compact('data'), function($message) use ($data) {
                            $message->to(Helper::adminInfo()->email);
                            $message->subject($data['subject']);
                            $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                        });
                        }
                        $response = ['code' => 200, 'response' => "SUCCESS", 'message' => 'Request canceled successfully'];
                    } else {
                        $response = ['code' => 201, 'response' => "ERROR", 'message' => 'Request canceled not updated'];
                    }
                }
            }
        }
        print_r(json_encode($response)); exit;
    }

    public function SendReminderToVendor(){
        $commisionlist = BookingCommision::with('vendor','vendornotify')->orderBy('id','DESC')
        ->select('*',DB::raw("SUM(admin_amt) as totalAmount"))->where('admin_status','unpaid')
        ->groupBy('vendor_id')->get();
        //dd($commisionlist);
        foreach($commisionlist as $comm){
            if($comm->totalAmount >= 1000 && count($comm->vendornotify) <=15){
                $total = 15 - count($comm->vendornotify);

                $notify = new Notification();
                $notify->to_user = $comm->vendor_id;
                $notify->from_user = 1;
                $notify->to_user_type = 'vendor';
                $notify->from_user_type = 'admin';
                $notify->notification_type = 'Booking Commision Request';
                $notify->notification_message = 'Booking Commision need to deposit in '.$total.' days';
                $notify->status = 'Sent';
                $notify->save();

                $data = array(
                    'subject' => 'Booking Commision Request',
                    'email' => 'harapriyamahanta9@gmail.com',//$comm->vendor->email,
                    'name' => $comm->vendor->first_name.' '.$comm->vendor->last_name,
                    'logo_url' => env('LOGO_URL'),
                    'notification' => $notify
                );
                if(env('APP_ENV')!='local'){
                    $email = Mail::send('frontend-source.emails.commision-request-booking', compact('data'), function($message) use ($data) {
                        $message->to($data['email']);
                        $message->subject($data['subject']);
                        $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                    });
                }

            }

        
            if($comm->totalAmount >= 1000 && count($comm->vendornotify) ==15){
                foreach($comm->vendornotify as $com_notfy){

                    $com_notfy->status = 'expired';
                    $com_notfy->save();

                }
                $customer = Customer::where('id',$comm->vendor_id)->first();
                $customer->status = 2;
                $customer->admin_pay_due = 1;
                $customer->save();

            }
        }
        
    }
    public function BookingAfterDate(Request $request){

        $date = new DateTime;
        //$date->modify('-' . $assistant_config['auto_forward_request'] . ' minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $bk_assistant_data = AssistantBoyBooking::select('id','assistant_boy_id','assistant_boy_meta','customer_meta','book_date','booking_id','booking_status','fwrd_status','created_at')
        ->where([['booking_status', '=', 1]])->get();

    }
}