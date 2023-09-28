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

class ForwardCronJobController extends \App\Http\Controllers\Controller
{
    public function autoForwardRequest(){
        $response = [];
        $assistant_config = CustomerHelper::configData('assistant_config');
        $date = new DateTime;
        $date->modify('-' . $assistant_config['auto_forward_request'] . ' minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        //DB::enableQueryLog();
        $bk_assistant_data = AssistantBoyBooking::select('id','assistant_boy_id','assistant_boy_meta','book_date','booking_id','booking_status','fwrd_status','created_at','booking_criteria','total_price')->where([['created_at', '>=', $formatted_date],['booking_status', '=', 1],['fwrd_status', '=', 0]])->get();
        //dd(DB::getQueryLog());
        //dd($bk_assistant_data);
        if($bk_assistant_data->isNotEmpty()){
            foreach($bk_assistant_data as $bKey => $bVal){
                $bk_decode_assistant_data = json_decode($bVal['assistant_boy_meta'],true);
                $bk_service_area = $bk_decode_assistant_data['service_area'];
                
                $find_fwrd_assistant = AssistantFwrdBooking::where([['booking_id', '=', $bVal['id']]])->get();
                $fwrd_assistant_ids = [];
                if($find_fwrd_assistant->isNotEmpty()){
                    foreach($find_fwrd_assistant as $fwrdKey=>$fwrdVal){
                        if(!in_array($fwrdVal['assistant_boy_fwrd_to_id'], $fwrd_assistant_ids, true)){
                            array_push($fwrd_assistant_ids, $fwrdVal['assistant_boy_fwrd_to_id']);
                        }

                        if(!in_array($fwrdVal['assistant_boy_fwrd_from_id'], $fwrd_assistant_ids, true)){
                            array_push($fwrd_assistant_ids, $fwrdVal['assistant_boy_fwrd_from_id']);
                        }
                    }
                }
                $get_all_assistant = Customer::select('id','meta')->where([['account_id', '=', Config::get('constants.accountType.assistant')],['status', '=', 1],['online_status', '=', 1],['admin_status', '=', 1]])->whereNotIn('id',$fwrd_assistant_ids)->get();
                
                $sm_area_assistant = [];
                $sm_assistant_ids = [];
                if($get_all_assistant->isNotEmpty()){
                    foreach($get_all_assistant as $key=>$val){
                        $assistant_meta = CustomerHelper::decodeAssistantData(json_decode($val['meta'], true));
                        $pickup_status = 0;
                        if($bVal['pickup_status'] && isset($assistant_meta['is_bike']) && $assistant_meta['is_bike']){
                            $pickup_status = 1;
                        }
                        if($assistant_meta['service_area'] == $bk_service_area && $val['id'] != $bVal['assistant_boy_id'] && $pickup_status == $bVal['pickup_status']){
                            if($bVal['booking_criteria'] == 1) {
                                $assistant_price = $assistant_meta['day_charges'];
                            } elseif($bVal['booking_criteria'] == 2) {
                                $assistant_price = $assistant_meta['night_charges'];
                            } else {
                                $assistant_price = $assistant_meta['day_charges'] + $assistant_meta['night_charges'];
                            }
                            
                            if($bVal['pickup_status']){
                                $explode_arrival = explode('-', $bVal['arrival_km']);
                                $assistant_price = $assistant_price+(($explode_arrival[0]+Config::get('constants.distanceKm'))*$assistant_meta['per_km_harges']);
                            }
                            
                            if($bVal['total_price'] == $assistant_price){
                                $check_book_date = AssistantBoyBooking::where([['assistant_boy_id', '=', $val['id']],['book_date', '=', $bVal['book_date']]])->count();
                                if(empty($check_book_date)){
                                    $sm_area_assistant[$key]['assistant_id'] = $val['id'];
                                    $sm_area_assistant[$key]['assistant_meta'] = $assistant_meta;
                                    array_push($sm_assistant_ids,$val['id']);
                                }
                            }
                        }
                    }
                }
                
                if(count($sm_assistant_ids)){
                    $rand_key = array_rand($sm_assistant_ids,1);
                    $assistant_boy_fwrd_to_id = $sm_assistant_ids[$rand_key];
                    $assistant_boy_fwrd_to_meta = [];
                    foreach($sm_area_assistant as $smMetaKey => $smMetaVal){
                        if($smMetaVal['assistant_id'] == $assistant_boy_fwrd_to_id){
                            array_push($assistant_boy_fwrd_to_meta, $smMetaVal['assistant_meta']);
                        }
                    }

                    $fwrd_data['booking_id'] = $bVal['id'];
                    $fwrd_data['assistant_boy_fwrd_from_id'] = $bVal['assistant_boy_id'];
                    $fwrd_data['assistant_boy_fwrd_from_meta'] = $bVal['assistant_boy_meta'];
                    $fwrd_data['assistant_boy_fwrd_comment'] = 'Auto forwarding';
                    $fwrd_data['assistant_boy_fwrd_to_id'] = $assistant_boy_fwrd_to_id;
                    $fwrd_data['assistant_boy_fwrd_to_meta'] = json_encode($assistant_boy_fwrd_to_meta[0]);
                    $fwrd_customer = AssistantFwrdBooking::create($fwrd_data);
                    if($fwrd_customer){
                        if($bVal['booking_criteria'] == 1){
                            $price = $assistant_boy_fwrd_to_meta[0]['day_charges'];
                        } elseif($bVal['booking_criteria'] == 2){
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
                        $update_assistant = AssistantBoyBooking::where('id', $bVal['id'])->update($update_assistant_data);
                        if($update_assistant){
                            //Email code here
                            $email_det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta','booking_id','book_date','arrival_time','pickup_status')->where('id', $bVal['id'])->first();
                            $assistant_email = json_decode($email_det->assistant_boy_meta, true);
                            //Assistant Email
                            $data = array(
                                'subject' => 'New Auto Forward Booking Request #' . $email_det->booking_id,
                                'email' => $assistant_email['email'],
                                'assistant_from_meta' => json_decode($bVal['assistant_boy_meta'], true),
                                'customer_meta' => json_decode($email_det->customer_meta, true),
                                'forward_reasons' => "Auto forwarding",
                                'booking_id' => $email_det->booking_id,
                                'book_date' => $email_det->book_date,
                                'arrival_time' => $email_det->arrival_time,
                                'pickup_status' => $email_det->pickup_status,
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
                            $response = ['code' => 200, 'response' => "SUCCESS", 'message' => ' Forwarded successfully'];
                        } else {
                            $response = ['code' => 201, 'response' => "ERROR", 'message' => 'Assistant not updated'];
                        }
                    } else {
                        $response = ['code' => 202, 'response' => "ERROR", 'message' => 'Forwarded data not inserted'];
                    }
                } else {
                    //Admin forward
                    $admin_info = Helper::adminInfo();
                    $admin_meta['name'] = $admin_info->name;
                    $admin_meta['email'] = $admin_info->email;
                    $admin_meta['photo'] = env('LOGO_URL');

                    $fwrd_data['booking_id'] = $bVal['id'];
                    $fwrd_data['assistant_boy_fwrd_from_id'] = $bVal['assistant_boy_id'];
                    $fwrd_data['assistant_boy_fwrd_from_meta'] = $bVal['assistant_boy_meta'];
                    $fwrd_data['assistant_boy_fwrd_comment'] = 'Auto forwarding';
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
                        $update_assistant = AssistantBoyBooking::where('id', $bVal['id'])->update($update_assistant_data);
                        if($update_assistant){
                            //Email code here
                            $email_det = AssistantBoyBooking::select('id','assistant_boy_meta','customer_meta','booking_id','book_date','arrival_time','pickup_status')->where('id', $bVal['id'])->first();
                            $assistant_email = json_decode($email_det->assistant_boy_meta, true);
                            
                            $data = array(
                                'subject' => 'New Auto Forward Booking Request #' . $email_det->booking_id,
                                'email' => $admin_meta['email'],
                                'assistant_from_meta' => json_decode($bVal['assistant_boy_meta'], true),
                                'customer_meta' => json_decode($email_det->customer_meta, true),
                                'forward_reasons' => "Auto forwarding",
                                'booking_id' => $email_det->booking_id,
                                'book_date' => $email_det->book_date,
                                'arrival_time' => $email_det->arrival_time,
                                'pickup_status' => $email_det->pickup_status,
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
                            $response = ['code' => 200, 'response' => "SUCCESS", 'message' => 'Forwarded successfully'];
                        } else {
                            $response = ['code' => 201, 'response' => "ERROR", 'message' => 'Assistant not updated'];
                        }
                    } else {
                        $response = ['code' => 202, 'response' => "ERROR", 'message' => 'Forwarded data not inserted'];
                    }
                }
                
            }
        } else {
            $response = ['code' => 202, 'response' => "ERROR", 'message' => 'No any Forwarding data'];
        }
        
        print_r(json_encode($response)); exit;
    }
    
    public function autoCancelRequest(){
        $response = [];
        $assistant_config = CustomerHelper::configData('assistant_config');
        $date = new DateTime;
        //$date->modify('-' . $assistant_config['auto_forward_request'] . ' minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $bk_assistant_data = AssistantBoyBooking::select('id','assistant_boy_id','assistant_boy_meta','customer_meta','book_date','booking_id','booking_status','fwrd_status','created_at')->where([['created_at', '>=', $formatted_date],['booking_status', '=', 1],['fwrd_status', '=', 1]])->get();
        
        if($bk_assistant_data->isNotEmpty()){
            foreach($bk_assistant_data as $bKey => $bVal){
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
                        'email' => $customer_det['patient_email'],
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
        print_r(json_encode($response)); exit;
    }
}
