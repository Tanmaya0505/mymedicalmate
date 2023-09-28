<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['id','user_config','assistant_config','doctor_config','admin_config','vendor_config'];
}
