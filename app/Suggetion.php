<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggetion extends Model
{
    protected $fillable = ['customer_id', 'sugg_name', 'sugg_phone', 'sugg_email', 'sugg_complaint_type', 'sugg_state', 'sugg_district', 'sugg_message'];
    
    public function customerData(){
    	return $this->belongsTo('App\Customer', 'customer_id');
    }
}
