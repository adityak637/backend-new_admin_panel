<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InterestedTripController;

use Illuminate\Support\Facades\Validator;

class InterestedTripControllerController extends Controller
{
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',
            'trip_id'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
        $InterestedTripController=new InterestedTripController;
        $InterestedTripController->user_id=$request->user_id;
        $InterestedTripController->trip_id=$request->trip_id;
        $InterestedTripController->save();
        return response()->json(['code'=>200]);
        }
    }
    public function remove(Request $request){
        $validator = Validator::make($request->all(), [
            'interrest_id'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
        $InterestedTripController=InterestedTripController::find($request->interrest_id);
        $InterestedTripController->delete();
        return response()->json(['code'=>200]);
        }
    }
    public function interested(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
        $InterestedTripController=InterestedTripController::all();
        return response()->json(['code'=>200,'InterestedTripController'=>$InterestedTripController]);
        }
    }
}
