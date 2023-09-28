<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDeliveryRequest extends Model
{
    //
    public function deliveryboy(){
    	return $this->belongsTo('App\Customer', 'delivery_id');
    }
    public function booking(){
    	return $this->belongsTo('App\CustomerPrescription', 'order_id','order_id');
    }
}
