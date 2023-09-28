<?php

namespace App\Helpers;

use App\Customer;
use Config;
use App\Helpers\Helper;
use App\AssistantBoyBooking;
use Session;
use App\CustomerPrescription;
use App\Reason;
use Illuminate\Support\Facades\Crypt;

class CustomerHelper {

    public static function customerInfo($id) {
        $customerInfo = Customer::where('id', $id)->first();
        return $customerInfo;
    }

    public static function getSlugUrl($urlString) {
        if (strpos($urlString, '/') !== false) {
            $str = explode('/', $urlString);
            $ext = end($str);
        } else {
            echo $urlString;
            exit;
            $ext = pathinfo($urlString, PATHINFO_EXTENSION);
        }
        return $ext;
    }

    public static function customerStatus($status = 0) {
        switch ($status) {
            case 0:
              $cStatus = "NOT VERIFIED";
              break;
            case 1:
              $cStatus = "ACTIVE";
              break;
            case 2:
              $cStatus = "RESTRICTED";
              break;
            default:
              $cStatus = "NOT VERIFIED";
        }
        return $cStatus;
    }
    
    public static function customerOnlineStatus($status = 1) {
        switch ($status) {
            case 0:
              $cStatus = "Offline";
              break;
            case 1:
              $cStatus = "Online";
              break;
            default:
              $cStatus = "Online";
        }
        return $cStatus;
    }

    public static function customerAdminStatus($status = 0) {
        switch ($status) {
            case 0:
              $cStatus = "PENDDING";
              break;
            case 1:
              $cStatus = "VERIFIED";
              break;
            default:
              $cStatus = "PENDDING";
        }
        return $cStatus;
    }
    
    public static function bookingCriteriaStatus($status = 1){
        switch ($status) {
            case 1:
              $cStatus = "Day Booking";
              break;
            case 2:
              $cStatus = "Night Booking";
              break;
            case 3:
              $cStatus = "24 Hours";
              break;
            default:
              $cStatus = "Day Booking";
        }
        return $cStatus;
    }
    
    public static function bookingStatus($status = 0){
        switch ($status) {
            case 0:
              $cStatus = 'Failed';
              break;
            case 1:
              $cStatus = 'Booked';
              break;
            case 2:
              $cStatus = 'Accepted';
              break;
            case 3:
              $cStatus = 'OnBusy';
              break;
            case 4:
              $cStatus = 'Cancelled';
              break;
            case 5:
              $cStatus = 'Completed';
              break;
            default:
              $cStatus = "Booked";
        }
        return $cStatus;
    }
    
    public static function prescriptionsStatus($status = 1){
        switch ($status) {
            case 0:
              $cStatus = 'Cancelled';
              break;
            case 1:
              $cStatus = 'Uploaded';
              break;
            case 2:
              $cStatus = 'Assigned To Vendor';
              break;
            case 3:
              $cStatus = 'Pending From Customer';
              break;
            case 4:
              $cStatus = 'Confirmed';
              break;
            case 5:
              $cStatus = 'Ready To Packaging';
              break;
            case 6:
              $cStatus = 'Delivered';
              break;
            case 7:
              $cStatus = 'Return';
              break;
            case 8:
              $cStatus = 'Returned';
              break;
            case 9:
              $cStatus = 'Waiting For Payment Approval';
              break;
            case 10:
              $cStatus = 'Waiting For Delivery Boy';
              break;
            case 11:
              $cStatus = 'Dispatched';
              break;
            default:
              $cStatus = "Uploaded";
        }
        return $cStatus;
    }

