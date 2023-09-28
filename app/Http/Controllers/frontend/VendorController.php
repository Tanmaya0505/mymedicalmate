<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use Config;
use Session;
use Image;
use App\Helpers\CustomerHelper;
use App\Helpers\Helper;
use App\VendorPrescription;
use App\CustomerPrescription;
use App\VendorInvoice;
use App\AssistantBoyBooking;
use App\VendorRelatedPincode;
use App\BookingDeliveryRequest;
use Validator;
use Mail;
use App\Coupon;

class VendorController extends \App\Http\Controllers\Controller {

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
        //dd($req_data);
        if (!$request->has('only_photo')){
        $this->validate(
            $request, [
            
            'email' => 'required|email|unique:customers,email,'. Session::get('userId')
            
            ]
        );
        $list_of_pincodes = $req_data['list_of_pincodes'];

        $req_data['list_of_pincodes'] = trim(implode(',', $req_data['list_of_pincodes']),',');
        }
        unset($req_data['_token']);
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));

        


        if ($request->has('only_photo')){

            $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
                $decode_data = json_decode($data->meta, true);

            if($request->hasFile('photo')) {
                $config = CustomerHelper::configData('user_config');
                $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
                $size_explode = explode('*', $profile_img_size);
                $img_width = $size_explode[0];
                $img_height = $size_explode[1];

            
                //upload Image
                $photo = bcrypt(date('dmy').time().$decode_data['first_name']);
                $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('photo')->getClientOriginalExtension();

                $photo_img = Image::make($request->file('photo')->getRealPath())->resize($img_width, $img_height);
                $photo_img->save(public_path() . '/vendor/' . $res_photo);
                $req_data = $decode_data;
                $req_data['photo'] = $res_photo;

                
                $updateDetails = [
                    'meta' => json_encode($req_data),
                ];
                $update = Customer::find(Session::get('userId'))->update($updateDetails);
                if($update){
                    return redirect($account_prefix.'/my-profile')->with('success', "Your profile Photo has been successfully updated")->with('account', Config::get('constants.accountType.user'));
                } else {
                    return redirect($account_prefix.'/my-profile')->with('error', "Something went wrong !")->with('account', Config::get('constants.accountType.user'));
                }
            }else{
                return redirect($account_prefix.'/my-profile');
            }
        }
        
        $data = Customer::select('id','meta')->where([['id', '=', Session::get('userId')], ['account_id', '=', Session::get('accountId')]])->first();
        $decode_data = json_decode($data->meta, true);
        
        //Upload photo
        if($request->hasFile('adhere_photo')){
            $config = CustomerHelper::configData('vendor_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];
            
                //            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {
                //                $img_path= public_path('vendor/' . $decode_data['photo']);
                //                if (file_exists($img_path)) {
                //                    unlink($img_path);
                //                }
                //            }
            //upload Image
            $photo = bcrypt(date('dmy').time().$request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('adhere_photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('adhere_photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/vendor/' . $res_photo);
            $req_data['adhere_photo'] = $res_photo;
        }else{
            $req_data['adhere_photo'] = $decode_data['adhere_photo'] ?? null;
        }
        if($request->hasFile('pancard_photo')){
            $config = CustomerHelper::configData('vendor_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];
            
                //            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {
                //                $img_path= public_path('vendor/' . $decode_data['photo']);
                //                if (file_exists($img_path)) {
                //                    unlink($img_path);
                //                }
                //            }
            //upload Image
            $photo = bcrypt(date('dmy').time().$request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('pancard_photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('pancard_photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/vendor/' . $res_photo);
            $req_data['pancard_photo'] = $res_photo;
        }else{
            $req_data['pancard_photo'] = $decode_data['pancard_photo'] ?? null;
        }
        if($request->hasFile('gst_photo')){
            $config = CustomerHelper::configData('vendor_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];
            
                //            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {
                //                $img_path= public_path('vendor/' . $decode_data['photo']);
                //                if (file_exists($img_path)) {
                //                    unlink($img_path);
                //                }
                //            }
            //upload Image
            $photo = bcrypt(date('dmy').time().$request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('gst_photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('gst_photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/vendor/' . $res_photo);
            $req_data['gst_photo'] = $res_photo;
        }else{
            $req_data['gst_photo'] = $decode_data['gst_photo'] ?? null;
        }
        if($request->hasFile('pancard_store_photo')){
            $config = CustomerHelper::configData('vendor_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];
            
                //            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {
                //                $img_path= public_path('vendor/' . $decode_data['photo']);
                //                if (file_exists($img_path)) {
                //                    unlink($img_path);
                //                }
                //            }
            //upload Image
            $photo = bcrypt(date('dmy').time().$request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('pancard_store_photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('pancard_store_photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/vendor/' . $res_photo);
            $req_data['pancard_store_photo'] = $res_photo;
        }else{
            $req_data['pancard_store_photo'] = $decode_data['pancard_store_photo'] ?? null;
        }
        if($request->hasFile('rent_agreement_photo')){
            $config = CustomerHelper::configData('vendor_config');
            $profile_img_size = !empty($config['profile_img_size']) ? $config['profile_img_size'] : 266 * 266;
            $size_explode = explode('*', $profile_img_size);
            $img_width = $size_explode[0];
            $img_height = $size_explode[1];
            
                //            if (isset($decode_data['photo']) && !empty($decode_data['photo'])) {
                //                $img_path= public_path('vendor/' . $decode_data['photo']);
                //                if (file_exists($img_path)) {
                //                    unlink($img_path);
                //                }
                //            }
            //upload Image
            $photo = bcrypt(date('dmy').time().$request->input('first_name'));
            $res_photo = preg_replace("/[^A-Za-z0-9\-]/", "", $photo).'.'.$request->file('rent_agreement_photo')->getClientOriginalExtension();

            $photo_img = Image::make($request->file('rent_agreement_photo')->getRealPath())->resize($img_width, $img_height);
            $photo_img->save(public_path() . '/vendor/' . $res_photo);
            $req_data['rent_agreement_photo'] = $res_photo;
        }else{
            $req_data['rent_agreement_photo'] = $decode_data['rent_agreement_photo'] ?? null;
        }
        $req_data['photo'] = $decode_data['photo'] ?? null;
        //dd($req_data);
        $updateDetails = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'meta' => json_encode($req_data),
            'pincode' => $request->pincode,
            'name_of_store' => $req_data['name_of_store'],
            'discount' => $req_data['discount'],
            'is_profile_setup' => 1
        ];
        $update = Customer::find(Session::get('userId'))->update($updateDetails);
        VendorRelatedPincode::where('vendor_id',Session::get('userId'))->delete();
        foreach($list_of_pincodes as $pincode){
            $pincodevendor = new VendorRelatedPincode();
            $pincodevendor->vendor_id = Session::get('userId');
            $pincodevendor->pincode = $pincode;
            $pincodevendor->save();
        }
        if($update){
            return redirect($account_prefix.'/dashboard')->with('success', "Your profile has been successfully updated")->with('account', Config::get('constants.accountType.vendor'));
        } else {
            return redirect($account_prefix.'/dashboard')->with('error', "Something went wrong !")->with('account', Config::get('constants.accountType.vendor'));
        }
    }
    
    public function prescription(){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));    
        $data = VendorPrescription::with('prescription')->where('vendor_id', Session::get('userId'))->orderBy('id', 'DESC')->get();
       // dd($data);
        return view('frontend-source.customer-dashboard.vendor.prescription', ['account_prefix' => $account_prefix,'data' => $data]);
    }
    public function coupon(){
        $account_prefix = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $data = DB::table('coupons')->where('account_id', Session::get('accountId'))->orderBy('id', 'DESC')->get();
        //dd($data);
        return view('frontend-source.customer-dashboard.vendor.coupon', ['account_prefix' => $account_prefix,'data' => $data]);
    }
    public function prescriptionDetails($orderId){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        //$data               = CustomerPrescription::where([['customer_id', '=', Session::get('userId')],['order_id', '=', $orderId]])->first();
        $data = CustomerPrescription::with(['booking','deliveryboylist','vendorprescriptions','vendorprescription' => function($q){
             //$q->where('vendor_id',Session::get('userId'));
         }])->where('order_id', '=', $orderId)->first();
         //dd($data);
        if($data->customer_status==3){
            Session::put('check_prescription_status',4);
        }else
        if($data->vendorprescriptions->where('status',4)->first()){
            Session::put('check_prescription_status',3);
        }elseif($data->vendorprescriptions->where('status',1)->first()){
            Session::put('check_prescription_status',2);
        }elseif(!$data->vendorprescriptions->where('status',1)->first()){
            Session::put('check_prescription_status',1);
        }
        $value = AssistantBoyBooking::with('FwrdData','reviewData')->where('booking_id',$orderId)->first();
        $prescription_photo = asset('prescription/'. $data['prescription_photo']);
        if(empty($data['prescription_photo']) || !file_exists(public_path('prescription/'. $data['prescription_photo']))){
            $prescription_photo = null;
        }
        $medicines          = json_decode($data->medicine, true);
        $delivery_address   = json_decode($data->delivery_address, true);
        //dd($medicines);
        //dd($data);
        if($value){
            return view('frontend-source.customer-dashboard.vendor.prescription-details', ['account_prefix' => $account_prefix,'value' => $value, 'data' => $data, 'prescription_photo' => $prescription_photo, 'medicines' => $medicines, 'delivery_address' => $delivery_address]);
        }else{
            return view('frontend-source.customer-dashboard.vendor.uploadprescription.prescription-details', ['account_prefix' => $account_prefix,'value' => $value, 'data' => $data, 'prescription_photo' => $prescription_photo, 'medicines' => $medicines, 'delivery_address' => $delivery_address]);
        }
    }
    
    // public function prescriptionDetails($orderId){
    //     //dd(Session::get('userId'));
    //     $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
    //     $data               = CustomerPrescription::with(['vendorprescription' => function($q){
    //         $q->where('vendor_id',Session::get('userId'));
    //     }])->where('order_id', '=', $orderId)->first();
    //     //dd($data);
    //     $prescription_photo = asset('prescription/'. $data['prescription_photo']);
    //     if(empty($data['prescription_photo']) || !file_exists(public_path('prescription/'. $data['prescription_photo']))){
    //         $prescription_photo = null;
    //     }
    //     $medicines          = json_decode($data->medicine, true);
    //     $delivery_address   = json_decode($data->delivery_address, true);
    //     //dd($medicines);
    //     //dd($data);
    //     return view('frontend-source.customer-dashboard.vendor.prescription-details', ['account_prefix' => $account_prefix, 'data' => $data, 'prescription_photo' => $prescription_photo, 'medicines' => $medicines, 'delivery_address' => $delivery_address]);
    // }
    
    // public function createInvoice($order_id){
    //     $vendor = Customer::where('account_id',4)->where('id',Session::get('userId'))->first();
    //     $vendorDetails = json_decode($vendor->meta);
    //     $prescription = CustomerPrescription::where('order_id',$order_id)->first();
    //     $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();
    //     //dd($vendorDetails);
    //     return view('frontend-source.customer-dashboard.vendor.create-invoice',compact('vendor','vendorDetails','prescription','allmedicines'));
    // }

     public function createInvoice($order_id){
        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
            //$vendor_id = $prescription->customer_id;
            $prescription_id = $prescription->id;
        $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('status',4)->first();
        $vendor_id = $VendorPrescriptionexist->vendor_id;
        $vendor = Customer::where('account_id',4)->where('id',$vendor_id)->first();
        $customer = AssistantBoyBooking::where('booking_id',$order_id)->first();
        $vendorDetails = json_decode($vendor->meta);
        $medicines = [];
        $customer_address = [];
        if($customer){
            $medicines          = json_decode($prescription->medicine, true);
            $customer_address   = json_decode($customer->customer_meta, true);
        }
        
        $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();
        //dd($vendorDetails);
        return view('frontend-source.customer-dashboard.vendor.create-invoice',compact('vendor','vendorDetails','prescription','allmedicines','medicines','customer_address','customer','VendorPrescriptionexist'));
    }

       public function downloadInvoice(Request $request,$order_id){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $customer_address = [];
        $prescription = CustomerPrescription::where('order_id',$order_id)->first();
            //$vendor_id = $prescription->customer_id;
            $prescription_id = $prescription->id;
        $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('status',4)->first();
        if(!$VendorPrescriptionexist){
            $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('payment_status',1)->first();
        }
        if(!$VendorPrescriptionexist){
            if($request->segment(2)=='download-uploadprescription-invoice'){
               return redirect()->to('/vendor/uploadprescription/'.$order_id);
            }else{
                return redirect()->to('/vendor/prescription/'.$order_id);
            }
        }
        $vendor_id = $VendorPrescriptionexist->vendor_id;
        $vendor = Customer::where('account_id',4)->where('id',$vendor_id)->first();
        $customer = AssistantBoyBooking::where('booking_id',$order_id)->first();
        $vendorDetails = json_decode($vendor->meta);
        $medicines          = json_decode($prescription->medicine, true);
        if($customer){
        $customer_address   = json_decode($customer->customer_meta, true);
        }
        
        $allmedicines = VendorInvoice::where('order_id',$order_id)->where('is_deleted',0)->get();
        //dd($vendorDetails);
        return view('frontend-source.customer-dashboard.vendor.view-invoice',compact('vendor','vendorDetails','prescription','allmedicines','medicines','customer_address','account_prefix','VendorPrescriptionexist','customer'));
    }

    public function statusChange(Request $request,$status,$vendor_id,$id){
        //dd($request->all());
            $prescription = CustomerPrescription::where('order_id',$id)->first();
            //$vendor_id = $prescription->customer_id;
            $prescription_id = $prescription->id;
            if($status==2){
                // $prescription->customer_status = $status;
                // $prescription->is_vendor_assigned =1;
                // $prescription->save();
                
                $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('vendor_id',$vendor_id)->first();
                $VendorPrescriptionexist->status=1;
                if($request->min_amount){
                    $VendorPrescriptionexist->min_amount = $request->min_amount;
                    $VendorPrescriptionexist->max_amount = $request->max_amount;
                    $VendorPrescriptionexist->appox_amount = $request->approx_price;
                    $VendorPrescriptionexist->all_medicine = $request->is_all_medicine;
                    $VendorPrescriptionexist->medicine_list = json_encode(array_values($request->medicine_list));
                    $VendorPrescriptionexist->discount = $request->discount;;
                }
                $VendorPrescriptionexist->save();
                //VendorPrescription::where('prescription_id',$prescription_id)->where('status',0)->update(['status'=> 3]);
                if($request->min_amount){
                 return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Request Accepted successfully']);
                }
            }
            if($status==4){
                
                
                $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('vendor_id',$vendor_id)->first();
                
                $VendorPrescriptionexist->amount=$request->amount;
                $VendorPrescriptionexist->discount=$request->discount;;
                //$VendorPrescriptionexist->save();
                 return response()->json(['code' => 200, 'response' => "SUCCESS", 'message' => 'Request Accepted successfully']);
            }
            if($status==3){
                $prescription->is_vendor_assigned =0;
                //$prescription->save();
                $VendorPrescriptionexist = VendorPrescription::where('prescription_id',$prescription_id)->where('vendor_id',$vendor_id)->first();
                $VendorPrescriptionexist->status=2;
                //$VendorPrescriptionexist->save();
                //VendorPrescription::where('prescription_id',$prescription_id)->where('status',3)->update(['status'=> 0]);
            }
            if($status==5){
                
                
                 $prescription->customer_status = 5;
                // $prescription->is_vendor_assigned =1;
                 $prescription->save();
                 return back()->with('success', 'Payment Accepted successfully');;
            }
            if($status==6){
                
                
                $prescription->customer_status = 6;
               // $prescription->is_vendor_assigned =1;
                $prescription->save();
                return back()->with('success', 'Package Delived successfully');;
           }
            return back()->with('success', 'Request Accepted successfully');;
    }

    public function AddMedicine(Request $request){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $medicine = new VendorInvoice();
        $medicine->medicine_name = $request->medicine;
        $medicine->quantity = $request->quantity;
        $medicine->price = $request->price;
        $medicine->total_price = $request->quantity*$request->price;
        $medicine->vendor_id = $request->vendor_id;
        $medicine->order_id = $request->booking_id;
        if($account_prefix=='assistant'){
            $medicine->created_by = 2;
        }
        $medicine->save();
        
        // if($account_prefix=='assistant'){
        //     return redirect('/assistant/prescription/'.$request->booking_id)->with('success', 'Medicine added Successfully');;
        // }else{

        // }
        return back()->with('success', 'Medicine added Successfully');;
    }
    public function DeleteMedicine(Request $request,$id){
        $medicine = VendorInvoice::where('id',$id)->first();
        $medicine->is_deleted  = 1;
        $medicine->save();
        return back()->with('success', 'Medicine Delated Successfully');;
    }
    public function UpdateMedicine(Request $request,$id){
        $medicine = VendorInvoice::where('id',$id)->first();
        $medicine->quantity = $request->quantity;
        $medicine->total_price = $request->quantity*$medicine->price;
        $medicine->save();
        return back()->with('success', 'Medicine Update Successfully');;
    }

    public function statusChangePrescription(Request $request,$status,$id){
            $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
            $prescription = CustomerPrescription::where('order_id',$id)->first();
                $prescription->customer_status = $status;
                $prescription->save();
                
                
            return redirect('/'.$account_prefix.'/prescription/'.$id)->with('success', 'Request Update successfully');;
    }
    public function deliveryboySearch(Request $request,$id){
        $account_prefix     = array_search(Session::get('accountId'), Config::get('constants.accountType'));
        $prescription = CustomerPrescription::where('order_id',$id)->first();
        $delivery_address   = json_decode($prescription->delivery_address, true);
        $pin = $delivery_address['zip'];
        $deliveryboy = Customer::where('account_id',5)
        ->where('status',1);
        $deliveryboy->whereHas('relatedarea',function($q) use ($pin){
            $q->where('pincode',$pin);
        });
        $deliveryboys = $deliveryboy->inRandomOrder()->get();
        return view('frontend-source.customer-dashboard.vendor.search-deliveryboy',compact('deliveryboys','account_prefix','id','pin'));
    }
    public function deliveryboyrequestSend(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'vendorids' => 'required|array|between:1,5'
        ],['vendorids.required' =>'You have to choose delivery boy from 1 to 5 number',
                'vendorids.between' =>'You have to choose delivery boy from 1 to 5 number'
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $login_user = Customer::where('id',Session::get('userId'))->first(); 
        $prescription = CustomerPrescription::where('order_id',$id)->first();
        //$det = AssistantBoyBooking::where('booking_id', $id)->first();
        $vendoruser = Customer::whereIn('id',$request->vendorids)->get()->keyBy('id');
        $BookingDeliveryRequestexist = BookingDeliveryRequest::where('order_id',$id)->get();
        if(count($BookingDeliveryRequestexist)==0){
            foreach($request->vendorids as $vendor){
                $BookingDeliveryRequest = new BookingDeliveryRequest();
                $BookingDeliveryRequest->order_id=$id;
                $BookingDeliveryRequest->delivery_id=$vendor;
                $BookingDeliveryRequest->status='Sent';
                $BookingDeliveryRequest->delivery_type='Medicine Delivered';
                $BookingDeliveryRequest->save();
                
                //Send to email
                //User Email
                $data = array(
                    'email' => $vendoruser[$vendor]->email,
                    'subject' => 'New Delivery Request #' . $id,
                    'customer_det' => $prescription,
                    'vendor_det' => $vendoruser[$vendor],
                    'booking_id' => $id,
                    'logo_url' => env('LOGO_URL'),
                );
                if(env('APP_ENV')!='local'){
                    // $email = Mail::send('frontend-source.emails.vendor-prescriptiondelivery-request-booking', compact('data'), function($message) use ($data) {
                    //     $message->to($data['email']);
                    //     $message->subject($data['subject']);
                    //     $message->from(Helper::adminInfo()->email, Helper::adminInfo()->name);
                    // });
                }
            }

            
            $prescription->customer_status = 10;
            $prescription->save();

        }
        $prescription->customer_status=10;
        $prescription->save();
        
            Session::put('check_delivery_status',1);
            return redirect()->to('/vendor/prescription/'.$id)->with('success', 'Send Request  successfully');;
        

    }

}
