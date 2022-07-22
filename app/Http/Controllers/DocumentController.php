<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
         $validator = Validator::make($request->all(), [
            'Aadhaar'=>'required',
            'Pan'=>'required',
            'bank_name'=>'required',
            'bank_account'=>'required',
            'confirm_bank_account'=>'required',
            'ifsc'=>'required',
            'phone'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{

            if(!empty($id) && Is_numeric($id)){
                $document=Document::where('traveller_id',$id)
                ->update([
                    'Aadhaar'=>$request->Aadhaar,
                    'Pan'=>$request->Pan,
                    'bank_name'=>$request->bank_name,
                    'bank_account'=>$request->bank_account,
                    'confirm_bank_account'=>$request->confirm_bank_account,
                    'ifsc'=>$request->ifsc,
                    'phone'=>$request->phone
            ]);
                return response()->json(['code'=>200,'document'=> $document]);
            }
            return response()->json(['code'=>401,'message'=> "Yor are not authorized Person"]);
            
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
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}