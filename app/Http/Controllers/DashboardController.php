<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Validator;
use Session;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function dashboard() {
        $user = Auth::user();
        $user_role = $user->user_role;
        $all_permissions = [];
        if($user_role && $user->user_type==2){
            $role = Role::find($user_role);
           $permissions = $role->permissions;
           foreach($permissions as $per){
            $all_permissions[] = $per['route'];
           }
        }
        Session::put('all_permissions', $all_permissions);
        return view('pages.dashboard-ecommerce');
    }
    // analystic
    public function dashboardAnalytics(){
        return view('pages.dashboard-analytics');
    }
}
