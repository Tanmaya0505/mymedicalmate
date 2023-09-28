<?php

namespace App\Http\Controllers;

use App\QuestionAnswar;
use App\Coupon;
use App\Customer;
use Illuminate\Http\Request;
use App\Helpers\CustomerHelper;

class QuestionAnswarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Question Answer listing"]

        ];
        //$input_value = $request->all();
        $all_coupons = QuestionAnswar::orderBy('id','DESC')->get();
        // $post = Coupon::where('user_ids', 6);
        // dd($post->coupon_name);
        return view('pages.question-answar.index', ['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'all_coupons' => $all_coupons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);

        if($request->quest_answ_id){
            $new_Ques_answ = QuestionAnswar::find($request->quest_answ_id);
        }else{
            $new_Ques_answ = new QuestionAnswar();
        }
        $new_Ques_answ->category = $request->category_name;
        $new_Ques_answ->question = $request->question;
        $new_Ques_answ->answar = $request->answer;
        
        $new_Ques_answ->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionAnswar  $questionAnswar
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionAnswar $questionAnswar)
    {
        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Question Answer Add"]

        ];
        
        return view('pages.question-answar.add',['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionAnswar  $questionAnswar
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionAnswar $questionAnswar,$id)
    {
        $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Question Answer Edit"]

        ];
        
        $quesAnsw = $questionAnswar->find($id);
        return view('pages.question-answar.edit',['quesAnsw' => $quesAnsw,'configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionAnswar  $questionAnswar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionAnswar $questionAnswar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionAnswar  $questionAnswar
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionAnswar $questionAnswar,$id)
    {
        //dd($id);
        $coupon = $questionAnswar->find($id)->delete();
        return back();
    }
}
