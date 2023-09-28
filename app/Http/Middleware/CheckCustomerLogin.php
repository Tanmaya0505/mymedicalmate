<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Customer;

class CheckCustomerLogin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(Session::get('userId') != ''){
            $checkUser = Customer::where('id', Session::get('userId'))->select('id', 'status')->first();
            if(!in_array($checkUser->status,[1,2])){
                return redirect('/logout');
            }
        }else{
            return redirect('/logout');
        }
        

        // if(Session::get('userId') == ""){
        //      return redirect('/');
        // }
        
        return $next($request);
    }

}
