<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suggetion;
use App\Helpers\CustomerHelper;

class SuggetionsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function suggetions(){
        $config = CustomerHelper::configData('admin_config');
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ["link" => "/".$config['route']."/", "name" => "Home"], ["name" => "Suggetions"]
        ];
        $stateDistrictsJson = json_decode(file_get_contents(base_path('resources/data/states-and-districts.json')),true);
        $data = Suggetion::get();
        return view('pages.suggetions', ['config' => $config, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'stateDistrictsJson'=> $stateDistrictsJson, 'data' => $data]);
    }
    
}
