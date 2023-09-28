<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class AssistantBoyBooking extends Model
{
    protected $fillable = ['id','customer_id','assistant_boy_id','assistant_boy_meta', 'customer_meta',
     'book_date', 'arrival_time', 'pickup_status', 'arrival_km', 'early_serial_status', 'early_serial',
      'fooding_status', 'booking_criteria', 'currency', 'coupon_status', 'total_price','pickup_price',
      'discount_price', 'grand_price', 'booking_status','fwrd_status','payment_mode','payment_receive_status',
       'customer_review_status', 'assistant_review_status', 'booking_id', 'transaction_id', 'cronjob_status',
       'booking_pin','booking_type','extend_hour'];
    
    // public function setBookingPinAttribute($value){
    //     if(!$value){
    //       $this->attributes['booking_pin'] = rand(10000,99999);;
    //     }
    // }
    public function customerData(){
    	return $this->belongsTo('App\Customer', 'customer_id');
    }
    
    public function assistantData(){
    	return $this->belongsTo('App\Customer', 'assistant_boy_id');
    }
    
    public function reviewData(){
    	return $this->hasMany('App\AssistantReview', 'booking_id')->whereNotNull('user_id');;
    }
    public function asstreviewData(){
        return $this->hasMany('App\AssistantReview', 'booking_id')->whereNotNull('medmate_id');;
    }
    
    public function FwrdData(){
    	return $this->hasMany('App\AssistantFwrdBooking', 'booking_id');
    }
    public function prescription(){
        return $this->hasOne('App\CustomerPrescription','order_id','booking_id');
    }
    public function setServiceStartTimeAttribute($value){
        $this->attributes['service_start_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
    public function getServiceStartTimeAttribute($value){
        return Carbon::parse($value)->format('h:i A');
    }
    public function medmaterequestlists(){
        return $this->hasMany('App\OrderMedmate','booking_id','booking_id');
    }
    public function activeBooking(){
        return $this->hasOne('App\AssistantBoyBooking','assistant_boy_id','assistant_boy_id')
        //->where('booking_type','fullbook')
        ->whereIn('booking_status',[3]);
    }
    
}
