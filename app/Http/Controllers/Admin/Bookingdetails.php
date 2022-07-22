<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookingtrip;

class Bookingdetails extends Controller
{
    public function index(Request $request){
        $id= $request->id;
        $data=Bookingtrip::where('booking_id',$id)->get();
        return response()->json([
           'data'=>$data 
        ]);
    }
}