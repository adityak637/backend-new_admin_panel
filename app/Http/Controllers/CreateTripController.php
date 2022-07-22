<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Createtrip;
use App\Models\Itinerary;
use App\Models\Enquiry;
use App\Models\LocationImage;

class CreateTripController extends Controller
{
    public function index(Request $req){
          $validator = Validator::make($req->all(), [
            'traveller_id'=>'required',
            'trip_title'=>'required',
            'intro'=>'required',
            'type_of_trip'=>'required',
            'desination_name'=>'required',
            'duration'=>'required',
            'start_location'=>'required',
            'end_location'=>'required',
            'start_date'=>'required|date_format:d/m/Y',
            'end_date'=>'required|date_format:d/m/Y',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i',
            'itinerary'=>'required',
            'advises'=>'required',
            'B_number'=>'required',
            'guidelines'=>'required',
            'cover_photo'=>'required',
            'thumbnail_photo'=>'required',
            'discount_type'=>'required',
            'term_and_condition'=>'required',
            'booking_close'=>'required',
            'cost'=>'required',
            'location_image'=>'required',
        ]);

         if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
            $createtrip=new Createtrip;
            $createtrip->traveller_id=$req->traveller_id;
            $createtrip->intro=$req->intro;
            $createtrip->trip_title=$req->trip_title;
            $createtrip->short_message=$req->short_message;
            $createtrip->type_of_trip=$req->type_of_trip;
            $createtrip->desination_name=$req->desination_name;
            $createtrip->start_location=$req->start_location;
            $createtrip->end_location=$req->end_location;
            $createtrip->start_date=$req->start_date;
            $createtrip->end_date=$req->end_date;
            $createtrip->start_time=$req->start_time;
            $createtrip->end_time=$req->end_time;

            
            // $createtrip->itinerary=$itinerary_data;
            $createtrip->duration=$req->duration;
            $createtrip->advises=$req->advises;
            $createtrip->B_number=$req->B_number;
            $createtrip->guidelines=$req->guidelines;
            $createtrip->discount_type=$req->discount_type;
            if($req->hasfile('cover_photo')){
                $file=$req->file('cover_photo');
                $ext=$file->getClientOriginalExtension();
                $filename=time().'.'.$ext;
                $file->move('cover_photo/',$filename);
                $createtrip->cover_photo=$filename;
            }
            if($req->hasfile('thumbnail_photo')) {
                $filess=$req->file('thumbnail_photo');
                $exte=$filess->getClientOriginalExtension();
                $filenamess=time().'.'.$exte;
                $filess->move('thumbnail_photo/',$filenamess);
                $createtrip->thumbnail_photo=$filenamess;
                
            }
            $createtrip->promo_code=$req->promo_code;
            $createtrip->term_and_condition=$req->term_and_condition;
            $createtrip->booking_close=$req->booking_close;
            $createtrip->cost=$req->cost;
            $createtrip->status=1;
            $createtrip->save();
           
                foreach( $req->itinerary as $image)
            {
                $content = new Itinerary;
                $content->trip_id=$createtrip->id;
                $content->itinerary = $image;
                $content->save();                
            }
            
             if($req->hasFile('location_image'))
        {
            foreach($req->file('location_image') as $image)
            {
                $content = new LocationImage;
                $destinationPath = 'location_image/';
                $filename = $image->getClientOriginalExtension();
                 $filenamess=time().'.'.$filename;
                $image->move($destinationPath, $filenamess);
                $image->trip_id=$createtrip->id;
                $content->image = $destinationPath.'/'.$filenamess;
                $content->save();                
            }
            
        }


return response()->json(['code'=>200,'message'=>'Trip Created successfully']);
        }
    }
    public function submit(Request $req){
        
          $validator = Validator::make($req->all(), [
            'traveller_id'=>'required',
            'trip_title'=>'required',
            'intro'=>'required',
            'type_of_trip'=>'required',
            'desination_name'=>'required',
            'duration'=>'required',
            'start_location'=>'required',
            'end_location'=>'required',
            'start_date'=>'required|date_format:d-m-Y',
            'end_date'=>'required|date_format:d-m-Y',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i',
            'itinerary'=>'required',
            'advises'=>'required',
            'B_number'=>'required',
            'guidelines'=>'required',
            'cover_photo'=>'required',
            'thumbnail_photo'=>'required',
            'discount_type'=>'required',
            'term_and_condition'=>'required',
            'booking_close'=>'required',
            'cost'=>'required',
            'location_image'=>'required',
        ]);

         if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
            $createtrip=new Createtrip;
            $createtrip->traveller_id=$req->traveller_id;
            $createtrip->intro=$req->intro;
            $createtrip->trip_title=$req->trip_title;
            $createtrip->short_message=$req->short_message;
            $createtrip->type_of_trip=$req->type_of_trip;
            $createtrip->desination_name=$req->desination_name;
            $createtrip->start_location=$req->start_location;
            $createtrip->end_location=$req->end_location;
            $createtrip->start_date=$req->start_date;
            $createtrip->end_date=$req->end_date;
            $createtrip->start_time=$req->start_time;
            $createtrip->end_time=$req->end_time;

            $createtrip->duration=$req->duration;
            $createtrip->advises=$req->advises;
            $createtrip->B_number=$req->B_number;
            $createtrip->guidelines=$req->guidelines;
            $createtrip->discount_type=$req->discount_type;
            
                    if($req->hasfile('cover_photo')){
                $file=$req->file('cover_photo');
                $ext=$file->getClientOriginalExtension();
                $filename=time().'.'.$ext;
                $file->move('cover_photo/',$filename);
                $createtrip->cover_photo=$filename;
                
            }
            if($req->hasfile('thumbnail_photo')){
                $filess=$req->file('thumbnail_photo');
                $exte=$filess->getClientOriginalExtension();
                $filenamess=time().'.'.$exte;
                $filess->move('thumbnail_photo/',$filenamess);
                $createtrip->thumbnail_photo=$filenamess;
                
            }
            $createtrip->promo_code=$req->promo_code;
            $createtrip->term_and_condition=$req->term_and_condition;
            $createtrip->booking_close=$req->booking_close;
            $createtrip->cost=$req->cost;
            $createtrip->status=2;
            $createtrip->save();
            $location_image=array();
                    foreach( $req->itinerary as $image)
            {
                $content = new Itinerary;
                $content->trip_id=$createtrip->id;
                $content->itinerary = $image;
                $content->save();                
            }
            
             if($req->hasFile('location_image'))
        {
            foreach($req->file('location_image') as $image)
            {
                $content = new LocationImage;
                $destinationPath = 'location_image/';
                $filename = $image->getClientOriginalExtension();
                 $filenamess=time().'.'.$filename;
                $image->move($destinationPath, $filenamess);
                $image->trip_id=$createtrip->id;
                $content->image = $destinationPath.'/'.$filenamess;
                $content->save();                
            }
            
        }
            return response()->json(['code'=>200]);
        }
    }

    public function search($id){
        
        if(!empty($id)){
            if($id=='past_trip'){
                $Createtrip=Createtrip::where('end_date', '<',date('Y-m-d'))->get();
                return response()->json(['code'=>200,'trip'=>$Createtrip]); 
            }elseif($id=='upcoming_trip'){
                $Createtrip=Createtrip::where('end_date', '>', date('Y-m-d'))->get();
                  return response()->json(['code'=>200,'trip'=>$Createtrip]); 
            }elseif($id=='current_trip'){
                $Createtrip=Createtrip::where('end_date', '=',date('Y-m-d'))->get();
                  return response()->json(['code'=>200,'trip'=>$Createtrip]); 
            }else{
                return response()->json(['code'=>403,'message'=>'Invalid response']); 
            }
            
        }else{
          return response()->json(['code'=>403,'message'=>'Invalid Url']);  
        }
    }
