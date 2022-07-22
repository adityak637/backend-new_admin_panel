<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    

public function index(Request $request){
    
      $validator = Validator::make($request->all(), [
            'title'=>'required',
            'query'=>'required',
            'traveller_id'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{

            
                $Enquiry=new Enquiry;
            $Enquiry->title=$request->title;
            $Enquiry->query=$request->query;
            $Enquiry->traveller_id=$request->traveller_id;
                  $Enquiry->Save();
        return response()->json(['code'=>200,'enquiry'=>$Enquiry]);
     
            
        }



}

}