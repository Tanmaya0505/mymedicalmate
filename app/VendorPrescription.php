<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorPrescription extends Model
{
    protected $fillable = ['vendor_id', 'prescription_id', 'medicine', 'status'];
    
    public function vendor(){
    	return $this->belongsTo('App\Customer', 'vendor_id');
    }
    
    public function prescription(){
    	return $this->belongsTo('App\CustomerPrescription', 'prescription_id');
    }
}
