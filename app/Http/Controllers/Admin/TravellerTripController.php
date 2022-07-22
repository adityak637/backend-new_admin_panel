<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Createtrip;
use App\Models\Booking;
use App\Models\Bookingtrip;
use App\Models\CreateTravel;
use Carbon\Carbon;

class TravellerTripController extends Controller
{
    public function index(){
        $Createtrip=Createtrip::with('user')->sortable()->paginate(6);
        return view('Admin.trip')->with(['Createtrip'=>$Createtrip]);
    }
    public function fetch($id){
        $Createtrip=Createtrip::with('locationImage','user')->find($id);
        $Booking=Booking::with('users','trip')->where('trip_id',$id)->paginate(6);
        
        
        return view('Admin.trip_view')->with(['Createtrip'=>$Createtrip,'Booking'=>$Booking]);
    }
    public function tripsearch(Request $request){
       $t_name=$request->t_name ;
        $trip_id=$request->trip_id ;
        $trip_data=$request->trip_data;
        $start_date=$request->start_date ;
        $end_date=$request->end_date;
        

        $travel=Createtrip::with('locationImage');
       
        if($t_name){
            $travel->where('name', "LIKE", "%$t_name%");
        }
        if($trip_id){
            $travel->where('trip_id', "LIKE", "$trip_id");
        }
        if($end_date){
            $travel->whereDate('end_date', "LIKE", Carbon::parse($end_date)->format('Y-m-d'));
        }
        if($start_date){
            $travel->whereDate('start_date', "LIKE", Carbon::parse($start_date)->format('Y-m-d'));
        }
        if($trip_data){
            if($trip_data=='past_trip'){
                $travel->where('end_date', '<',date('Y-m-d'));
            }
            if($trip_data=='upcoming_trip'){
                $travel->where('end_date', '>', date('Y-m-d'));
            }
            if($trip_data=='current_trip'){
                $travel->where('end_date', '=',date('Y-m-d')); 
            }
            if($trip_data=='underreview'){
                $travel->where('status', 2); 
            }
            if($trip_data=='ongoing'){
                $travel->where('status', 4); 
            }
            if($trip_data=='rejected'){
                $travel->where('status', 3); 
            }
            if($trip_data=='cancel'){
                $travel->where('status', 5); 
            }
        }
       $Createtrip= $travel->sortable()->paginate(6);
      
        return view('Admin.trip')->with([
            'Createtrip'=>$Createtrip,
            't_name'=>$t_name,
            'trip_id'=>$trip_id,
            'trip_data'=>$trip_data,
            'start_date'=>$start_date,
            'end_date'=>$end_date
        ]);
    }

    public function tripstatus($id,$status){
    
        if(!empty($status) && is_numeric($status)){
            Createtrip::where('id',$id)->update(['status'=>$status]);
            return response()->json([
            'status'=>200
        ]);
        }
        return response()->json([
            'status'=>401
        ]);
    }


    public function trip_details_serach($id,Request $request)
    
    {
        $uname=$request->uname ?? '';
        $email=$request->email ?? '';
        $mobile=$request->mobile ?? '';
        $booking_status=$request->booking_status ?? '';
        $transaction=$request->transaction ?? '';
       $Createtrip=Createtrip::with('locationImage','user')->find($id);
        $Bookings=Booking::with('users','trip')->where('trip_id',$id);
        if(!empty($uname)){
               $Bookings->whereHas('users', function ($query) use ($uname) {
                $query->where('firstname', 'like', "%$uname%");
            });
        }
        if(!empty($email)){
               $Bookings->whereHas('users', function ($query) use ($email) {
                $query->where('email', 'like', "%$email%");
            });
        }
        if(!empty($mobile)){
               $Bookings->whereHas('users', function ($query) use ($mobile) {
                $query->where('mobile', 'like', "%$mobile%");
            });
        }
        if(!empty($booking_status)){
               $Bookings->whereHas('trip', function ($query) use ($booking_status) {
                $query->where('transaction_status', 'like', "%$booking_status%");
            });
        }
        if(!empty($transaction)){
               $Bookings->whereHas('trip', function ($query) use ($transaction) {
                $query->where('transaction_id', 'like', "%$transaction%");
            });
        }

        $Booking=$Bookings->paginate(6);
        
        
        return view('Admin.trip_view')->with([
            'Createtrip'=>$Createtrip,
            'Booking'=>$Booking,
            'uname'=>$uname,
            'email'=>$email,
            'mobile'=>$mobile,
            'booking_status'=>$booking_status,
            'transaction'=>$transaction
        ]);
    }
}