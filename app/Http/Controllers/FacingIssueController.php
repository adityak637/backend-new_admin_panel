<?php

namespace App\Http\Controllers;

use App\Models\FacingIssue;
use App\Models\Createtrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacingIssueController extends Controller
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
            'phone'=>'required',
            'details'=>'required',
            'title'=>'required'
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
            $FacingIssue=new FacingIssue;
            $FacingIssue->name=$request->name;
            $FacingIssue->email=$request->email;
            $FacingIssue->phone_no=$request->phone;
            $FacingIssue->title=$request->title;
            $FacingIssue->details=$request->details;
                if(!empty($request->hasfile('screenshots'))){
                $file=$request->file('screenshots');
                $ext=$file->getClientOriginalExtension();
                $filename=time().'.'.$ext;
                $file->move('facingissue/',$filename);
                $FacingIssue->screenshots=$filename;
            }
            $FacingIssue->save();
             return response()->json(['code'=>200,'FacingIssue'=>$FacingIssue]);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

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
     * @param  \App\Models\FacingIssue  $facingIssue
     * @return \Illuminate\Http\Response
     */
    public function show(FacingIssue $facingIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacingIssue  $facingIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(FacingIssue $facingIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacingIssue  $facingIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacingIssue $facingIssue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacingIssue  $facingIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacingIssue $facingIssue)
    {
        //
    }
}