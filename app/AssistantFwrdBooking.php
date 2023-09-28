<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssistantFwrdBooking extends Model
{
    protected $fillable = ['id','booking_id','assistant_boy_fwrd_from_id','assistant_boy_fwrd_from_meta','assistant_boy_fwrd_comment','assistant_boy_fwrd_to_id','assistant_boy_fwrd_to_meta'];
}
