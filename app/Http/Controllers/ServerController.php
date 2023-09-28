<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller {
    
    public function server(){
        print_r($_SERVER['HTTP_HOST']); exit;
    }
}
