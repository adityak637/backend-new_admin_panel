<?php

namespace App\Http\Controllers;

use App\Models\CreateTravel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TravellerOtp;
use App\Models\Createtrip;
use App\Models\User;

class CreateTravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function travel_update(Request $req,$id)
    {
        $validator = Validator::make($req->all(), [
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'Short_Intro'=>'required',
            'DOB'=>'required',
            'email'=>'required|email|unique:create_travel',
            'Contact_No'=>'required',
            'Country'=>'required',
            'City'=>'required',
            'Pin_Code'=>'required',
            'Profile_URLs'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
            if(!empty($id) && is_numeric($id)){
                $CreateTravel=CreateTravel::findOrFail($id);
                $CreateTravel->First_Name=$req->First_Name;
                $CreateTravel->Last_Name=$req->Last_Name;
                $CreateTravel->Short_Intro=$req->Short_Intro;
                $CreateTravel->DOB=$req->DOB;
                $CreateTravel->Contact_No=$req->Contact_No;
                $CreateTravel->Country=$req->Country;
                $CreateTravel->City=$req->City;
                $CreateTravel->Pin_Code=$req->Pin_Code;
                if(!empty($req->hasfile('Profile_URLs'))){
                $file=$req->file('Profile_URLs');
                $ext=$file->getClientOriginalExtension();
                $filename=time().'.'.$ext;
                $file->move('traveller/',$filename);
                $CreateTravel->Profile_URLs=$filename;
            
            }
            if($CreateTravel->save()){
                return response()->json(['code'=>200,'CreateTravel'=>$CreateTravel]);
            }else{
                return response()->json(['code'=>401,'message'=>"you are not authorized person to access this page"]);  
            }
        }
        return response()->json(['code'=>404,'message'=>"Technical Issue"]);
        }
    }



    public function otp(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{

        $email=$request->email;
        $otp=rand(111111,999999);
        $data=CreateTravel::where('email',$email)->update(['otp'=>$otp]);
        if($data){

            $traveller=CreateTravel::where('email',$email)->first();
             Mail::to($traveller->email)->send(new TravellerOtp($traveller));
             return response()->json(['code'=>200,'message'=>"Please check your Mail"]);

        }else{
             return response()->json(['code'=>401,'message'=>"you are not authorized person to access this page"]);  
        }
        }
    }

    public function logout(Request $req){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Traveller Logout Successfully','code'=>200]);

        
    }


    public function login(Request $req){
         $validator = Validator::make($req->all(), [
            'email'=>'required',
            'otp'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
        $email=$req->email;
        $otp=$req->otp;
            $role='traveller';
        $user= CreateTravel::with('document')->where('email', $email)->where('otp', $otp)->where('role', $role)->first();
        if(!empty($user)){
             $token = $user->createToken('traveller_token')->plainTextToken;
             return response()->json([
                 'id'=>$user->id,
                 'First_Name'=>$user->First_Name,
                 'Last_Name'=>$user->Last_Name,
                 'email'=>$user->email,
                 'Contact_No'=>$user->Contact_No,
                 'status'=>$user->status,
                 'role'=>$user->role,
                 'token'=>$token,
                 'code'=>200]);
             }
           return response()->json(['code'=>401,'message'=>"you are not authorized person to access this page"]);  
    }
}
    

 
    public function dashboard($id,Request $req)
    {
        if(!empty($id) && is_numeric($id)){
                $totaltripcreate=Createtrip::where('traveller_id',$id)->count();
                $totaltripArchived=Createtrip::where('traveller_id',$id)->where('status',1)->count();
                $totaltripunderreview=Createtrip::where('traveller_id',$id)->where('status',2)->count();
                $totaltriprejected=Createtrip::where('traveller_id',$id)->where('status',3)->count();
                $totalOngoingtrip=Createtrip::where('traveller_id',$id)->where('status',4)->count();
                $totaltripcancel=Createtrip::where('traveller_id',$id)->where('status',5)->count();
                $okk=Createtrip::with('user','booking')->where('traveller_id',$id)->count();

                
                return response()->json(['code'=>200,
            'totaltripcreate'=>$totaltripcreate,
            'totaltripArchived'=>$totaltripArchived,
            'totalOngoingtrip'=>$totalOngoingtrip,
            'totaltripunderreview'=>$totaltripunderreview,
            'totaltriprejected'=>$totaltriprejected,
            'totaltripcancel'=>$totaltripcancel,
            'okk'=>$okk,
            ]);
        }else{
                return response()->json(['code'=>401,'message'=>"you are not authorized person to access this page"]);  
            }
    }

   

   
}