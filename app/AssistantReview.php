<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssistantReview extends Model
{
    protected $fillable = ['id','booking_id','rating','review','photo','status'];
}
