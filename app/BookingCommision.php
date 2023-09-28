<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookingCommision extends Model
{
    //
    public function getCreatedAtAttribute($value){
        return  Carbon::parse($value)->format('d-m-Y');
    }
    public function getStatusAttribute($value){
    	if($value=='unpaid'){
    		return  '<span class="badge badge-light-danger">'.ucfirst($value).'</span>';
    	}else{
    		return  '<span class="badge badge-light-success">'.ucfirst($value).'</span>';
    	}
        
    }
    public function vendor(){
        return $this->hasOne('App\Customer','id','vendor_id');
    }
    public function vendornotify(){
        return $this->hasMany('App\Notification','to_user','vendor_id')
        ->where('status','Sent')->where('to_user_type','vendor')
        ->where('notification_type','Booking Commision Request');
        //->get();
    }
}
