<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Customer;
use App\AccountType;
use Auth;
use Mail;
use App\Helpers\CustomerHelper;
use Config;
use App\AssistantBoyBooking;
use App\AssistantFwrdBooking;
use App\AssistantCancelBooking;
use DB;

/**
 * Booking controller class
 *
 * @author "Trideep Dakua <trideepdakua@gmail.com>"
 * @category Controller
 */

class BookingController extends Controller
{
    /**
     * Construct of class
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function bookings(Request $request, AssistantBoyBooking $data)
    {
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "Bookings"]
        ];
        $input_value = $request->all();
        $filters = [];
        $filters['booking_status']  = isset($input_value['booking_status']) ? $input_value['booking_status'] : '';
        $filters['from_date']       = isset($input_value['from_date']) ? date('Y-m-d', strtotime($input_value['from_date'])) : '';
        $filters['to_date']         = isset($input_value['to_date']) ? date('Y-m-d', strtotime($input_value['to_date'])) : '';

        $data = $data->newQuery();
        if (!empty($filters['booking_status'])) {
            $data->where('booking_status', $filters['booking_status']);
        }
        if (!empty($filters['from_date'])) {
            $data->where('created_at', '>=', $filters['from_date']);
        }
        if (!empty($filters['to_date'])) {
            $data->where('created_at', '<=', $filters['to_date']);
        }
        $bookings = $data->get();
        //dd($bookings);
        return view('pages.bookings', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'bookings' => $bookings]);
    }

    public function bookingDetails($bookingId)
    {
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "Bookings"]
        ];
        $data = AssistantBoyBooking::with('FwrdData', 'reviewData')->where('booking_id', $bookingId)->first();
        return view('pages.booking-details', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'value' => $data]);
    }


    public function findServiceArea(Request $request)
    {
        $assistantBoyFormJson = file_get_contents(base_path('resources/data/assistant/form.json'));
        $value = json_decode($assistantBoyFormJson, true);
        $response = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'service_area') {
                $response[$val['node_code']] = $val['options'];
            }
        }
        if(count($response)) {
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'data' => json_encode($response)]);
        } else {
            return response()->json(['code' => 201, 'response' => "ERROR", 'message' => 'No data found!']);
        }
    }

    public function findAssistant(Request $request)
    {
        $booking_data = AssistantBoyBooking::select('id', 'pickup_status')->where('id', $request->booking_id)->first();
        $get_all_assistant = Customer::select('id', 'meta')->where([['account_id', '=', Config::get('constants.accountType.assistant')],['status', '=', 1],['online_status', '=', 1],['admin_status', '=', 1]])->get();
        $assistant = [];
        foreach($get_all_assistant as $key=>$val){
            $assistant_meta = CustomerHelper::decodeAssistantData(json_decode($val['meta'], true));

            $pickup_status = 0;
            if($booking_data->pickup_status && isset($assistant_meta['is_bike']) && $assistant_meta['is_bike']) {
                $pickup_status = 1;
            }
            //echo $pickup_status;
            if($assistant_meta['service_area'] == $request->service_area && $pickup_status == $booking_data->pickup_status) {
                $assistant[$key]['assistant_id']    = $val['id'];
                $assistant[$key]['assistant_name']  = $assistant_meta['first_name'].' '.$assistant_meta['last_name'];
                $assistant[$key]['assistant_image'] = file_exists(public_path('assistant/'. $assistant_meta['photo'])) ? asset('assistant/'. $assistant_meta['photo']) : asset('frontend-source/images/assistant-boy-icon.png');
            }
        }
        if(count($assistant)) {
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'data' => json_encode($assistant)]);
        } else {
            return response()->json(['code' => 201, 'response' => "ERROR", 'message' => 'No data found!']);
        }
    }

    public function assignAssistant(Request $request)
    {
        $configData = CustomerHelper::configData('admin_config');
        $msg_position = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        $assistant = Customer::select('id', 'meta')->where([['id','=',$request->assistant_id], ['account_id', '=', Config::get('constants.accountType.assistant')],['status', '=', 1],['online_status', '=', 1],['admin_status', '=', 1]])->first();
        $assistant_meta = CustomerHelper::decodeAssistantData(json_decode($assistant->meta, true));

        $booking_data = AssistantBoyBooking::select('id', 'customer_meta', 'book_date', 'booking_id', 'booking_status', 'arrival_time', 'pickup_status')->where('id', $request->booking_id)->first();

        $admin_info = Helper::adminInfo();
        $admin_meta['name'] = $admin_info->name;
        $admin_meta['email'] = $admin_info->email;
        $admin_meta['photo'] = env('LOGO_URL');

        $fwrd_data['booking_id'] = $request->booking_id;
        $fwrd_data['assistant_boy_fwrd_from_id'] = null;
        $fwrd_data['assistant_boy_fwrd_from_meta'] = json_encode($admin_meta);
        $fwrd_data['assistant_boy_fwrd_comment'] = 'Assigned By Admin';
        $fwrd_data['assistant_boy_fwrd_to_id'] = $request->assistant_id;
        $fwrd_data['assistant_boy_fwrd_to_meta'] = json_encode($assistant_meta);
        $fwrd_customer = AssistantFwrdBooking::create($fwrd_data);
        if($fwrd_customer) {
            if($booking_data->booking_criteria == 1) {
                $price = $assistant_meta['day_charges'];
            } elseif($booking_data->booking_criteria == 2) {
                $price = $assistant_meta['night_charges'];
            } else {
                $price = $assistant_meta['day_charges'] + $assistant_meta['night_charges'];
            }

            if($booking_data->pickup_status) {
                $explode_arrival  = explode('-', $booking_data->arrival_km);
                $price            = $price+(($explode_arrival[0]+Config::get('constants.distanceKm'))*$assistant_meta['per_km_harges']);
            }

            $update_assistant_data = [
                'assistant_boy_id' => $request->assistant_id,
                'assistant_boy_meta' => json_encode($assistant_meta),
                'total_price' => $assistant_meta['day_charges'],
                'grand_price' => $assistant_meta['day_charges']
            ];
            $update_assistant = AssistantBoyBooking::where('id', $request->booking_id)->update($update_assistant_data);
            if($update_assistant) {
                //Email code here
                //Assistant Email
                $assistant_config = CustomerHelper::configData('assistant_config');
                $data = array(
                    'subject'               => 'New Booking Assigned By Admin #' . $booking_data->booking_id,
                    'email'                 => $assistant_meta['email'],
                    'customer_meta'         => json_decode($booking_data->customer_meta, true),
                    'booking_id'            => $booking_data->booking_id,
                    'book_date'             => $booking_data->book_date,
                    'arrival_time'          => $booking_data->arrival_time,
                    'pickup_status'         => $booking_data->pickup_status,
                    'auto_forward_request'  => $assistant_config['auto_forward_request'],
                    'logo_url'              => env('LOGO_URL'),
                );
                if(env('APP_ENV')!='local'){
                $email = Mail::send(
                    'frontend-source.emails.admin-assign-booking', compact('data'), function ($message) use ($data) {
                        $message->to($data['email']);
                        $message->subject($data['subject']);
                        $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                    }
                );
                }
                //End email function
                return response()->json(['code' => 200, 'msg_position' => $msg_position, 'response' => "SUCCESS", 'message' => 'You have successfully Assigned']);
            } else {
                return response()->json(['code' => 201, 'msg_position' => $msg_position, 'response' => "ERROR", 'message' => 'Assistant not updated']);
            }
        } else {
            return response()->json(['code' => 202, 'msg_position' => $msg_position, 'response' => "ERROR", 'message' => 'Forwarded data not inserted']);
        }
    }

    public function cancelBooking(Request $request)
    {
        $configData = CustomerHelper::configData('admin_config');
        $msg_position = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        $cancel_booking = AssistantCancelBooking::create($request->all());
        if ($cancel_booking) {
            $update_status = AssistantBoyBooking::where('id', $request->booking_id)->update(['booking_status' => 4]);

            $det = AssistantBoyBooking::select('id', 'assistant_boy_meta', 'customer_meta', 'booking_id')->where('id', $request->booking_id)->first();
            $customer_det = json_decode($det->customer_meta, true);
            $assistant_boy_det = json_decode($det->assistant_boy_meta, true);
            //Send to email
            //User Email
            $data = array(
                'email' => $customer_det['patient_email'],
                'subject' => 'Booking Request Cancelled #' . $det->booking_id,
                'customer_det' => $customer_det,
                'assistant_boy_det' => $assistant_boy_det,
                'cancel_reason' => $request->cancel_reason,
                'booking_id' => $det->booking_id,
                'logo_url' => env('LOGO_URL'),
            );
            $email = Mail::send(
                'frontend-source.emails.admin-cancel-booking', compact('data'), function ($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject($data['subject']);
                    $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                }
            );

            if ($update_status) {
                return response()->json(
                    [
                      'code' => 200,
                      'msg_position' => $msg_position,
                      'response' => "SUCCESS",
                      'message' => 'You have successfully cancelled booking ID: '. $det->booking_id
                    ]
                );
            } else {
                return response()->json(
                    [
                      'code' => 204,
                      'msg_position' => $msg_position,
                      'response' => "ERROR",
                      'message' => 'Please try again!'
                    ]
                );
            }
        } else {
            return response()->json(
                [
                  'code' => 205,
                  'msg_position' => $msg_position,
                  'response' => "ERROR",
                  'message' => 'Please try again!'
                ]
            );
        }
    }


}
