<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locator extends Model
{
    protected $fillable = ['customer_id', 'device_type', 'ip_address', 'city', 'country', 'country_code','region', 'geo_location_info', 'device_browser_info'];
    
    public function customer(){
    	return $this->belongsTo('App\Customer', 'customer_id');
    }
}
