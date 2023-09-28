<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Customer;
use Session;
use Hash;
use Config;
use App\AccountType;

class LoginController extends \App\Http\Controllers\Controller {

    public function login(Request $request) {
        $validate = $this->validateLogin($request);
        if ($validate['error']) {
            if(isset($request->request_from)){
                return redirect($request->request_from)->with('error', $validate['message'])->withInput();
            } else {
                return redirect('/login')->with('error', $validate['message'])->withInput();
            }
        }
        Session::put('userId', $validate['data']['id']);
        Session::put('accountId', $validate['data']['account_id']);
        Session::put('accountStatus', $validate['data']['status']);
        Session::put('accountduepay', $validate['data']['admin_pay_due']);
        Session::put('userName', $validate['data']['first_name']);
        Session::put('phone', $validate['data']['phone']);
        Session::put('user', $validate['data']);
        if(isset($request->request_from)){
            return redirect($request->request_from)->with('success', $validate['message']);
        } else {
            return redirect('/user-type');
        }
    }

    protected function validateLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $customer = Customer::where('email', $request->input('email'))->first();
        if (!empty($customer)) {
            if (Hash::check($request->password, $customer->password)) {
                if ($customer->status == 1) {
                    $response = array("error" => false, "data" => $customer, "message" => "Login success");
                } elseif ($customer->status == 2) {
                    // $response = array("error" => true, "message" => "Your account has been blocked. Please contact the administrator");
                    $response = array("error" => false, "data" => $customer, "message" => "Login success");
                } else {
                    $response = array("error" => true, "message" => "Please verify your email address");
                }
            } else {
                $response = array("error" => true, "message" => "Please enter correct password");
            }
        } else {
            $response = array("error" => true, "message" => "The email address doesn't exist in the system");
        }
        return $response;
    }

    public function userType() {
        if (Session::get('userId')) {
            if (!empty(Session::get('accountId'))) {
                $account_type = array_search(Session::get('accountId'), Config::get('constants.accountType'));
                return redirect($account_type . '/dashboard');
            } else {
                $types = AccountType::where('status', 1)->get();
                return view('frontend-source.user-type', compact('types'));
            }
        } else {
            return redirect('/login');
        }
    }
    
    public function confirmAccount(Request $request){
        if(!empty($request['account_type'])){
            if($request['account_type'] == 1){
                $formJson = file_get_contents(base_path('resources/data/user/form.json'));
            }elseif($request['account_type'] == 2){
                $formJson = file_get_contents(base_path('resources/data/assistant/form.json'));
            } elseif ($request['account_type'] == 3) {
                $formJson = file_get_contents(base_path('resources/data/doctor/form.json'));
            } elseif ($request['account_type'] == 4) {
                $formJson = file_get_contents(base_path('resources/data/vendor/form.json'));
            } elseif ($request['account_type'] == 5) {
                $formJson = file_get_contents(base_path('resources/data/deliveryboy/form.json'));
            }
            $form = fields(json_decode($formJson, true));
            if(Session::get('userId')){
                $customer_data = Customer::select('id','first_name','last_name','email','phone')->where('id', Session::get('userId'))->first();
                $data['first_name'] = $customer_data->first_name;
                $data['last_name'] = $customer_data->last_name;
                $data['email'] = $customer_data->email;
                $data['phone'] = $customer_data->phone;
                
                $dom = [];
                foreach($form as $key=>$val){
                    foreach ($data as $k=>$v){
                        if($k == $val){
                            $dom[$val] = $v;
                            break;
                        } else {
                            $dom[$val] = '';
                        }
                    }
                }
                
                $update_array = [
                    'account_id' => $request['account_type'],
                    'meta' => json_encode($dom)
                ];
                Customer::where('id', Session::get('userId'))->update($update_array);
                Session::put('accountId', $request['account_type']);
                $account_type = array_search($request['account_type'], Config::get('constants.accountType'));
                $url = env('APP_URL').$account_type.'/dashboard';
                $response = ['response' => "success", 'url' => $url, 'msg' => "User updated successfully"];
            } else {
                $response = ['response' => "error", 'msg' => "Invalid user"];
            }
        } else {
            $response = ['response' => "error", 'msg' => "Please select an account"];
        }
        return json_encode($response);
    }
}
