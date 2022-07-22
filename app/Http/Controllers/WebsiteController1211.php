<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Createtrip;
use App\Models\CreateTravel;
use Carbon\Carbon;


class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dates=$request->date ?? '';
        $locations =$request->locations ?? '';
        $traveller_name=$request->traveller_name ?? '';
         $trips=Createtrip::where('status',4);
        if(!empty($dates)){
             $trips->whereDate('start_date',Carbon::parse($dates)->format('d-m-Y') );
        }
        if($locations){
               $trips->where('desination_name', "LIKE","%$locations%" );
        }

        if(!empty($traveller_name)){
               $trips->whereHas('user', function ($query) use ($traveller_name) {
                $query->where('First_Name', 'like', "%$traveller_name%");
            });
        }
         $Createtrip= $trips->paginate(10);

          return response()->json(['code'=>200,'Createtrip'=>$Createtrip,'locations'=>$locations]);
        

        
    }

       public function triplist($id){
        
        if(!empty($id) && is_numeric($id)){
            $trips=Createtrip::where('traveller_id',$id)->where('status',4)->paginate(10);
            return response()->json(['code'=>200,'trips'=>$trips]);
        }

 return response()->json(['code'=>403,'Createtrip'=>"No Traveller Found"]);
        
       }

       public function hotlocation(){
           $trips=Createtrip::where('hotlocation',1)->where('status',4)->get();
            return response()->json(['code'=>200,'trips'=>$trips]);
       }

       
       public function randomtrip(){
           $trips=Createtrip::where('status',4)->inRandomOrder()->limit(10)->get();
           return response()->json(['code'=>200,'trips'=>$trips]);
       }

       public function get_search_items (Request $request){
          $locations= Createtrip::where('status',4)->get();
          $traveller_name= CreateTravel::where('status',1)->get();
          return response()->json(['code'=>200,'locations'=>$locations,'traveller_name'=>$traveller_name]);
           
       }
       
}