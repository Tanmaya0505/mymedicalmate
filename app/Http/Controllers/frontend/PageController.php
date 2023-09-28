<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

class PageController extends \App\Http\Controllers\Controller
{
    
    public function about()
    {
        return view('frontend-source.about');
    }
    
    public function terms()
    {
        return view('frontend-source.terms');
    }
    
    public function privacyPolicy(){
        return view('frontend-source.privacy-policy');
    }
    
    public function returnPolicy()
    {
        return view('frontend-source.return-policy');
    }
    
    public function disclaimer()
    {
        return view('frontend-source.disclaimer');
    }
    
    public function contact()
    {
        return view('frontend-source.contact');
    }

}
