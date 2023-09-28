<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\CustomerHelper;
use Carbon\Carbon;
use App\Coupon;
use App\Customer;

class CouponController extends Controller
{
    //
    public function index(Request $request){

        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Coupon listing"]

        ];
        $input_value = $request->all();
        $all_coupons = Coupon::orderBy('id','DESC')->get();
        // $post = Coupon::where('user_ids', 6);
        // dd($post->coupon_name);
        return view('pages.coupons.index', ['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'all_coupons' => $all_coupons]);

    }
    public function add(Request $request){

        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Coupon Add"]

        ];
        
        $users = Customer::orderBy('first_name','ASC')->get();
        return view('pages.coupons.add',['users' => $users,'configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);

    }

    public function store(Request $request){
       
        if($request->coupon_id){
            $new_coupon = Coupon::find($request->coupon_id);
        }else{
            $new_coupon = new Coupon();
        }
        $new_coupon->coupon_title = $request->title;
        $new_coupon->coupon_name = $request->coupon_name;
        $new_coupon->coupon_discount_type = $request->coupon_discount_type;
        $new_coupon->coupon_type = $request->coupon_type;
        $new_coupon->start_date = $request->start_date;
        $new_coupon->end_date = $request->end_date;
        $new_coupon->purchasing_value = $request->purchasing_value;
        $new_coupon->coupon_value = $request->coupon_value;
        // if($request->coupon_discount_type=='FIXED'){
        //     $request->purchasing_value-$request->coupon_value;
        // }
        // if($request->coupon_discount_type=='PERCENTAGE'){
        //     $persentage = ($request->coupon_value / 100) * $request->purchasing_value;
        // }
        if($request->coupon_type=='PRIVATE'){
            //$new_coupon->user_ids = $request->user_id;
            $new_coupon->user_ids = implode(',',$request->user_id);
        }
        if($request->coupon_type=='PUBLIC'){
            $new_coupon->user_ids = "";
            $new_coupon->account_id ="";
        }
        if($request->coupon_type=='USER_CATEGORY'){
            $new_coupon->account_id =$request->user_category_type;
        }
        $new_coupon->save();
        return back();

    }
    public function couponcodegen(){
        $couponGenerated = $this->randomString();
        echo $couponGenerated;
    }
    function randomString($length = 10) {
		// Set the chars
		$chars='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// Count the total chars
		$totalChars = strlen($chars);

		// Get the total repeat
		$totalRepeat = ceil($length/$totalChars);

		// Repeat the string
		$repeatString = str_repeat($chars, $totalRepeat);

		// Shuffle the string result
		$shuffleString = str_shuffle($repeatString);

		// get the result random string
	    return substr($shuffleString,1,$length);
	}
    public function edit(Request $request,$id){

        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Coupon Edit"]

        ];
        
        $coupon = Coupon::find($id);
        $users = Customer::orderBy('first_name','ASC')->get();
        return view('pages.coupons.edit',['users' => $users,'coupon' => $coupon,'configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);

    }
    public function delete(Request $request,$id){
        
        $coupon = Coupon::find($id)->delete();
        return back();

    }
}
