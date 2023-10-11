<?php

namespace App\Http\Controllers\frontend;

use App\Http\Middleware\GetGeoLocation;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\CustomerHelper;
use App\Customer;
use App\Locator;
use App\CustomerPrescription;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Image;
use App\CustomerDetail;
use App\AlltypeAd;
use App\ReferalBonus;
use App\ReferalCodeDetail;
use App\Http\Controllers\BonusController;
use App\Rating;
use App\QuestionAnswar;
use Illuminate\Support\Facades\Session;
use App\Comment;

class HomeController extends \App\Http\Controllers\Controller
{

    public function home()
    {
        $assistant = Customer::select('id', 'account_id', 'meta', 'status', 'admin_status')->where([['account_id', '=', 2],['status', '=', 1],['admin_status', '=', 1]])->get();
        $doctor = Customer::select('id', 'account_id', 'meta', 'status', 'admin_status')->where([['account_id', '=', 3],['status', '=', 1],['admin_status', '=', 1]])->get();
        $stateJson = json_decode(file_get_contents(base_path('resources/data/states-and-districts.json')),true);
        $states = array_filter($stateJson['states'], function ($var) {
                    return ($var['status'] === 1);
                });
        return view('frontend-source.home', ['assistant' => $assistant, 'doctor' => $doctor, 'states' => $states]);
    }

    public function login()
    {
        if(empty(Session::get('userId'))) {
            return view('frontend-source.login');
        } else {
            return redirect('/');
        }
    }

    public function forgotPassword()
    {
        return view('frontend-source.forgot-password');
    }

    public function signUp()
    {
        return view('frontend-source.sign-up');
    }

    public function loginRegister()
    {
        return view('frontend-source.login-register');
    }