    public static function decodeAssistantData($value = []) {
        //dd($value);
        $response = [];
        if (!empty($value)) {
            $formJson = json_decode(file_get_contents(base_path('resources/data/assistant/form.json')),true);
            foreach ($formJson as $key => $val) {
                if(!empty($value[$val['node_code']]))
                {
                    $response[$val['node_code']] = $value[$val['node_code']];
                    //get Gender name
                    if ($val['node_code'] == 'gender') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($v['option_value'] == $value['gender']) {
                                array_push($child_array, $v);
                            }
                        }
                        $response[$val['node_code']] = @$child_array[0]['option_value'];
                    }
                    //get State name
                    if ($val['node_code'] == 'state') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($v['option_value'] == $value['state']) {
                                array_push($child_array, $v);
                            }
                        }
                        $response[$val['node_code']] = @$child_array[0]['option_value'];
                    }
                    //get Dist name
                    if ($val['node_code'] == 'dist') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($v['option_value'] == $value['dist']) {
                                array_push($child_array, $v);
                            }
                        }
                        $response[$val['node_code']] = @$child_array[0]['option_value'];
                    }
                    
                    //get Day charges
                    // if ($val['node_code'] == 'day_charges') {
                    //     $child_array = [];
                    //     foreach ($val['options'] as $k => $v) {
                    //         if ($v['option_value'] == $value['day_charges']) {
                    //             array_push($child_array, $v);
                    //         }
                    //     }

                    //     $response[$val['node_code']] = @$child_array[0]['option_value'];
                    // }
                    
                    //get Night charges
                    // if ($val['node_code'] == 'night_charges') {
                    //     dd($value['night_charges']);
                    //     $child_array = [];
                    //     foreach ($val['options'] as $k => $v) {
                    //         if ($v['option_value'] == $value['night_charges']) {
                    //             array_push($child_array, $v);
                    //         }
                    //     }
                    //     dd($child_array);
                    //     $response[$val['node_code']] = @$child_array[0]['option_value'];
                    // }
                    //get Available
                    if ($val['node_code'] == 'available') {
                        $child_array = [];
                        if(!is_array($value['available'])){
                        $value['available'] = explode(',',$value['available']);
                        }
                        foreach ($val['options'] as $k => $v) {
                            if ($k > 0 && in_array($v['option_value'], $value['available'])) {
                                array_push($child_array, $v);
                            }
                        }
                        if(is_array($child_array) && count($child_array) == 7){
                            $response[$val['node_code']] = 'All Days';
                        } else {
                            $response[$val['node_code']] = implode(', ', array_map(function ($entry) {
                                    return $entry['option_label'];
                                }, $child_array));
                        }
                    }
                    //get SERVICE AREA
                    if ($val['node_code'] == 'service_area') {
                        $child_array = [];
                        
                        foreach ($val['options'] as $k => $v) {
                            if ($v['option_value'] == $value['service_area']) {
                                array_push($child_array, $v);
                            }
                        }
                        
                        $response[$val['node_code']] = @$child_array[0]['option_value'];
                    }
                    //get KM RANGE
                    if ($val['node_code'] == 'km_range') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($v['option_value'] == $value['km_range']) {
                                array_push($child_array, $v);
                            }
                        }
                        @$response[$val['node_code']] = @$child_array[0]['option_value'];
                    }
                }
            }
        }
        if (!empty($response)) {
            if (!empty($response['dob'])) {
                $dob_explode = explode('-', $response['dob']);
                $dob_year = date('Y') - end($dob_explode);
                $response['dob_year'] = $dob_year;
            }
        }
        return $response;
    }

    public static function decodeDoctorData($value = []) {
        $response = [];
        if (!empty($value)) {
            $formJson = json_decode(file_get_contents(base_path('resources/data/doctor/form.json')),true);
            foreach ($formJson as $key => $val) {
                if(!empty($value[$val['node_code']]))
                {
                    $response[$val['node_code']] = $value[$val['node_code']];
                    //get State name
                    if ($val['node_code'] == 'gender') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($k == $value['gender']) {
                                array_push($child_array, $v);
                            }
                        }
                        $response[$val['node_code']] = $child_array[0]['option_value'];
                    }
                    //get Dist name
                    if ($val['node_code'] == 'hospital_availability') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($k == $value['hospital_availability']) {
                                array_push($child_array, $v);
                            }
                        }
                        $response[$val['node_code']] = $child_array[0]['option_value'];
                    }
                }
            }
        }
        return $response;
    }
    
    public static function decodeUserData($value = []) {
        $response = [];
        if (!empty($value)) {
            $formJson = json_decode(file_get_contents(base_path('resources/data/user/form.json')),true);
            foreach ($formJson as $key => $val) {
                if(!empty($value[$val['node_code']]))
                {
                    $response[$val['node_code']] = $value[$val['node_code']];
                }
            }
        }
        
        return $response;
    }
    
    public static function decodeVendorData($value = []){
        $response = [];
        if (!empty($value)) {
            $formJson = json_decode(file_get_contents(base_path('resources/data/vendor/form.json')),true);
            foreach ($formJson as $key => $val) {
                if(!empty($value[$val['node_code']]))
                {
                    $response[$val['node_code']] = $value[$val['node_code']];
                    //get State name
                    if ($val['node_code'] == 'state') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($k == $value['state']) {
                                array_push($child_array, $v);
                            }
                        }
                        $response[$val['node_code']] = $child_array[0]['option_value'];
                    }
                    //get Dist name
                    if ($val['node_code'] == 'dist') {
                        $child_array = [];
                        foreach ($val['options'] as $k => $v) {
                            if ($k == $value['dist']) {
                                array_push($child_array, $v);
                            }
                        }
                        $response[$val['node_code']] = $child_array[0]['option_value'];
                    }
                }
            }
        }
        return $response;
    }
    
    public static function configData($config_name = 'user_config'){
        $response = [];
        $config = Helper::configuration();
        if(!empty($config[$config_name])){
            $encode_config = json_encode($config[$config_name]);
            $decode_config = json_decode($encode_config, true);
            foreach ($decode_config['configs'] as $key => $val) {
                $response[$val['node_code']] = $val['node_value'];
            }
        }
        return $response;
    }
    
    public static function toastrMsgPositionClass($position = 4) {
        return array_search($position, Config::get('constants.toastr_msg_position'));
    }
    
    public static function searchArray($array = [], $search_list = []){
        $result = array();
        if(count($array)){
            foreach ($array as $key => $value) {
                if(!empty($search_list)){
                    foreach ($search_list as $k => $v) {
                        if ($k == 'service_area'){
                            if (!in_array($value[$k], $v)){
                                continue 2;
                            }
                        }
                        if ($k == 'available') {
                            if(!isset($value[$k]) || !is_array($value[$k]) || !is_array($v) || !count(array_intersect($value[$k], $v))) {
                                continue 2;
                            }
                        }
                        if ($k != 'service_area' && $k != 'available') {
                            if (!isset($value[$k]) || $value[$k] != $v) {
                                continue 2;
                            }
                        }
                    }
                    $result[] = $value;
                }
            }
        }
        return $result;
    }
    
    public static function createTimeRange($sT, $eT){
        //echo $sT.'=='.$eT; exit;
        $times   = array();
        $startTime = strtotime($sT);
        $endTime   = strtotime($eT);
        $returnTimeFormat = 'h:i A';
        $current = time();
        $addTime = strtotime('+'.Config::get('constants.bookINTVL').' Minutes', $current);
        $diff    = sprintf("%02d", $addTime) - sprintf("%02d", $current);
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime); 
            $startTime += $diff; 
        } 
        $times[] = date($returnTimeFormat, $startTime); 
        return $times;
    }
    
    public static function noOfAssistant(){
        return Customer::where('account_id',Config::get('constants.accountType.assistant'))->count();
    }
    
    public static function noOfUser(){
        return Customer::where('account_id',Config::get('constants.accountType.user'))->count();
    }
    
    public static function noOfDoctor(){
        return Customer::where('account_id',Config::get('constants.accountType.doctor'))->count();
    }
    
    public static function noOfVendor(){
        return Customer::where('account_id',Config::get('constants.accountType.vendor'))->count();
    }
    
    public static function medicalMateStatistics($status = []){
        if(Session::get('accountId') == Config::get('constants.accountType.user')){
            $column = 'customer_id';
        }
        if(Session::get('accountId') == Config::get('constants.accountType.assistant')){
            $column = 'assistant_boy_id';
        }
        return AssistantBoyBooking::where($column, Session::get('userId'))->whereIn('booking_status', $status)->count();
    }
    
    public static function customerPrescriptionStatistics($status = []){
        return CustomerPrescription::where('customer_id', Session::get('userId'))->whereIn('customer_status', $status)->count();
    }
    
    public static function getReasons($accountId = 1, $resonType = 'restricted'){
        return Reason::select('reasons')->where([['account_id','=',$accountId],['reason_type','=',$resonType]])->first();
    }

    public static function setdataencrypt($msg){
        return $encrypted = Crypt::encryptString($msg);
    }
    public static function getdataencrypt($msg){
        return $encrypted = Crypt::decryptString($msg);
    }
}
