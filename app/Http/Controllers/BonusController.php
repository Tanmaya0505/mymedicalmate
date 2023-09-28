<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AllBonus;
use App\Customer;
use App\Helpers\CustomerHelper;
use Carbon\Carbon;
use App\Http\Controllers\frontend\HomeController;
class BonusController extends Controller
{
    //
    public function index(Request $request){
        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Bonus listing"]

        ];
        $input_value = $request->all();

        $filters = [];
        $filters['user_id'] = isset($input_value['user_id']) ? $input_value['user_id'] : '';

        
        $all_bonus = AllBonus::with('user','staff')->where(function($query) use ($filters){

            foreach($filters as $column => $val){

                if($val != '') $query->where($column, $val);

            }

        })->orderBy('id','DESC')->get();
        $users = Customer::orderBy('first_name','ASC')->get();

        return view('pages.bonus.index', ['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'users' => $users, 'all_bonus' => $all_bonus]);

    }

    public function addbonus($user){
        $bonus_price = 100;
        if($user['bonus_type']=='Sign-Up'){
            $bonus_price = $user['bonus_price'] ?? 100;
        }
        if($user['bonus_type']=='Referal'){
            $bonus_price = $user['bonus_price'] ?? 100;
        }
        if($user['bonus_type']=='Purchase'){
            $bonus_price = $user['bonus_price'] ?? 100;
        }
        if($user['bonus_type']=='Special Bonus By Admin'){
            $bonus_price = $user['bonus_price'] ?? 100;
        }
        $bonus = new AllBonus();
        $bonus->user_id = $user['user_id'];
        $bonus->gen_date = Carbon::now();
        $bonus->exp_date = isset($user['exp_date']) ? Carbon::parse($user['exp_date'])->format('Y-m-d h:i:s') : Carbon::now()->addDays(30);
        $bonus->bonus_price = $bonus_price;
        $bonus->bonus_type = $user['bonus_type'];
        $bonus->status = 'ACTIVE';
        $bonus->owned_by = 'SYSTEM';
        $bonus->staff_id = $user['staff_id'] ?? '';
        $bonus->save();
        return $bonus;

    }
    public function store(Request $request){

        $cuser['user_id'] = $request->user_id;
        $cuser['bonus_price'] = $request->bonus;
        $cuser['exp_date'] = $request->exp_date;
        $cuser['bonus_type'] = 'Special Bonus By Admin';
        $this->addbonus($cuser);
        (new HomeController)->ReferalCodeCoinUpdateCustomer($request->user_id,$request->bonus);
        return back();

    }
}
