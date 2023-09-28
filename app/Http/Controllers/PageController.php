<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\User;
use Auth;
use Hash;
use App\Helpers\CustomerHelper;
use App\Configuration;

class PageController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    //Basic Tables
    public function userProfilePage() {
        $pageConfigs = ['bodyCustomClass' => 'menu-collapsed'];

        return view('pages.page-user-profile', ['pageConfigs' => $pageConfigs]);
    }

    //Page FAQ
    public function faqPage() {

        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/", "name" => "Home"], ["link" => "#", "name" => "Pages"], ["name" => "FAQ"]
        ];
        return view('pages.page-faq', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    //Page Knowledge Base
    public function knowledgeBasePage() {

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"], ["link" => "#", "name" => "Pages"], ["name" => "Knowledge-base"]
        ];
        return view('pages.page-knowledge-base', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    //Page Knowledge Base
    public function knowledgeCatPage() {

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"], ["link" => "#", "name" => "Pages"], ["link" => "page-knowledge-base", "name" => "Knowledge Base"], ["name" => "Categories"]
        ];
        return view('pages.page-knowledge-categories', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    //Page Knowledge Base
    public function knowledgeQuestionPage() {

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"], ["link" => "#", "name" => "Pages"], ["link" => "page-knowledge-base", "name" => "Knowledge Base"], ["link" => "page-knowledge-base/categories", "name" => "Categories"], ["name" => "Question"]
        ];
        return view('pages.page-knowledge-question', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    //Page search
    public function searchPage() {

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"], ["link" => "#", "name" => "Pages"], ["name" => "Search"]
        ];
        return view('pages.page-search', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    //Page account setting
    public function accountSettingPage() {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/cms-admin/", "name" => "Home"], ["name" => "Account Settings"]
        ];
        $adminInfo = Helper::adminInfo();
        $config = Helper::configuration();
        return view('pages.page-account-settings', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'adminInfo' => $adminInfo, 'config' => $config]);
    }

    public function updateGeneralInfo(Request $request) {
        $configData = CustomerHelper::configData('admin_config');
        $response = array();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $userId = User::find(auth()->user()->id);
        $profileUpdate = User::find($userId->id)->update($request->all());
        $response['msg_position'] = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        if ($profileUpdate) {
            $response['status'] = 'SUCCESS';
            $response['code'] = 200;
            $response['message'] = "General info updated successfully";
        } else {
            $response['status'] = 'ERROR';
            $response['code'] = 204;
            $response['message'] = "General info successfully not updated";
        }
        return json_encode($response);
        exit;
    }

    public function changePassword(Request $request) {
        $configData = CustomerHelper::configData('admin_config');
        $response = array();
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required',
            'con_password' => 'required|same:password',
        ]);
        $user = User::find(Auth()->user()->id);
        if (Hash::check($request->current_password, $user->password)) {
            $cngPassword = $user->fill(['password' => Hash::make($request->password)])->save();
            $response['msg_position'] = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
            if ($cngPassword) {
                $response['status'] = 'SUCCESS';
                $response['code'] = 200;
                $response['message'] = "Password changed successfully";
            } else {
                $response['status'] = 'ERROR';
                $response['code'] = 204;
                $response['message'] = "Password successfully not changed";
            }
        } else {
            $response['status'] = 'ERROR';
            $response['code'] = 205;
            $response['message'] = "Please enter your correct old password";
        }
        return json_encode($response);
        exit;
    }
    
    public function updateUserConfig(Request $request){
        $configData = CustomerHelper::configData('admin_config');
        $response = array();
        $req_data = $request->all();
        $data = Configuration::first();
        $source = json_decode($data->user_config);
        foreach($source->configs as $field) {
            if (isset($req_data[$field->node_code]) && !empty($req_data[$field->node_code])) {
                $field->node_value = $req_data[$field->node_code];
            }
        }
        $updateDetails = [
            'user_config' => json_encode($source)
        ];
        $update = Configuration::find(1)->update($updateDetails);
        $response['msg_position'] = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        if ($update) {
            $response['status'] = 'SUCCESS';
            $response['code'] = 200;
            $response['message'] = "User config updated successfully";
        } else {
            $response['status'] = 'ERROR';
            $response['code'] = 204;
            $response['message'] = "User config successfully not updated";
        }
        return json_encode($response);
        exit;
    }
    
    public function updateAssistantConfig(Request $request){
        $configData = CustomerHelper::configData('admin_config');
        $response = array();
        $req_data = $request->all();
        $data = Configuration::first();
        $source = json_decode($data->assistant_config);
        foreach($source->configs as $field) {
            if (isset($req_data[$field->node_code]) && !empty($req_data[$field->node_code])) {
                $field->node_value = $req_data[$field->node_code];
            }
        }
        $updateDetails = [
            'assistant_config' => json_encode($source)
        ];
        $update = Configuration::find(1)->update($updateDetails);
        $response['msg_position'] = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        if ($update) {
            $response['status'] = 'SUCCESS';
            $response['code'] = 200;
            $response['message'] = "Assistant config updated successfully";
        } else {
            $response['status'] = 'ERROR';
            $response['code'] = 204;
            $response['message'] = "Assistant config successfully not updated";
        }
        return json_encode($response);
        exit;
    }
    
    public function updateDoctorConfig(Request $request){
        $configData = CustomerHelper::configData('admin_config');
        $response = array();
        $req_data = $request->all();
        $data = Configuration::first();
        $source = json_decode($data->doctor_config);
        foreach($source->configs as $field) {
            if (isset($req_data[$field->node_code]) && !empty($req_data[$field->node_code])) {
                $field->node_value = $req_data[$field->node_code];
            }
        }
        $updateDetails = [
            'doctor_config' => json_encode($source)
        ];
        $update = Configuration::find(1)->update($updateDetails);
        $response['msg_position'] = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        if ($update) {
            $response['status'] = 'SUCCESS';
            $response['code'] = 200;
            $response['message'] = "Doctor config updated successfully";
        } else {
            $response['status'] = 'ERROR';
            $response['code'] = 204;
            $response['message'] = "Doctor config successfully not updated";
        }
        return json_encode($response);
        exit;
    }
    
    public function updateAdminConfig(Request $request){
        $configData = CustomerHelper::configData('admin_config');
        $response = array();
        $req_data = $request->all();
        $data = Configuration::first();
        $source = json_decode($data->admin_config);
        foreach($source->configs as $field) {
            if (isset($req_data[$field->node_code]) && !empty($req_data[$field->node_code])) {
                $field->node_value = $req_data[$field->node_code];
            }
        }
        $updateDetails = [
            'admin_config' => json_encode($source)
        ];
        $update = Configuration::find(1)->update($updateDetails);
        $response['msg_position'] = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        if ($update) {
            $response['status'] = 'SUCCESS';
            $response['code'] = 200;
            $response['message'] = "Admin config updated successfully";
        } else {
            $response['status'] = 'ERROR';
            $response['code'] = 204;
            $response['message'] = "Admin config successfully not updated";
        }
        return json_encode($response);
        exit;
    }
    
    public function updateVendorConfig(Request $request){
        $configData = CustomerHelper::configData('admin_config');
        $response = array();
        $req_data = $request->all();
        $data = Configuration::first();
        $source = json_decode($data->vendor_config);
        foreach($source->configs as $field) {
            if (isset($req_data[$field->node_code]) && !empty($req_data[$field->node_code])) {
                $field->node_value = $req_data[$field->node_code];
            }
        }
        $updateDetails = [
            'vendor_config' => json_encode($source)
        ];
        $update = Configuration::find(1)->update($updateDetails);
        $response['msg_position'] = CustomerHelper::toastrMsgPositionClass($configData['toastr_msg_position']);
        if ($update) {
            $response['status'] = 'SUCCESS';
            $response['code'] = 200;
            $response['message'] = "Vendor config updated successfully";
        } else {
            $response['status'] = 'ERROR';
            $response['code'] = 204;
            $response['message'] = "Vendor config successfully not updated";
        }
        return json_encode($response);
        exit;
    }
}