    public function myaccount()
    {
        return view('frontend-source.user.dashboard');
    }
    /**
     * Purpose : Listing of medicalmate page
     * Author  : Trideep Dakua
     * Email   : <trideepdakua@gmail.com>
     *
     * @return : View page
     */
    public function listingMedicalMate()
    {
        $basePath             = 'resources/data/assistant/form.json';
        $assistantBoyFormJson = file_get_contents(base_path($basePath));
        $value                = json_decode($assistantBoyFormJson, true);
       // dd($value);
        $serviceArea          = [];
        $availableDays        = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'service_area') {
                $serviceArea[$val['node_code']] = $val['options'];
            }
            if ($val['node_code'] == 'available') {
                $availableDays[$val['node_code']] = $val['options'];
            }
        }
        array_shift($serviceArea['service_area']);
        array_shift($availableDays['available']);
        $assistant = Customer::with('assistantData')->where(
            [['account_id', '=', Config::get('constants.accountType.assistant')],
            ['status', '=', 1],['online_status', '=', 1],
            ['admin_status', '=', 1]]
        )->get();
        //dd($assistant);
        return view(
            'frontend-source.listing-medical-mate',
            [
                'assistant'     => $assistant,
                'service_area'  => $serviceArea['service_area'],
                'available_day' => $availableDays['available']
            ]
        );
    }
    
    public function filterMedicalmate(Request $request){
        $basePath             = 'resources/data/assistant/form.json';
        $assistantBoyFormJson = file_get_contents(base_path($basePath));
        $value                = json_decode($assistantBoyFormJson, true);
        $serviceArea          = [];
        $availableDays        = [];
        foreach ($value as $key => $val) {
            if ($val['node_code'] == 'service_area') {
                $serviceArea[$val['node_code']] = $val['options'];
            }
            if ($val['node_code'] == 'available') {
                $availableDays[$val['node_code']] = $val['options'];
            }
        }
        array_shift($serviceArea['service_area']);
        array_shift($availableDays['available']);
        
        $requestValue = [];
        if(!empty($request->service_area)){
            $requestValue['service_area'] = $request->service_area;
        }
        if(!empty($request->available)){
            $requestValue['available'] = $request->available;
        }
        if(isset($request->is_bike) && !empty($request->is_bike)){
            if($request->is_bike == 2){
                $requestValue['is_bike'] = 0;
            } else {
                $requestValue['is_bike'] = $request->is_bike;
            }
        }
        //dd($requestValue);
        $get_all_medicalmate = Customer::select('id','meta')->where([['account_id', '=', Config::get('constants.accountType.assistant')],['status', '=', 1],['admin_status', '=', 1],['online_status', '=', 1]])->get();
        $data = json_decode($get_all_medicalmate, true);
        $decode_data = [];
        foreach($data as $key=>$val){
            $decode_data[$key]  = json_decode($val['meta'], true);
            $decode_data[$key]['id']  = $val['id'];
        }
        foreach($decode_data as $k=>$v){
            if(!isset($v['is_bike'])){
                $decode_data[$k]['is_bike'] = 0;
            }
        }
        
        if(is_array($requestValue) && count($requestValue)) {
            $data = CustomerHelper::searchArray($decode_data, $requestValue);
            if(is_array($data)) {
                if(isset($request->day_charges) && !empty($request->day_charges)){
                    if($request->day_charges == 1){
                        rsort($data);
                    } else {
                        sort($data);
                    }
                }
                $filter_data = [];
                foreach($data as $key=>$val){
                    $filter_data[$key]['meta'] = json_encode($val);
                    $filter_data[$key]['id'] = $val['id'];
                }
            }
        } else {
            if(isset($request->day_charges) && !empty($request->day_charges)){
                if($request->day_charges == 1){
                    rsort($decode_data);
                } else {
                    sort($decode_data);
                }
            }
            $filter_data = [];
            foreach($decode_data as $key=>$val){
                $filter_data[$key]['meta'] = json_encode($val);
                $filter_data[$key]['id'] = $val['id'];
            }
        }
        //        echo "<pre>";
        //        print_r($filter_data); exit;
        return view(
            'frontend-source.listing-medical-mate',
            [
                'assistant'     => json_decode(json_encode($filter_data), false),
                'service_area'  => $serviceArea['service_area'],
                'available_day' => $availableDays['available']
            ]
        );
    }

    /**
     * Purpose : Details of medicalmate
     * Author  : Trideep Dakua
     * Email   : <trideepdakua@gmail.com>
     *
     * @param intiger $id
     *
     * @return : View page
     */
    public function detailsMedicalMate(Request $request,$id)
    {   //with('assistantData')->
        $assistant = Customer::where([['id', '=', $id],['account_id', '=', Config::get('constants.accountType.assistant')],['status', '=', 1],['admin_status', '=', 1]])->first();
        //dd($assistant);
        $value = json_decode($assistant->meta, true);
        //dd($value);
        $data = CustomerHelper::decodeAssistantData($value);
        //dd($data);
        $photo = asset('assistant/'. $data['photo']);
        if(!file_exists(public_path('assistant/'. $data['photo']))) {
            $photo = asset('frontend-source/images/assistant-boy-icon.png');
        }
        if($request->ajax()){
                $detail_data = '<div class="row">
                <div class="profile-nav col-lg-5 col-xl-4">
                    <div class="panel">
                        <div class="user-heading round">
                            <div class="d-flex bd-highlight align-items-center">
                                <div class="info-icon">
                                    <img src="'. asset('frontend-source/images/verify-icon.png').'" alt="">
                                    <p>Profile Verified</p>
                                </div>
                                <div class="profile-image">
                                    <a href="#">
                                        <img src="'. $photo .'" class="img-fluid" alt="">
                                    </a>
                                    <p class="p-age">Age:';
                                    if(isset($data['dob_year']) && !empty($data['dob_year'])){
                                     $detail_data .= $data['dob_year'].' Years';
                                     }else{ $detail_data .='--'; }
                                    

                                    $detail_data .='</p>
                                </div>
                                <div class="info-icon">
                                    <img src="'. asset('frontend-source/images/ride-icon.png') .'" alt="">
                                    <p>Ride: ';
                                    if(isset($data['is_bike']) && $data['is_bike']){
                                        $detail_data .= $data['km_range'] ; 
                                    }else{ 
                                        $detail_data .='00-00 KM';
                                    }
                                     
                                    $detail_data .='</p>
                                </div>
                            </div>

                            <div class="user-details">
                                <b><i class="fal fa-user"></i>Name:</b>'. ucwords($assistant->first_name.' '.$assistant->last_name).'<br>
                                <b><i class="fal fa-map-marker-alt"></i>From:</b> '.$data['present_address'] .','.  $data['dist'] .','.  $data['state'] .'<br>
                            </div>
                        </div>
                        <div class="text-center mt20">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8">
                    <div class="profile-info">
                        
                        <ul class="list-group detail-profile-list">
                            <li class="list-group-item"><i class="fal fa-medkit"></i><span>Charges: <strong>Rs '. $data['day_charges'] .' Day | '. $data['night_charges'] .' Night</strong></span></li>
                            <li class="list-group-item"><i class="fal fa-map-marker-alt"></i><span>Service Area: <strong>'. $data['present_address'] .', '. $data['dist'] .', '. $data['state'] .' ('. $data['pincode'] .')</strong></span></li>
                            <li class="list-group-item"><i class="fal fa-calendar-alt"></i><span>Available: <strong> '. str_replace(',', ' | ', $data['available']) .'</strong></span></li>
                            <li class="list-group-item"><i class="fal fa-clock"></i><span>Time: <strong>'. $data['from_time'] .' - '. $data['to_time'] .'</strong></span></li>
                            <li class="list-group-item"><i class="fal fa-map-marked-alt"></i><span>Service Area: <strong>'. $data['service_area'] .'</strong></span></li>
                            <li class="list-group-item"><i class="fal fa-graduation-cap"></i><span>Qualification: <strong>'. $data['highest_qualification'] .'</strong></span></li>
                            
                        </ul>
                        <div class="description-block">
                            <div class="mb10"><strong>Description:</strong></div>
                            <p>'. @$data['about'] .'</p>
                        </div>
                    </div>
                    <div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>';
            return response()->json(['code' => 200,'response' => "SUCCESS", 'detail' => $detail_data]);
            
        }


        return view('frontend-source.details-medical-mate', ['assistant' => $assistant, 'data'=>$data, 'photo'=>$photo]);
    }

    public function bookMedicalMate($type,$id)
    {
        if (Session::get('userId') && Session::get('accountId') != Config::get('constants.accountType.assistant') && Session::get('accountId') != Config::get('constants.accountType.vendor')) {
            $assistant = Customer::where([['id', '=', $id],['account_id', '=', Config::get('constants.accountType.assistant')],['status', '=', 1],['admin_status', '=', 1]])->first();
            $value = json_decode($assistant->meta, true);
            $data = CustomerHelper::decodeAssistantData($value);
            
            $photo = asset('assistant/'. $data['photo']);
            if(!file_exists(public_path('assistant/'. $data['photo']))) {
                $photo = asset('frontend-source/images/assistant-boy-icon.png');
            }
            $seconds = strtotime('+'.Config::get('constants.bookStartMinute').' minutes', time());
            $rounded_seconds = ceil($seconds / (Config::get('constants.bookINTVL') * 60)) * (Config::get('constants.bookINTVL') * 60);
            $startTime = date('H:i', $rounded_seconds);
            $getTime = CustomerHelper::createTimeRange($startTime, '23:30');
            $user_id = Session::get('userId');
            $user = Customer::where([['id', '=', $user_id],['status', '=', 1]])->first();
            $userdata = CustomerHelper::decodeUserData(json_decode($user->meta, true));
            //dd($getTime);
            //dd($userdata);
            if($type=='serial'){
                return view('frontend-source.book-serial-medical-mate', ['assistant' => $assistant, 'data'=>$data, 'photo'=>$photo, 'getTime'=>$getTime,'userdata' => $userdata,'type' => $type]);
            }else{
                return view('frontend-source.book-medical-mate', ['assistant' => $assistant, 'data'=>$data, 'photo'=>$photo, 'getTime'=>$getTime,'userdata' => $userdata,'type' => $type]);
            }
        } else {
            return redirect('/login');
        }
    }

    public function demoPage(){
        return view('frontend-source.demo-page');
    }

    public function uploadPrescription()
    {
        return view('frontend-source.upload-prescription');
    }

    public function submitUploadPrescription(Request $request)
    {
       
        if($request->ship_type==2){
            $this->validate(
                $request, [
                'full_name' => 'required|string|max:20',
                'mobile_no' => 'required',
                'gender' => 'required',
                'age' => 'required|string',
                'ship_type'=> 'required',
                'address'=> 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'zip' => 'required'
                ]
            );

        }else{
            $this->validate(
                $request, [
                'full_name' => 'required|string|max:20',
                'mobile_no' => 'required',
                'gender' => 'required',
                'age' => 'required|string',
                'ship_type'=> 'required',
                //'address'=> 'required'
                ]
            );
        }
        //dd($request->all());
        //Upload prescription photo
        if ($request->hasFile('prescription_photo')) {
            $photo = bcrypt(date('dmy') . time() . $request->input('full_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo) . '.' . $request->file('prescription_photo')->getClientOriginalExtension();
            // $photo_img = Image::make($request->file('prescription_photo')->getRealPath());
            // $photo_img->save(public_path() . '/prescription/' . $res_photo);
            $request->file('prescription_photo')->move(public_path('/prescription/'), $res_photo);
        } else {
            $res_photo = null;
        }

        $medicine_array = [];
        foreach ($request->medicine as $key => $val ) {
            $medicine_res_photo = null;
            if($request->hasFile('photo_'.$key)) {
                $medicine_photo = bcrypt(date('dmy') . time() . $key . $request->input('full_name'));
                $medicine_res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $medicine_photo) . '.' . $request->file('photo_'.$key)->getClientOriginalExtension();
                // $medicine_photo_img = Image::make($request->file('photo_'.$key)->getRealPath());
                // $medicine_photo_img->save(public_path() . '/prescription/photos/' . $medicine_res_photo);
                $request->file('photo_'.$key)->move(public_path('/prescription/photos/'), $medicine_res_photo);
            }
            $medicine_array[] = [ 'medicine'=>$val ?? null, 'quantity'=>$request->quantity[$key] ?? null, 'photo'=>$medicine_res_photo];
        }
        $medicine = json_encode($medicine_array);
        if($request->ship_type==2){
        $address['city'] = $request->city;
        $address['state'] = $request->state;
        $address['zip'] = $request->zip;
        $address['country'] = $request->country;
        // $address['bus_name'] = $request->bus_name;
        // $address['from_arrival'] = $request->from_arrival;
        // $address['to_arrival'] = $request->to_arrival;
        $address['address'] = $request->address;
        $delivery_address = json_encode(array_filter($address));
        }

        $postAll = [];
        $postAll['customer_id'] = Session::get('userId') ?? null;
        $postAll['prescription_photo'] = $res_photo;
        $postAll['medicine'] = $medicine;
        $postAll['full_name'] = $request->full_name;
        $postAll['mobile_no'] = $request->mobile_no;
        $postAll['gender'] = $request->gender;
        $postAll['age'] = $request->age;
        $postAll['ship_type'] = $request->ship_type;
        if($request->ship_type==2){
        $postAll['delivery_address'] = $delivery_address;
        }
        $postAll['note'] = $request->note;
        $postAll['order_id'] = random_int(100000, 999999);
        CustomerPrescription::create($postAll);
        return redirect('/search-vendor/'.$postAll['order_id'])->with('success', 'Prescription uploaded successfully');
    }

    public function listingDoctor()
    {
        return view('frontend-source.listing-doctor');
    }

    public function detailsDoctors()
    {
        return view('frontend-source.details-doctors');
    }

    public function profileDoctor()
    {
        return view('frontend-source.profile-doctor');
    }

    public function consultDoctor()
    {
        return view('frontend-source.consult-doctor');
    }

    public function signupUser(Request $request)
    {
        $this->validate(
            $request, [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10|unique:customers',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            ]
        );
        $password = bcrypt($request->input('password'));
        //Send an email to the customer from the admin email address to confirm an email address.
        $data = array(
            'email' => $request->input('email'),
            'guest_name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'subject' => 'Verify your email address',
            'logo_url' => env('LOGO_URL'),
            'verify_url' => env('APP_URL') . 'email-verify/' . $request->input('email') . '/token?value=' . $password
        );
        // phpcs:ignore
        if(env('APP_ENV')!='local'){
        Mail::send(
            'frontend-source.emails.confirm-account', compact('data'), function ($message) use ($data) {
                $message->to($data['email']);
                $message->subject($data['subject']);
                $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
            }
        );
        }
        //End email function

        $signUpData = $request->all();
        $signUpData['password'] = $password;
        $signUpData['pin'] = rand(10000,99999);

        $first_character = mb_substr(ucfirst($request->input('first_name')), 0, 1);
        $last_character = mb_substr(ucfirst($request->input('last_name')), 0, 1);

        $customer_data = Customer::create($signUpData);
        if ($customer_data) {
           $customer =  Customer::find($customer_data->id);
            $customer->customerId = 'MM0000'.$customer_data->id;
            $customer->save();
            //$ip_address = '223.176.114.238';
            $ip_address = GetGeoLocation::getIpaddress();
            //$get_location = GetGeoLocation::getGeoLocationInfo($ip_address);
            $locators_input = [];
            $locators_input['customer_id'] = $customer_data->id;
            $locators_input['device_type'] = Config::get('constants.deviceType.web');
            $locators_input['ip_address'] = $ip_address;
            //$locators_input['city'] = $get_location['geoplugin_city'];
            //$locators_input['country'] = $get_location['geoplugin_countryName'];
            //$locators_input['country_code'] = $get_location['geoplugin_countryCode'];
            //$locators_input['region'] = $get_location['geoplugin_regionName'];
            //$locators_input['geo_location_info'] = json_encode($get_location);
            $locators_input['device_browser_info'] = json_encode(GetGeoLocation::getDeviceBrowserInfo($_SERVER));
            Locator::create($locators_input);
            $referer_details = '';
            if($request->referal_code){
                $referer_details =  ReferalBonus::where('ref_code',$request->referal_code)->first();
                if($referer_details){
                    if(@$referer_details->ref_id){
                        $referer_parent_details =  ReferalBonus::where('user_id',$referer_details->ref_id)->first();
                    }
                    $refer_user = new ReferalBonus();
                    $refer_user->user_id = $customer_data->id;
                    $refer_user->ref_id = @$referer_details->user_id;
                    $refer_user->ref_code = $first_character.$last_character.$customer_data->id.rand(10000,99999);
                    $refer_user->save();

                    //if(!$referer_details->ref_coin_first){
                            $referer_details->ref_coin_first = @$referer_details->ref_coin_first+100;
                            $referer_details->save();
                            $this->ReferalCodeCoinUpdateCustomer($referer_details->user_id,100);
                                $cuser['user_id']=$referer_details->user_id;
                                $cuser['bonus_price']=100;
                                $cuser['bonus_type']='Referal';
                                $cuser['refer_type']=1;
                                $cuser['to_who_ref']=$customer_data->id;
                                (new BonusController)->addbonus($cuser);
                                $data['amount'] = 100;
                                $data['id'] = $customer_data->id;
                                $data['ref_id'] = $referer_details->user_id;
                                $data['refer_id'] = $referer_details->id;
                                $data['refer_code'] = $referer_details->ref_code;
                            $this->ReferalCodeDetail($data);
                            if($referer_details->ref_id){
                                $referer_parent_details->ref_coin_second = $referer_parent_details->ref_coin_second+50;
                                $referer_parent_details->save();
                                $this->ReferalCodeCoinUpdateCustomer($referer_parent_details->user_id,50);
                                $cuser['user_id']=$referer_parent_details->user_id;
                                $cuser['bonus_price']=50;
                                $cuser['bonus_type']='Referal';
                                $cuser['refer_type']=2;
                                $cuser['to_who_ref']=$customer_data->id;
                                (new BonusController)->addbonus($cuser);
                                $data['amount'] = 50;
                                $data['id'] = $customer_data->id;
                                $data['ref_id'] = $referer_parent_details->user_id;
                                $data['refer_id'] = $referer_details->id;
                                $data['refer_code'] = $referer_details->ref_code;
                                $this->ReferalCodeDetail($data);
                            }
                    //}
                }
            }
            if(!$referer_details){
                $refer_user = new ReferalBonus();
                $refer_user->user_id = $customer_data->id;
                //$refer_user->ref_id = $referer_details->user_id;
                $refer_user->ref_code = $first_character.$last_character.$customer_data->id.rand(10000,99999);
                $refer_user->save();
            }
            
            $cuser['user_id']=$customer_data->id;
            $cuser['bonus_type']='Sign-Up';
            $cuser['staff_id'] = '';
            $cuser['bonus_price']=100;
            (new BonusController)->addbonus($cuser);
        }

        if ($customer_data) {
            $request->session()->flash('success', 'We have sent you a verification message to '.$request->input('email').'.Please verify your email address to continue');
        } else {
            $request->session()->flash('error', 'Please try again later.');
        }
        return back();
    }

    public function ReferalCodeDetail($data){
        $newdata = new ReferalCodeDetail();
        $newdata->reg_user_id = $data['id'];
        $newdata->ref_user_id = $data['ref_id'];
        $newdata->refer_id = $data['refer_id'];
        $newdata->refer_code = $data['refer_code'];
        $newdata->amount = $data['amount'];
        $newdata->save();
        return $newdata;

    }

    public function ReferalCodeCoinUpdateCustomer($user_id,$price){
        $customer =  Customer::where('id',$user_id)->first();
        $customer->total_coin = $customer->total_coin+$price;
        $customer->save();                     
    }

    public function emailVerify($email, $token)
    {
        $token = $_GET['value'];
        $verifyUser = Customer::where([['email', '=', $email], ['password', '=', $token]])->first();
        if (isset($verifyUser)) {
            if (empty($verifyUser->status)) {
                $updateDetails = [
                    'status' => 1,
                    'email_verified_at' => date('Y-m-d h:i:s')
                ];
                $update_status = Customer::where([['email', '=', $email], ['password', '=', $token], ['status', '=', 0]])->update($updateDetails);
                $status = "Your e-mail is verified. You can now login.";
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return redirect('/login')->with('error', "Sorry your email and token cannot be identified.");
        }
        return redirect('/login')->with('success', $status);
    }

    public function logoout()
    {
        Session::forget('userId');
        Session::forget('accountId');
        Session::forget('userName');
        Session::forget('phone');
        return redirect('/login');
    }

    public function Doctorlist(Request $request)
    {   
        $data1 = CustomerDetail::where('account_id',1);
        if($request->name!=''){
                $data1->where('full_name','like','%'.$request->name.'%');
        }
        if($request->department!=''){
            $data1->where('department','like','%'.$request->department.'%');
        }
        if($request->experience!=''){
            $data1->where('total_experience','like','%'.$request->experience.'%');
        }
        $data = $data1->get();
        $server=$_SERVER['HTTP_USER_AGENT'];
        $isMob = is_numeric(strpos(strtolower($server), "mobile")); 
        if($isMob){
            return view('frontend-source.users.listing-doctors-mobile',compact('data'));
        }else{
            return view('frontend-source.users.listing-doctors-copy',compact('data')); 
        }
    }
    public function DoctorDetail(Request $request,$name){
        //dd(Session::get('userId'));
        $name=urldecode($name);
        $data = CustomerDetail::where('full_name',$name)->where('account_id',1)->first();
        $rating = Rating::where('userdetail_id',$data->id)->avg('rating');
       // dd($rating);
        $alldoctor= CustomerDetail::limit(6)->get();
        $questionAnswar = QuestionAnswar::get();
        return view('frontend-source.users.doctors-detail',compact('data','alldoctor','rating','questionAnswar'));
    }
    public function doctorVeryfiyOtp(Request $request){
        
         if(Session::get('otp')) {
                 Session::forget('otp');
         }
         $otp = mt_rand(100000, 999999);
         Session::put('otp', $otp);
         
         $details = [
            'title' => 'Mail from My MedicalMate',
            'body' => 'This is for OTP email using that',
            'logo_url' => env('LOGO_URL'),
            'guest_name' => $request->name,
            'otp' => $otp
        ];
   
        Mail::to($request->email)->send(new \App\Mail\MyOtpMail($details));
         //if($email) {
             return response()->json(['code' => 200,'response' => "SUCCESS",'otp' => $otp, 'message' => "Verification code sent to ".$request->input('email')])
             ->header('Access-Control-Allow-Origin', '*')->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
         //}else{
             //return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Oops!! Verification code not sent"]);
         //}
     }
     public function DoctorSubmitOtp(Request $request){

        $id= $request->verifyId;
        $type='doctor';
        //dd($request->otp);
        if($request->otp != Session::get('otp')) {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please enter valid PIN"]);
        }

        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        ];
        
            $data = CustomerDetail::with('diseasedetails')->where('id',$id)->orderBy('id','desc')->first();
            $data2 = CustomerDetail::where('id',$id)->orderBy('id','desc')->first();
            $resultcustomer = array_diff_key($data2->toArray(), array_flip((array) ['status']));
        
        return view('pages.add_all_type_users', ['config' => $config,'resultcustomer'=>$resultcustomer, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'data'=> $data,'type'=> $type]);

    }
    public function QuestionAnswarUpdate(Request $request){
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, "http://httpbin.org/ip");
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // $output = curl_exec($curl);
        // curl_close($curl);
        // $ip = json_decode($output, true);
        // dd($ip['origin']);
        // $new_Ques_answ=QuestionAnswar::find($request->question_id);
        // if($new_Ques_answ->category=='Clinic'){
            
        //     $category=3;
        // }
        // if($new_Ques_answ->category=='Vender'){
        //     $category=4;
        // }
        // if($new_Ques_answ->category=='Medicalmate'){
        //     $category=2;
        // }
        // $new_Ques_answ->user_type =$category;
        //dd($request->question);
        $new_Ques_answ = new QuestionAnswar();
        $new_Ques_answ->question = $request->question;
        $new_Ques_answ->save();
        return back();

    }
    public function Comments(Request $request){
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->userdetail_id=$request->usedetails_id;
        $comment->comments=$request->comments;
        $comment->date=$request->date;
        $comment->save();
        return back();

    }
    public function Hospitallist(Request $request)
    {   
        $data1 = CustomerDetail::where('account_id',2);
        if($request->name!=''){
                $data1->where('full_name','like','%'.$request->name.'%');
        }
        if($request->department!=''){
            $data1->where('department','like','%'.$request->department.'%');
        }
        if($request->experience!=''){
            $data1->where('total_experience','like','%'.$request->experience.'%');
        }
        $data = $data1->get();
        return view('frontend-source.users.listing-hospital',compact('data'));
    }
    public function HospitalDetail(Request $request,$name){
        $name=urldecode($name);
        $data = CustomerDetail::where('full_name',$name)->where('account_id',2)->first();
        return view('frontend-source.users.hospital-detail',compact('data'));
    }
    public function Nurseslist(Request $request)
    {   
        $data1 = CustomerDetail::where('account_id',3);
        if($request->name!=''){
                $data1->where('full_name','like','%'.$request->name.'%');
        }
        if($request->department!=''){
            $data1->where('department','like','%'.$request->department.'%');
        }
        if($request->experience!=''){
            $data1->where('total_experience','like','%'.$request->experience.'%');
        }
        $data = $data1->get();
        return view('frontend-source.users.listing-nurses',compact('data'));
    }
    public function NursesDetail(Request $request,$name){
        $name=urldecode($name);
        $data = CustomerDetail::where('full_name',$name)->where('account_id',3)->first();
        return view('frontend-source.users.nurses-detail',compact('data'));
    }
    public function Clinicslist(Request $request)
    {   
        $data1 = CustomerDetail::where('account_id',4);
        if($request->name!=''){
                $data1->where('full_name','like','%'.$request->name.'%');
        }
        if($request->department!=''){
            $data1->where('department','like','%'.$request->department.'%');
        }
        if($request->experience!=''){
            $data1->where('total_experience','like','%'.$request->experience.'%');
        }
        $data = $data1->get();
        return view('frontend-source.users.listing-clinics',compact('data'));
    }
    public function ClinicsDetail(Request $request,$name){
        $name=urldecode($name);
        $data = CustomerDetail::where('full_name',$name)->where('account_id',4)->first();
        return view('frontend-source.users.clinics-detail',compact('data'));
    }
    public function Pharmaslist(Request $request)
    {   
        $data1 = CustomerDetail::where('account_id',5);
        if($request->name!=''){
                $data1->where('full_name','like','%'.$request->name.'%');
        }
        if($request->department!=''){
            $data1->where('department','like','%'.$request->department.'%');
        }
        if($request->experience!=''){
            $data1->where('total_experience','like','%'.$request->experience.'%');
        }
        $data = $data1->get();
        return view('frontend-source.users.listing-pharmas',compact('data'));
    }
    public function PharmasDetail(Request $request,$name){
        $name=urldecode($name);
        $data = CustomerDetail::where('full_name',$name)->where('account_id',5)->first();
        return view('frontend-source.users.pharmas-detail',compact('data'));
    }
    public function Examslist(Request $request)
    {   
        $data1 = CustomerDetail::where('account_id',6);
        if($request->name!=''){
                $data1->where('full_name','like','%'.$request->name.'%');
        }
        if($request->department!=''){
            $data1->where('department','like','%'.$request->department.'%');
        }
        if($request->experience!=''){
            $data1->where('total_experience','like','%'.$request->experience.'%');
        }
        $data = $data1->get();
        return view('frontend-source.users.listing-exams',compact('data'));
    }
    public function ExamsDetail(Request $request,$name){
        $name=urldecode($name);
        $data = CustomerDetail::where('full_name',$name)->where('account_id',6)->first();
        return view('frontend-source.users.exams-detail',compact('data'));
    }
    public function Diseaseslist(Request $request)
    {   
        $data1 = CustomerDetail::where('account_id',7);
        if($request->name!=''){
                $data1->where('full_name','like','%'.$request->name.'%');
        }
        if($request->department!=''){
            $data1->where('department','like','%'.$request->department.'%');
        }
        if($request->experience!=''){
            $data1->where('total_experience','like','%'.$request->experience.'%');
        }
        $data = $data1->get();
        return view('frontend-source.users.listing-diseases',compact('data'));
    }
    public function DiseasesDetail(Request $request,$name){
        $name=urldecode($name);
        $data = CustomerDetail::with('diseasedetails')->where('full_name',$name)->where('account_id',7)->first();
        //dd($data->diseasedetails);
        return view('frontend-source.users.diseases-detail',compact('data'));
    }
    public function AchievementDetail(Request $request,$type,$name){
        $name=urldecode($name);
        $details = CustomerDetail::where('full_name',$name)->first();
        $data = [];
        $name = "";
        if($details && $details->achievement_award){
            $data = json_decode($details->achievement_award);
            $name = $details->full_name;
        }
        return view('frontend-source.users.achievements',compact('data','name'));
    }
    public function Videolist(Request $request){
        $data = AlltypeAd::where('status',1)->get();
        return view('frontend-source.users.video-list',compact('data'));
    }

    public function sendotp(Request $request){
        if(Session::get('otp')) {
                Session::forget('otp');
        }
        $otp = mt_rand(100000, 999999);
        Session::put('otp', $otp);
        //Send an email to the customer from the admin email address to confirm an email address.
        $data = array(
            'email' => $request->email,
            'guest_name' => $request->name,
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

        //if($email) {
            return response()->json(['code' => 200,'response' => "SUCCESS",'otp' => $otp, 'message' => "Verification code sent to ".$data['email']]);
        //}else{
            //return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Oops!! Verification code not sent"]);
        //}

    }

    public function verifyOtp(Request $request){
        //dd($request->all());
        if($request->input('otp') != Session::get('otp')) {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please enter valid OTP"]);
        }else{
            if(Session::get('otp')) {
                Session::forget('otp');
            }
            return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Phone number verified']);
        }
    }

}
