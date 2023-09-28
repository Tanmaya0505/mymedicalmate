<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class CustomerPrescription extends Model
{
    protected $fillable = ['customer_id', 'prescription_photo', 'medicine', 'full_name', 'mobile_no', 'gender', 'age', 'ship_type', 'delivery_address','note', 'customer_status', 'order_id'];
    
    public function customer(){
    	return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function vendorprescription(){
    	return $this->hasOne('App\VendorPrescription','prescription_id')->where('vendor_id',Session::get('userId'));
    }
    public function booking(){
    	return $this->hasOne('App\AssistantBoyBooking','booking_id','order_id');
    }
    public function vendorprescriptions(){
        return $this->hasMany('App\VendorPrescription','prescription_id');
    }
    public function deliveryboylist(){
        return $this->hasMany('App\BookingDeliveryRequest','order_id','order_id')->where('status','<>','Cancel');

    }
    public function deliveryboy(){
        return $this->hasOne('App\BookingDeliveryRequest','order_id','order_id')->whereIN('status',['Accept','Delivery']);

    }
}
