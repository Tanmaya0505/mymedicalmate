<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffWorkingHour extends Model
{
    //

    public function user(){

    	return $this->belongsTo('App\User', 'staff_id','id');

    }

    public function end_date()
    {
        return $this->belongsTo(self::class, 'staff_id')->orderBy('id','DESC');
    }
}
