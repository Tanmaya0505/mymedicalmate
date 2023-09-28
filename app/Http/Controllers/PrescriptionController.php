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
use App\CustomerPrescription;
use App\VendorPrescription;
use Config;

class PrescriptionController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function prescription(Request $request, CustomerPrescription $data){
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "Prescription listing"]
        ];
        $input_value = $request->all();
        $filters = [];
        $filters['customer_status']  = isset($input_value['customer_status']) ? $input_value['customer_status'] : '';
        $filters['from_date']       = isset($input_value['from_date']) ? date('Y-m-d', strtotime($input_value['from_date'])) : '';
        $filters['to_date']         = isset($input_value['to_date']) ? date('Y-m-d', strtotime($input_value['to_date'])) : '';
        
        $data = $data->newQuery();
        if (!empty($filters['customer_status'])) {
            $data->where('customer_status', $filters['customer_status']);
        }
        if (!empty($filters['from_date'])) {
            $data->where('created_at', '>=', $filters['from_date']);
        }
        if (!empty($filters['to_date'])) {
           $data->where('created_at', '<=', $filters['to_date']);
        }
        $orders = $data->get();
        
        $vendorFormJson = file_get_contents(base_path('resources/data/vendor/form.json'));
        $value = json_decode($vendorFormJson, true);
        $dist = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'dist') {
                $dist[$val['node_code']] = $val['options'];
            }
        }
        $categories = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'medicine_categories') {
                $categories[$val['node_code']] = $val['options'];
            }
        }
        $discount = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'discount') {
                $discount[$val['node_code']] = $val['options'];
            }
        }
        //dd($discount);
        return view('pages.prescription', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'data' => $orders, 'dist' => $dist['dist'], 'categories' => $categories['medicine_categories'], 'discount' => $discount['discount']]);
    }
    
    public function prescriptionDetails($orderId){
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "Prescription Details"]
        ];
        $data               = CustomerPrescription::where('order_id', '=', $orderId)->first();
        $prescription_photo = asset('prescription/'. $data['prescription_photo']);
        if(empty($data['prescription_photo']) || !file_exists(public_path('prescription/'. $data['prescription_photo']))){
            $prescription_photo = null;
        }
        $medicines          = json_decode($data->medicine, true);
        $delivery_address   = json_decode($data->delivery_address, true);
        
        $vendorFormJson = file_get_contents(base_path('resources/data/vendor/form.json'));
        $value = json_decode($vendorFormJson, true);
        $dist = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'dist') {
                $dist[$val['node_code']] = $val['options'];
            }
        }
        $categories = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'medicine_categories') {
                $categories[$val['node_code']] = $val['options'];
            }
        }
        $discount = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'discount') {
                $discount[$val['node_code']] = $val['options'];
            }
        }
        return view('pages.prescription-details', ['config' => $config, 
            'pageConfigs' => $pageConfigs, 
            'breadcrumbs' => $breadcrumbs, 
            'data' => $data, 
            'prescription_photo' => $prescription_photo, 
            'medicines' => $medicines, 
            'delivery_address' => $delivery_address,
            'dist' => $dist['dist'], 
            'categories' => $categories['medicine_categories'], 
            'discount' => $discount['discount']]);
    }
    
    public function findVendor(Request $request){
        $requestValue = [];
        if(!empty($request->dist)){
            $requestValue['dist'] = $request->dist;
        }
        if(!empty($request->categories)){
            $requestValue['medicine_categories'] = $request->categories;
        }
        if(!empty($request->discount)){
            $requestValue['discount'] = $request->discount;
        }
        
        $get_all_vendor = Customer::select('id','meta')->where([['account_id', '=', Config::get('constants.accountType.vendor')],['status', '=', 1],['admin_status', '=', 1]])->get();
        $vendor_meta    = [];
        foreach($get_all_vendor as $key=>$val){
            $vendor_meta[$key]  = json_decode($val['meta'], true);
            $vendor_meta[$key]['vendor_id']  = $val['id'];
        }
        $vendor = [];
        $res = CustomerHelper::searchArray($vendor_meta, $requestValue);
        if(!empty($res) && count($res)){
            foreach($res as $k=>$v){
                $vendor[$k]['vendor_id']    = $v['vendor_id'];
                $vendor[$k]['vendor_name']  = $v['name_of_store'];
                $vendor[$k]['vendor_image'] = $v['photo'];
            }
        }
        if(count($vendor)){
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'data' => json_encode($vendor)]);
        } else {
            return response()->json(['code' => 201, 'response' => "ERROR", 'message' => 'No data found!']);
        }
    }
    
    public function assignVendor(Request $request){
        $configData = CustomerHelper::configData('admin_config');
        $msg_position = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        if(!empty($request->vendor_id)){
            $insert_value = [];
            foreach($request->vendor_id as $key=>$val){
                $insert_value[$key]['vendor_id'] = $val;
                $insert_value[$key]['prescription_id'] = $request->prescription_id;
                $insert_value[$key]['created_at'] = date('Y-m-d h:i:s');
                $insert_value[$key]['updated_at'] = date('Y-m-d h:i:s');
            }
            $insert = VendorPrescription::insert($insert_value);
            if($insert){
                CustomerPrescription::find($request->prescription_id)->update(['customer_status'=>2]);
                return response()->json(['code' => 200, 'msg_position' => $msg_position, 'response' => "SUCCESS", 'message' => 'You have successfully Assigned']);
            } else {
                return response()->json(['code' => 201, 'msg_position' => $msg_position, 'response' => "ERROR", 'message' => 'Vendor not updated']);
            }
        } else {
            return response()->json(['code' => 201, 'msg_position' => $msg_position, 'response' => "ERROR", 'message' => 'Please try again!']);
        }
    }
    
}
