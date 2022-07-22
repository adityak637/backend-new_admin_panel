<?php

namespace App\Http\Controllers;

use App\Models\Bookingtrip;
use App\Models\Booking;
use App\Models\CreateTravel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingtripController extends Controller
{
   
    public function index(Request $request)
    {

     
        $data=$request->all();

        $rules=[
          'users.*.name'=>'required',  
          'users.*.age'=>'required',  
          'users.*.price'=>'required',  
          'total_cost'=>'required',  
          'discount_price'=>'required',
          'trip_id'=>'required'
        ];

        $message=[
          'users.*.name'=>'Name is required',  
          'users.*.age'=>'age is required', 
          'users.*.price'=>'Price is required' ,
          'total_cost'=>'total_cost is required' ,
          'discount_price'=>'discount_price is required' ,
          'trip_id'=>'trip_id is required' ,
        ];

        $validator=Validator::make($data,$rules,$message);
        if($validator->fails()){
         return response()->json(['error'=>$validator->errors(),'code'=>402]);   
        }
$id=Auth::user()->id ?? '';
        $booking=new Booking;
        $booking->user_id=$id;
        $booking->transaction_status="pending";
        $booking->trip_id=$request->trip_id;
        $booking->total_cost=$request->total_cost;
        $booking->discount_price=$request->discount_price;
        $booking->save();

        
        foreach($data['users'] as $users){
            $Bookingtrip=new Bookingtrip;
            $Bookingtrip->booking_id=$booking->id;
            $Bookingtrip->name=$users['name'];
            $Bookingtrip->age=$users['age'];
            $Bookingtrip->price=$users['price'];
            $Bookingtrip->save();
            
        }
        return response()->json(['code'=>200,'message'=>"Booking added"]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booking()
    {
            if(Auth::id()){
                $date= Carbon::parse(date('d-m-Y'))->format('Y-m-d');
        $Booking=Booking::with('tripdetails')->where('user_id',Auth::id());

        if(!empty($date)){
               $Booking->whereHas('tripdetails', function ($query) use ($date) {
                $query->where('start_date','>=',$date);
            });
        }
        $bookings=$Booking->get();

       return response()->json(['code'=>200,'Booking'=>$bookings]);
            }
            else{
                 return response()->json(['code'=>403]);
            }
    }
    public function completedbooking()
    {
            if(Auth::id()){
                $date= Carbon::parse(date('d-m-Y'))->format('Y-m-d');
        $Booking=Booking::with('tripdetails')->where('user_id',Auth::id());

        if(!empty($date)){
               $Booking->whereHas('tripdetails', function ($query) use ($date) {
                $query->where('start_date','<',$date);
            });
        }
        $bookings=$Booking->get();

       return response()->json(['code'=>200,'Booking'=>$bookings]);
            }
            else{
                 return response()->json(['code'=>403]);
            }
    }
    public function failBooking()
    {
            if(Auth::id()){
        $Booking=Booking::with('tripdetails')->where('user_id',Auth::id())->where('transaction_status',0)->get();
       return response()->json(['code'=>200,'Booking'=>$Booking]);
            }
            else{
                 return response()->json(['code'=>403]);
            }
    }
    public function cancelbooking()
    {
            if(Auth::id()){
        $Booking=Booking::with('tripdetails')->where('user_id',Auth::id())->where('refunds',1)->get();
       return response()->json(['code'=>200,'Booking'=>$Booking]);
            }
            else{
                 return response()->json(['code'=>403]);
            }
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
     * @param  \App\Models\Bookingtrip  $bookingtrip
     * @return \Illuminate\Http\Response
     */
    public function show(Bookingtrip $bookingtrip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookingtrip  $bookingtrip
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookingtrip $bookingtrip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookingtrip  $bookingtrip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookingtrip $bookingtrip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookingtrip  $bookingtrip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookingtrip $bookingtrip)
    {
        //
    }
}