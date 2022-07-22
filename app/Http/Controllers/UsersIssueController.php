<?php

namespace App\Http\Controllers;

use App\Models\Users_Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'username'=>'required',
            'useremail'=>'required',
            'transactionId'=>'required',
            'tripId'=>'required',
            'details'=>'required'
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{

            
                $Enquiry=new Users_Issue;
            $Enquiry->username=$request->username;
            $Enquiry->useremail=$request->useremail;
            $Enquiry->transactionId=$request->transactionId;
            $Enquiry->tripId=$request->tripId;
            $Enquiry->details=$request->details;
                  $Enquiry->save();
        return response()->json(['code'=>200,'enquiry'=>$Enquiry]);
     
            
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
     * @param  \App\Models\Users_Issue  $users_Issue
     * @return \Illuminate\Http\Response
     */
    public function show(Users_Issue $users_Issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users_Issue  $users_Issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Users_Issue $users_Issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users_Issue  $users_Issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users_Issue $users_Issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users_Issue  $users_Issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users_Issue $users_Issue)
    {
        //
    }
}