<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Customer;
use App\AssistantBoyBooking;

class AssistantBoyBookingController extends \App\Http\Controllers\Controller
{
    public function bookAssistant(Request $request){
        
        dd($request->all());
    }
}
