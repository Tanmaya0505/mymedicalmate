<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllBonus extends Model
{
    public function user(){

    	return $this->belongsTo('App\Customer', 'user_id','id');

    }

    public function staff(){

    	return $this->belongsTo('App\User', 'staff_id','id');

    }
}
