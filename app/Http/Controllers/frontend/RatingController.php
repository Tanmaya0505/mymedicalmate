<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        // $data_id=$request->userid;
        // $userdetail_id=$request->userdetail_id;
        // $rating=Rating::where('user_id',$data_id)->where('userdetail_id',$userdetail_id)->first();
        //dd($request->userid) ;
        $customerdetail = Rating::where('userdetail_id',$request->userdetail_id)->where('user_id',$request->userid)->get();
        //dd(count($customerdetail));
        if(count($customerdetail) == 0){
            //dd($request->userid) ;
            $rating = new Rating();
            $costar=count($request->star);
            $imstar=implode(",",$request->star);
            $rating->user_id=$request->userid;
            $rating->userdetail_id=$request->userdetail_id;
            $rating->rating=$costar; 
            $rating->rating_message=$request->rating_message;
            $rating->save();
        }else{
            $rating = Rating::where('userdetail_id',$request->userdetail_id)->where('user_id',$request->userid)->first(); 
            $costar=count($request->star);
            $imstar=implode(",",$request->star);
            $rating->rating=$costar; 
            $rating->rating_message=$request->rating_message;
            
            $rating->save();
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
