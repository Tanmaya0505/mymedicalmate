<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\StaffWorkingHour;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        
            $new_entry = new StaffWorkingHour();
            $new_entry->staff_id = Auth::user()->id;
            $new_entry->login_date = Carbon::now()->format('Y-m-d');
            $new_entry->login_date_time = Carbon::now();
        
        $new_entry->save();
    }
    
    public function logout() {

        $new_entry = StaffWorkingHour::where('staff_id',Auth::user()->id)->where('login_date',Carbon::today()->format('Y-m-d'))->whereNull('logout_date_time')->first();

        if(!$new_entry){
            $new_entry = new StaffWorkingHour();
            $new_entry->staff_id = Auth::user()->id;
            $new_entry->login_date = Carbon::now()->format('Y-m-d');
            $new_entry->login_date_time = Carbon::now();
        }else{
            $new_entry->logout_date_time = Carbon::now();
        }
        $new_entry->save();
        Auth::logout();
        return redirect('/cms-admin');
    }
}
