<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferalBonus extends Model
{
    public function customer(){

   		return $this->hasOne('App\Customer','id', 'user_id');

   }
}
