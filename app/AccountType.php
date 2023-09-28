<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $fillable = ['id','account_name','account_name_slug', 'account_icon', 'account_description', 'status'];
}
