<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    public function customer(){

    	return $this->belongsTo('App\Customer', 'customer_id');

    }
    public function diseasedetails(){

    	return $this->hasMany('App\DiseaseDetail', 'disease_id');

    }
}
