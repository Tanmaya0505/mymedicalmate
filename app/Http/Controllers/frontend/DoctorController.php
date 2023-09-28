<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Customer;
use Config;
use Session;
use Image;
use App\Helpers\CustomerHelper;

class DoctorController extends \App\Http\Controllers\Controller {

    public function myaccount() {
        return view('frontend-source.customer-dashboard.dashboard');
    }
    
    public function userProfile(){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = Customer::where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        $meta = json_decode($data->meta, true);
        return view('frontend-source.customer-dashboard.user-profile', ['account_prefix' => $account_prefix,'data' => $data, 'meta' => $meta]);
    }
    
    public function updateUserProfile(Request $request)
    {
        $req_data = $request->all();
        $this->validate(
            $request, [
            
            'email' => 'required|email|unique:customers,email,'. Session::get('userId')
            
            ]
        );
        unset($req_data['_token']);
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        
        $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        $decode_data = json_decode($data->meta, true);
        
        //Upload photo
        if($request->hasFile('photo')){
            $config = CustomerHelper::configData('doctor_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];
            
            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {
                $img_path= public_path('doctor/' . $decode_data['photo']);
                if (file_exists($img_path)) {
                    unlink($img_path);
                }
            }
            //upload Image
            $photo = bcrypt(date('dmy').time().$request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/doctor/' . $res_photo);
            $req_data['photo'] = $res_photo;
        }else{
            $req_data['photo'] = $decode_data['photo'] ?? null;
        }
        
        //Upload identity information
        if($request->hasFile('identity_information')){
            if (isset($decode_data['identity_information']) && !empty($decode_data['identity_information'])) {
                $img_path= public_path('doctor_identity_information/' . $decode_data['identity_information']);
                if (file_exists($img_path)) {
                    unlink($img_path);
                }
            }
            //upload Image
            $identity_information = bcrypt(date('dmy').time().$request->input('last_name'));
            $res_identity_information = preg_replace("/[^A-Za-z0-9\-]/", "", $identity_information).'.'.$request->file('identity_information')->getClientOriginalExtension();

            $identity_information_img = Image::make($request->file('identity_information')->getRealPath())->resize($img_width, $img_height);
            $identity_information_img->save(public_path() . '/doctor_identity_information/' . $res_identity_information);
            $req_data['identity_information'] = $res_identity_information;
        }else{
            $req_data['identity_information'] = $decode_data['identity_information'] ?? null;
        }
        
        $updateDetails = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'meta' => json_encode($req_data)
        ];
        $update = Customer::find(Session::get('userId'))->update($updateDetails);
        if($update){
            return redirect($account_prefix.'/dashboard')->with('success', "Your profile has been successfully updated")->with('account', Config::get('constants.accountType.doctor'));
        } else {
            return redirect($account_prefix.'/dashboard')->with('error', "Something went wrong !")->with('account', Config::get('constants.accountType.doctor'));
        }
    }

}
