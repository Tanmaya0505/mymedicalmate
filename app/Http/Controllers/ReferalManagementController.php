<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\BookingCommision;

class ReferalManagementController extends Controller
{
    public function index(Request $request){
       $customer1 = Customer::with('firstchilds');
       //->where('id',43)
        if($request->get('id')){
        	$customer1->where('id',$request->get('id'));
       		
   		}else{
   			$customer1->orderBy(\DB::raw('RAND()'));
   		}

       $customer = $customer1->first();
       //dd($customer);
       return view('pages.referal.index',compact('customer'));
    }

    public function CommisionManagement(Request $request){

      $commisionlist = BookingCommision::orderBy('id','DESC')
      ->where(function($query) use ($request){
          if($request->medmate){
            $query->where('mademate_id', $request->medmate);
          }
          if($request->vendor){
            $query->where('vendor_id', $request->vendor);
          }
      })->orderBy('id','DESC')->get();
       
       $users = Customer::where('account_id',2)->orderBy('first_name','ASC')->get();
       $vendors = Customer::where('account_id',4)->orderBy('first_name','ASC')->get();
       return view('pages.commision.index',compact('commisionlist','users','vendors'));

    }
}
