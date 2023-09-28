<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMedmate extends Model
{
    public function medmate(){
    	return $this->hasOne('App\Customer','id', 'medmate_id');
    }
}
