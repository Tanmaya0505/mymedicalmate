<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssistantCancelBooking extends Model
{
    protected $fillable = ['id','booking_id','from_canceled','cancel_reason'];
}
