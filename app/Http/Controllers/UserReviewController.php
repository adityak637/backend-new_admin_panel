<?php

namespace App\Http\Controllers;

use App\Models\UserReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',
            'trip_id'=>'required',
            'rating'=>'required',
            'review'=>'required'
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
        $user_review=new UserReview;
        $user_review->user_id=$request->user_id;
        $user_review->trip_id=$request->trip_id;
        $user_review->rating=$request->rating;
        $user_review->review=$request->review;
        $user_review->save();
        return response()->json(['code'=>200,'user_review'=>$user_review]);
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function show(UserReview $userReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function edit(UserReview $userReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserReview $userReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserReview  $userReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserReview $userReview)
    {
        //
    }
}