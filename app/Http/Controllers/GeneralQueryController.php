<?php

namespace App\Http\Controllers;

use App\Models\General_query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'title'=>'required',
            'querys'=>'required'
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{

            
                $Enquiry=new General_query;
            $Enquiry->name=$request->name;
            $Enquiry->email=$request->email;
            $Enquiry->title=$request->title;
            $Enquiry->querys=$request->querys;
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
     * @param  \App\Models\General_query  $general_query
     * @return \Illuminate\Http\Response
     */
    public function show(General_query $general_query)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\General_query  $general_query
     * @return \Illuminate\Http\Response
     */
    public function edit(General_query $general_query)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\General_query  $general_query
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, General_query $general_query)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\General_query  $general_query
     * @return \Illuminate\Http\Response
     */
    public function destroy(General_query $general_query)
    {
        //
    }
}