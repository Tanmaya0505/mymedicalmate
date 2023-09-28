<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Suggetion;
use Session;

class AjaxController extends \App\Http\Controllers\Controller
{
    public function searchDistricts(Request $request){
        $state = $request->input('state');
        if($state == '') {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please select a valid states"]);
        }
        $stateDistrictsJson = json_decode(file_get_contents(base_path('resources/data/states-and-districts.json')),true);
        $states = array_filter($stateDistrictsJson['states'], function ($v, $k) use($state){
                    return ($v['status'] === 1 && $k == $state);
                }, ARRAY_FILTER_USE_BOTH);
        if($states){
            return response()->json(['code' => 200,'response' => "SUCCESS", 'message' => "Successfully fatched", 'data' => $states[$state]['districts']]);
        } else {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please try again"]);
        }
    }
    
    public function submitSuggetion(Request $request){
//        $this->validate(
//            $request, [
//                'sugg_name' => 'required|string|max:30',
//                'sugg_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
//                'email' => 'required|email',
//                'sugg_complaint_type' => 'required|string|max:20',
//                'sugg_message' => 'required',
//            ]
//        );
        $requestData = $request->all();
        $requestData['customer_id'] = Session::get('userId') ?? null;
        $insert = Suggetion::create($requestData);
        if($insert){
            return response()->json(['code' => 200,'response' => "SUCCESS", 'message' => "You have Successfully submited your suggetion"]);
        } else {
            return response()->json(['code' => 204,'response' => "ERROR", 'message' => "Please try again"]);
        }
    }
}