// status ==1 Archived 
// status ==2 underreview 
// status ==3 rejected 
// status ==4 ongoing 
// status ==5 cancel trip 

    public function archived($id){
        
        if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('traveller_id',$id)->where('status',1)->paginate(5);
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']); 
    }
    public function underreview($id){
        
        if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('traveller_id',$id)->where('status',2)->paginate(5);
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']); 
    }
    public function rejecttrip($id){
        
        if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('traveller_id',$id)->where('status',3)->paginate(5);
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']); 
    }
    public function ongoing($id){
        
        if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('traveller_id',$id)->where('status',4)->paginate(5);
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']); 
    }
    public function canceltrip($id){
        
        if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('traveller_id',$id)->where('status',5)->paginate(5);
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']); 
    }
    public function archived_submit($id){
        
        if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('id',$id)->update(['status'=>2]);
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']); 
    }
    public function completedtrip($id){
    
        if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('traveller_id',$id)->where('end_date','<', date('d/m/Y'))->paginate(5);
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']); 
    }


// enquiry by the traveller

public function enquiry(Request $request){
    
      $validator = Validator::make($request->all(), [
            'title'=>'required',
            'comment'=>'required',
            'traveller_id'=>'required',
        ]);

        if($validator->fails()){
             return response()->json(['error'=>$validator->errors(),'code'=> 402]);
        }else{
                $Enquiry=new Enquiry;
            $Enquiry->title=$request->title;
            $Enquiry->query=$request->comment;
            $Enquiry->traveller_id=$request->traveller_id;
            $screenshot = $request->file('screenshot');
            if(!empty($screenshot)){
                $screenshot=$request->file('screenshot');
                $exte=$screenshot->getClientOriginalExtension();
                $filenamess=time().'.'.$exte;
                $screenshot->move('enquiry/',$filenamess);
                $Enquiry->image=$filenamess;
                
            }
                  $Enquiry->Save();
        return response()->json(['code'=>200,'enquiry'=>$Enquiry]);
        }



}

// id=trip id and promocode 
public function promocode($id,$promocode){
            if(!empty($id && is_numeric($id))){
           $Createtrip= Createtrip::where('id',$id)->where('promo_code',$promocode)->get();
           return response()->json(['code'=>200,'archived'=>$Createtrip]);
        }
        return response()->json(['code'=>403,'message'=>'Invalid response']);
    
}

}