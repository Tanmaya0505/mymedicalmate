<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suggetion;
use App\Helpers\CustomerHelper;
use App\Customer;
use App\CustomerDetail;
use App\AlltypeAd;
use App\AccountType;
use App\DiseaseDetail;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Helper;
use Dotenv\Exception\ValidationException;
use App\AlltypeUserLog;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlltypeuserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function alltypeusers(Request $request,$type){
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        ];
        if($type=='doctor'){
             //dd(date("Y-m-d",strtotime($request->to_date)));
             //dd($request->searchsubmit);
            if($request->searchsubmit){
                $start_date = date('Y-m-d h:i:s', strtotime($request->from_date));
                $end_date = date('Y-m-d h:i:s', strtotime($request->to_date));
              $data = CustomerDetail::where('account_id',1)->whereBetween('created_at',[$start_date,$end_date])->orderBy('id','desc')->get();
              //dd($data);
            }
            $data = CustomerDetail::where('account_id',1)->orderBy('id','desc')->get();
        }
        if($type=='hospital'){
            $data = CustomerDetail::where('account_id',2)->orderBy('id','desc')->get();
        
        }
        if($type=='nurses'){
            $data = CustomerDetail::where('account_id',3)->orderBy('id','desc')->get();
        
        }
        if($type=='clinics'){
            $data = CustomerDetail::where('account_id',4)->orderBy('id','desc')->get();
        }
        if($type=='pharmas'){
            $data = CustomerDetail::where('account_id',5)->orderBy('id','desc')->get();
        }
        if($type=='exams'){
            $data = CustomerDetail::where('account_id',6)->orderBy('id','desc')->get();
        }
        if($type=='diseases'){
            $data = CustomerDetail::where('account_id',7)->orderBy('id','desc')->get();
        }
        
        return view('pages.all_type_users', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'data'=> $data
        ]);
    }
    public function searchdoctor(Request $request,$type){
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        ];
        if($type=='doctor'){
            $data = CustomerDetail::where('account_id',1)->orderBy('id','desc')->get();
        }
    }
    public function addalltypeusers(Request $request){
    	$config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        ];
        
        
        return view('pages.add_all_type_users', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'data'=> []]);
    }
    public function editalltypeusers(Request $request,$type,$id){
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        ];
        
            $data = CustomerDetail::with('diseasedetails')->where('id',$id)->orderBy('id','desc')->first();
            $data2 = CustomerDetail::where('id',$id)->orderBy('id','desc')->first();
        $datalog = AlltypeUserLog::where('data_id',$id)->orderBy('id','desc')->first();
        //dd($data2->toArray());
        $resultcustomer = array_diff_key($data2->toArray(), array_flip((array) ['status']));
        //dd(array_slice($resultcustomer,2));
        //$datalogs=array_slice($datalog->toArray(),4);
        //$resultcustomers=array_slice($resultcustomer,2);
        //$arrydiff=array_diff_assoc($datalogs, $resultcustomers) === array_diff_assoc($resultcustomers, $datalogs);
        //dd( $resultcustomer);
        return view('pages.add_all_type_users', ['config' => $config,'resultcustomer'=>$resultcustomer, 'datalog'=>$datalog, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'data'=> $data,'type'=> $type]);
    }

    public function deletealltypeusers(Request $request,$type,$id){
        
            $data = CustomerDetail::where('id',$id)->orderBy('id','desc')->delete();
        
        
        return back();
    }
    public function deletealltypeusersdiseases(Request $request,$id){
        
            $data = DiseaseDetail::where('id',$id)->orderBy('id','desc')->delete();
        
        
        return back();
    }
    public function doctorVeryfiyOtp(Request $request,$type){
       // $json=json_decode($request->input('submit-data'));
        //dd($json->email);
        //dd($request->email);
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
        //End email function
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
            $datalog = AlltypeUserLog::where('data_id',$id)->orderBy('id','desc')->first();
            $data2 = CustomerDetail::where('id',$id)->orderBy('id','desc')->first();
            $resultcustomer = array_diff_key($data2->toArray(), array_flip((array) ['status']));
        
        return view('pages.add_all_type_users', ['config' => $config,'resultcustomer'=>$resultcustomer,'datalog'=>$datalog, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'data'=> $data,'type'=> $type]);

    }
    public function AdminDoctorview(Request $request,$type,$id){
        $id= $id;
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        ];
        
            $data = CustomerDetail::with('diseasedetails')->where('id',$id)->orderBy('id','desc')->first();
        
        return view('pages.add_all_type_users', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'data'=> $data,'type'=> $type]);
    }
    public function alltypeuserlog(Request $request,$type){
        if($request->has('data_id')){
            //dd(Auth::user()->id);
            //dd(Session::get('userId'));
            $doctorlog = AlltypeUserLog::where('data_id',$request->data_id)->get();
            if($type=='doctor'){
                
                if(array_filter($request->all())){
                    if(count($doctorlog) == 0){
                        $data_id = $request->data_id;
                        $doctorlog = new AlltypeUserLog();
                        $dr='Dr.';
                        $doctorlog->account_id=1;
                        if($request->has('data_id')){
                            $full_name = $request->full_name;
                        } else {
                            $full_name = $dr.$request->full_name;
                        }
                        $doctorlog->data_id=$data_id;
                        $doctorlog->user_id=Auth::user()->id;
                        $doctorlog->full_name=$full_name;
                        $doctorlog->gender=$request->gender; 
                        $doctorlog->mobile=$request->mobile_no;
                        $doctorlog->email =$request->email_id;
                        $doctorlog->doctorqualification =$request->doctorqualification; 
                        $doctorlog->slefemp_emplaye=$request->slefemp_emplaye; 
                        $doctorlog->designation =$request->designation;
                        $doctorlog->department=$request->department;
                        $doctorlog->total_experience =$request->totalexprience;
                        $doctorlog->location=$request->orgnization_location;
                        $doctorlog->orgnization_name =$request->orgnization_name;
                        $doctorlog->state_city =$request->state_city; 
                        $doctorlog->landmark_pincode =$request->landmark_pincode;
                        if(!$request->avl_days){
                            $result = null; 
                        } else{
                            $result = implode(",",$request->avl_days);
                            $result = $request->avl_days;
                        }
                        
                        $doctorlog->avl_days =$result;
                        
                        $doctorlog->from_time =date("g:i a", strtotime($request->from_time));
                        $doctorlog->to_time =date("g:i a", strtotime($request->to_time));
                        $doctorlog->consul_fee_from =$request->consul_fee_from;
                        $doctorlog->consul_fee_to =$request->consul_fee_to;
                        $doctorlog->website_url =$request->website_url;
                        $doctorlog->social_media_link=$request->facebook_url;
                        $doctorlog->instagram_url=$request->instagram_url;
                        $doctorlog->youth_profile_url=$request->youth_profile_url;
                        $doctorlog->twiter_profile_url=$request->twiter_profile_url;
                        $doctorlog->achievement_award=$request->achivement_award;
                        $doctorlog->doctorachievement_file=$request->doctorachievement_file;
                        $doctorlog->description=$request->descriptions;
                        $doctorlog->consultation=$request->consultation;
                        $doctorlog->consultation_clinic=$request->consultation_clinic;
                        $doctorlog->no_research=$request->research;
                        $doctorlog->no_language=$request->language;
                        $doctorlog->star_ratings=$request->star_ratings;
                        if ($request->hasFile('profile_picture'))
                        {
                            $path = $request->file('profile_picture')->store('/images', ['disk' =>      'my_files']);
                            $doctorlog->profile_picture = $path;
                        }
                        if ($request->hasFile('award'))
                        {   
                            foreach($request->award as $award){
                            $awardpath[] = $award->store('images', ['disk' => 'my_files']);
                            }
    
                            $doctorlog->achievement_award = json_encode($awardpath);
                        }
                        $doctorlog->save();
                    }else{
                        $doctorlog = AlltypeUserLog::where('data_id',$request->data_id)->first(); 
                        $dr='Dr.';
                        if(!empty($doctorlog->user_id)){
                            $results = explode(",",$doctorlog->user_id);
                            
                            if(in_array(Auth::user()->id,$results)){
                                $user_id = $doctorlog->user_id;
                            } else{
                                $user_id=$doctorlog->user_id.','.Auth::user()->id;
                            }  
                        } else{
                            $user_id=Auth::user()->id;
                        }
                        $doctorlog->user_id=$user_id;
                        if($request->has('data_id')){
                            $full_name = $request->full_name;
                        } else {
                            $full_name = $dr.$request->full_name;
                        }
                        $doctorlog->data_id=$request->data_id;
                        if(!empty($request->full_name)){
                            $doctorlog->full_name=$full_name;
                        } 
                        if(!empty($request->gender)){
                            $doctorlog->gender=$request->gender; 
                        } 
                        if(!empty($request->dmobile_no)){
                            $doctorlog->mobile=$request->dmobile_no;
                        } 
                        if(!empty($request->doctor_email)){
                            $doctorlog->email =$request->doctor_email;
                        } 
                        if(!empty($request->doctorqualification)){
                            $doctorlog->doctorqualification =$request->doctorqualification; 
                        } 
                        if(!empty($request->university_date)){
                            $doctorlog->university_date=$request->university_date;
                        } 
                        if(!empty($request->univercity)){
                            $doctorlog->univercity=$request->univercity;
                        } 
                        if(!empty($request->slefemp_emplaye)){
                            $doctorlog->slefemp_emplaye=$request->slefemp_emplaye;
                        } 
                        if(!empty($request->designation)){
                            $doctorlog->designation =$request->designation;
                        } 
                        if(!empty($request->department)){
                            $doctorlog->department=$request->department;
                        }
                        if(!empty($request->totalexprience)){
                            $doctorlog->total_experience =$request->totalexprience;
                        } 
                        if(!empty($request->orgnization_name)){
                            $doctorlog->orgnization_name =$request->orgnization_name;
                        } 
                        if(!empty($request->orgnization_location)){
                            $doctorlog->location=$request->orgnization_location;
                        } 
                        if(!empty($request->state_city)){
                            $doctorlog->state_city =$request->state_city;
                        } 
                        if(!empty($request->landmark_pincode)){
                            $doctorlog->landmark_pincode =$request->landmark_pincode;
                        }
                        if(!$request->avl_days){
                            $result = $doctorlog->avl_days; 
                        } else{
                           // $result = implode(",",$request->avl_days);
                           $results = explode(",",$doctorlog->avl_days);
                           if(in_array($request->avl_days,$results)){
                            $result = $doctorlog->avl_days;
                           }else{
                            $result = $doctorlog->avl_days.','.$request->avl_days;
                           }
                            
                        }
                        $doctorlog->avl_days =$result;
                        
                        if(!empty($request->from_time)){
                            $doctorlog->from_time =date("g:i A", strtotime($request->from_time));
                        }
                        if(!empty($request->to_time)){
                            $doctorlog->to_time =date("g:i A", strtotime($request->to_time));
                        }
                        
                        if(!empty($request->consul_fee_from)){
                            $doctorlog->consul_fee_from =$request->consul_fee_from;
                        }
                        if(!empty($request->consul_fee_to)){
                            $doctorlog->consul_fee_to =$request->consul_fee_to;
                        }
                        if(!empty($request->website_url)){
                            $doctorlog->website_url =$request->website_url;
                        }
                        if(!empty($request->facebook_url)){
                            $doctorlog->social_media_link=$request->facebook_url;
                        }
                        if(!empty($request->instagram_url)){
                            $doctorlog->instagram_url=$request->instagram_url;
                        }
                        if(!empty($request->youth_profile_url)){
                            $doctorlog->youth_profile_url=$request->youth_profile_url;
                        }
                        if(!empty($request->twiter_profile_url)){
                            $doctorlog->twiter_profile_url=$request->twiter_profile_url;
                        }
                        if(!empty($request->achivement_award)){
                            $doctorlog->achievement_award=$request->achivement_award; 
                        }
                        $doctorlog->doctorachievement_file=$request->doctorachievement_file;
                        if(!empty($request->descriptions)){
                            $doctorlog->description=$request->descriptions;
                        }
                        if(!empty($request->consultation)){
                            $doctorlog->consultation=$request->consultation;
                        }
                        if(!empty($request->consultation_clinic)){
                            $doctorlog->consultation_clinic=$request->consultation_clinic;
                        }
                        if(!empty($request->research)){
                            $doctorlog->no_research=$request->research;
                        }
                        if(!empty($request->language)){
                            $doctorlog->no_language=$request->language;
                        }
                        $doctorlog->star_ratings=$request->star_ratings;
                        if ($request->hasFile('profile_picture'))
                        {
                            $path = $request->file('profile_picture')->store('/images', ['disk' =>      'my_files']);
                            $doctorlog->profile_picture = $path;
                        }
                        if ($request->hasFile('award'))
                        {   
                            foreach($request->award as $award){
                            $awardpath[] = $award->store('images', ['disk' => 'my_files']);
                            }
    
                            $doctorlog->achievement_award = json_encode($awardpath);
                        }
                        $doctorlog->save();
                    }
                }
                
            }
            
        }
    }
    public function postalltypeusers(Request $request,$type){
        //dd($request->all());
        $data_id = '';
        if($request->has('data_id')){
            $data_id = $request->data_id;
        }
        $customerdetail = CustomerDetail::where('id',$data_id)->first();
        
        if($type=='doctor'){
            //$datetime = date("g:i a", strtotime($request->to_time));
            //dd($datetime);    $request->validate throw ValidationException::withMessages
           
            $request->validate([
                    'full_name' => 'required',
                    'gender' => 'required',
                    'mobile_no' => 'required|max:10',
                    'email_id' => 'required|email',
                    'doctorqualification' => 'required',
                    'univercity' => 'required',
                    'university_date' => 'required',
                    'slefemp_emplaye' => 'required',
                    'designation' => 'required',
                    'department' => 'required',
                    'totalexprience' => 'required',
                    'orgnization_name' => 'required',
                    'orgnization_location' => 'required',
                    'state_city' => 'required', 
                    'landmark_pincode' => 'required',
                    'avl_days' => 'required',
                    'from_time' => 'required',
                    'to_time' => 'required',
                    'consul_fee_from' => 'required|numeric|gte:0',
                    'consul_fee_to' => 'required|numeric|gte:consul_fee_from',
                    'website_url' => 'required|url',
                    'consultation' => 'required',
                    'consultation_clinic' => 'required',
                    'research' => 'required',
                    'language' => 'required',
                    //'profile_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',


                ]);
                //dd($request->full_name);
                $dr='Dr.';
                if(!$customerdetail){
                $customerdetail = new CustomerDetail();
                }
                $customerdetail->account_id=1;
                if($request->has('data_id')){
                    $full_name = $request->full_name;
                } else {
                    $full_name = $dr.$request->full_name;
                }
                if(!empty(Auth::user()->id==1 && $request->has('data_id'))){
                    $customerdetail->status=1;
                }
                $customerdetail->full_name=$full_name;
                $customerdetail->gender=$request->gender; 
                $customerdetail->mobile=$request->mobile_no;
                $customerdetail->email =$request->email_id;
                $customerdetail->doctorqualification =$request->doctorqualification; 
                $customerdetail->univercity =$request->univercity; 
                $customerdetail->university_date =$request->university_date; 
                $customerdetail->slefemp_emplaye=$request->slefemp_emplaye; 
                $customerdetail->designation =$request->designation;
                $customerdetail->department=$request->department;
                $customerdetail->total_experience =$request->totalexprience;
                $customerdetail->location=$request->orgnization_location;
                $customerdetail->orgnization_name =$request->orgnization_name;
                $customerdetail->state_city =$request->state_city; 
                $customerdetail->landmark_pincode =$request->landmark_pincode;
                $result = implode(",",$request->avl_days);
                $customerdetail->avl_days =$result;
                
                $customerdetail->from_time =date("g:i a", strtotime($request->from_time));
                $customerdetail->to_time =date("g:i a", strtotime($request->to_time));
                $customerdetail->consul_fee_from =$request->consul_fee_from;
                $customerdetail->consul_fee_to =$request->consul_fee_to;
                $customerdetail->website_url =$request->website_url;
                $customerdetail->social_media_link=$request->facebook_url;
                $customerdetail->instagram_url=$request->instagram_url;
                $customerdetail->youth_profile_url=$request->youth_profile_url;
                $customerdetail->twiter_profile_url=$request->twiter_profile_url;
                $customerdetail->achievement_award=$request->achivement_award;
                $customerdetail->doctorachievement_file=$request->doctorachievement_file;
                $customerdetail->description=$request->descriptions;
                $customerdetail->consultation=$request->consultation;
                $customerdetail->consultation_clinic=$request->consultation_clinic;
                $customerdetail->no_research=$request->research;
                $customerdetail->no_language=$request->language;
                $customerdetail->star_ratings=$request->star_ratings;
                if ($request->hasFile('profile_picture'))
                {
                     $path = $request->file('profile_picture')->store('/images', ['disk' =>      'my_files']);
                    $customerdetail->profile_picture = $path;
                }
                if ($request->hasFile('award'))
                {   
                    foreach($request->award as $award){
                     $awardpath[] = $award->store('images', ['disk' => 'my_files']);
                    }

                    $customerdetail->achievement_award = json_encode($awardpath);
                }
                $customerdetail->save();
        }
        if($type=='hospital'){
                if(!$customerdetail){
                $customerdetail = new CustomerDetail();
                }
                $customerdetail->account_id=2;//$customer->id;
                $customerdetail->full_name=$request->full_name;
                $customerdetail->location=$request->location;
                $customerdetail->etablished_year=$request->etablished_year;
                $customerdetail->type_hospital=$request->type_hospital;
                $customerdetail->specialized=$request->specialized;
                $customerdetail->multi_specialist =$request->multi_specialist;
                $customerdetail->mobile=$request->mobile_no;
                $customerdetail->telephone=$request->telephone;
                //$customerdetail->achievement_award=$request->achievement_award;
                $customerdetail->website_url =$request->website_url;
                $customerdetail->social_media_link=$request->social_media_link;
                $customerdetail->star_ratings=$request->star_ratings;
                $customerdetail->description=$request->description;
                if ($request->hasFile('profile_picture'))
                {
                     $path = $request->file('profile_picture')->store('images', ['disk' =>      'my_files']);
                    $customerdetail->profile_picture = $path;
                }
                if ($request->hasFile('award'))
                {   
                    foreach($request->award as $award){
                     $awardpath[] = $award->store('images', ['disk' => 'my_files']);
                    }

                    $customerdetail->achievement_award = json_encode($awardpath);
                }
                $customerdetail->save();
        }
        if($type=='nurses'){
            if(!$customerdetail){
            $customerdetail = new CustomerDetail();
            }
            $customerdetail->account_id=3;//$customer->id;
            $customerdetail->full_name=$request->full_name;
            $customerdetail->designation =$request->designation;
            $customerdetail->total_experience =$request->total_experience;
            $customerdetail->location=$request->location;
            $customerdetail->mobile=$request->mobile_no;
            $customerdetail->email =$request->email_id;
            $customerdetail->website_url =$request->website_url;
            $customerdetail->social_media_link=$request->social_media_link;
            //$customerdetail->achievement_award=$request->achievement_award;
            $customerdetail->star_ratings=$request->star_ratings;
            $customerdetail->description=$request->description;
            if ($request->hasFile('profile_picture'))
            {
                 $path = $request->file('profile_picture')->store('images', ['disk' =>      'my_files']);
                $customerdetail->profile_picture = $path;
            }
            if ($request->hasFile('award'))
            {   
                foreach($request->award as $award){
                 $awardpath[] = $award->store('images', ['disk' => 'my_files']);
                }

                $customerdetail->achievement_award = json_encode($awardpath);
            }
            
            $customerdetail->save();
        }
        if($type=='clinics'){
            if(!$customerdetail){
            $customerdetail = new CustomerDetail();
            }
            $customerdetail->account_id=4;//$customer->id;
            $customerdetail->full_name=$request->full_name;
            $customerdetail->location=$request->location;
            $customerdetail->etablished_year=$request->etablished_year;
            $customerdetail->available_test =json_encode($request->available_test) ;
            $customerdetail->specialized=$request->specialized;
            $customerdetail->mobile=$request->mobile_no;
            $customerdetail->telephone=$request->telephone;
            //$customerdetail->achievement_award=$request->achievement_award;
            $customerdetail->website_url =$request->website_url;
            $customerdetail->social_media_link=$request->social_media_link;
            $customerdetail->star_ratings=$request->star_ratings;
            $customerdetail->description=$request->description;
            
            if ($request->hasFile('profile_picture'))
            {
                 $path = $request->file('profile_picture')->store('images', ['disk' =>      'my_files']);
                $customerdetail->profile_picture = $path;
            }
            if ($request->hasFile('award'))
            {   
                foreach($request->award as $award){
                 $awardpath[] = $award->store('images', ['disk' => 'my_files']);
                }

                $customerdetail->achievement_award = json_encode($awardpath);
            }
            $customerdetail->save();
        }
        if($type=='pharmas'){
            if(!$customerdetail){
            $customerdetail = new CustomerDetail();
            }
            $customerdetail->account_id=5;//$customer->id;
            $customerdetail->full_name=$request->full_name;
            $customerdetail->location=$request->location;
            $customerdetail->etablished_year=$request->etablished_year;
            $customerdetail->course_offered = json_encode($request->course_offered);
            $customerdetail->mobile=$request->mobile_no;
            $customerdetail->telephone=$request->telephone;
            //$customerdetail->achievement_award=$request->achievement_award;
            $customerdetail->website_url =$request->website_url;
            $customerdetail->social_media_link=$request->social_media_link;
            $customerdetail->star_ratings=$request->star_ratings;
            $customerdetail->description=$request->description;
            
            if ($request->hasFile('profile_picture'))
            {
                 $path = $request->file('profile_picture')->store('images', ['disk' =>      'my_files']);
                $customerdetail->profile_picture = $path;
            }
            if ($request->hasFile('award'))
            {   
                foreach($request->award as $award){
                 $awardpath[] = $award->store('images', ['disk' => 'my_files']);
                }

                $customerdetail->achievement_award = json_encode($awardpath);
            }
            $customerdetail->save();
        }
        if($type=='exams'){
                if(!$customerdetail){
                $customerdetail = new CustomerDetail();
                }
                $customerdetail->account_id=6;//$customer->id;
                $customerdetail->full_name=$request->full_name;
                $customerdetail->last_date_of_apply=$request->last_date_of_apply;
                $customerdetail->total_vacancy=$request->total_vacancy;
                $customerdetail->exam_date =$request->exam_date;
                $customerdetail->description=$request->description;
                $customerdetail->references_site =$request->references_site ;
                $customerdetail->save();
        }
        if($type=='diseases'){
            if(!$customerdetail){
            $customerdetail = new CustomerDetail();
            }
            $customerdetail->account_id=7;//$customer->id;
            $customerdetail->full_name=$request->full_name;
            $customerdetail->references_hos_doc=$request->references_hos_doc;
            $customerdetail->doc_profile=$request->doc_profile;
            $customerdetail->prime_contain =$request->prime_contain;
            $customerdetail->sec_contain=$request->sec_contain;
            $customerdetail->save();
            //dd($request->disease_img);
            if ($request->hasFile('disease_img'))
            {
                foreach($request->disease_img as $key => $disease){
                    if($disease){
                        $diseaseimgs[$key] = $disease->store('images', ['disk' => 'my_files']);
                    }else{
                       $diseaseimgs[$key] ='' ;
                    }
                }
            }
            //dd($diseaseimgs);
            foreach($request->disease_desc as $key => $desc){
                $detail = new DiseaseDetail();
                $detail->disease_desc = $desc;
                $detail->disease_img = $diseaseimgs[$key] ?? '';
                $detail->disease_id = $customerdetail->id;
                $detail->save();
            }
        }
        return back();

    }

    public function alltypeads(Request $request){
            $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "All Type User"]
        ];
        $user_types = AccountType::pluck('account_name','id')->toArray();
        if(Auth::user()->user_role==2){
            $data = AlltypeAd::where('staff_id',Auth::user()->id)->get();
        }else{
            $data = AlltypeAd::all();
        }
        return view('pages.all_ads', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'data'=> $data,'user_types'=> $user_types
        ]);
    }

    public function alltypeadstatus (Request $request,$id){
            $customer = AlltypeAd::where('id',$id)->first();
            $customer->status= $customer->status ==1 ? 0 : 1;
            $customer->save();
            return back();
    }
    // public function postalltypeads(Request $request){
    //     $this->validate($request, [
    //         //'title' => 'required|string|max:255',
    //         'type_user' => 'required|string|max:255',
    //         //'video' => 'required|file|mimetypes:video/mp4',
    //         'video' => 'required|file',
    //     ]);
    //             $customer = new AlltypeAd();
    //             $customer->staff_id=Auth::user()->id;
    //             $customer->type_user=$request->type_user;
    //             $customer->file_type='video';
    //             $customer->status=0;
    //             //$customer->title=$request->title;
                
    //             if ($request->hasFile('video'))
    //             {
    //                  $path = $request->file('video')->store('videos', ['disk' =>      'my_files']);
    //                 $customer->file_path = $path;
    //             }
    //             $customer->save();
                
         
        
    //     return back();

    // }

}