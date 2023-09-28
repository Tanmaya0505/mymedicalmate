<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = ['account_id', 'reason_type', 'reasons'];
    
    public function accountType(){
    	return $this->belongsTo('App\AccountType', 'account_id');
    }
}
