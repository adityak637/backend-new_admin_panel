<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Createtrip;
use App\Models\Booking;
use App\Models\Bookingtrip;
use App\Models\CreateTravel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->paginate(env('PAGINATION_COUNT', 5))->appends(\Arr::except($request->query(), 'page'));
        return view('Admin.user')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('Admin.create_user');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'email' => 'required|email',
            'mobile' => 'required'
        ]);
        // dd($request->name);
        $user = new User;
        $user->firstname=$request->firstname;
        $user->lastname=$request->lastname;
        $user->email=$request->email;
        $user->mobile=$request->mobile;
        $user->password=Hash::make($request->mobile);
        if($user->save()){
            $user->assignRole('user');
            $request->session()->flash('message',"User Added Successfully");
            return redirect()->back()->with("Traveller Added Successfully");
        }else{
            $req->session()->flash('message',"Please Try Again");
            return redirect()->back()->with("Please Try Again");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id,Request $req)
    {
        if(!empty($id)){
        $User= User::find($id);
        $User->delete();
        $req->session()->flash("usermessage","Users deleted Successfully");
        return redirect()->back()->with("usermessage","Users deleted Successfully");
    }
}

    public function user_view($id,Request $req)
    {
        if(!empty($id)){
        $User= User::find($id);
        $Booking=Booking::with('users','trip','tripdetails')->where('user_id',$id)->paginate(6);
        // echo "<pre>";
        // print_r($Booking);
        // die;
        return view('Admin.user_view')->with(['User'=>$User,'Booking'=>$Booking]);
    }
}
    public function edit_user($id,Request $req)
    {
        if(!empty($id)){
        $User= User::find($id);
        return view('Admin.edit_user')->with(['User'=>$User]);
    }
}
    public function update_user(Request $req)
    {
        $id=$req->id;
        $User= User::find($id);
        $User->firstname= $req->firstname;
        $User->email= $req->email;
        $User->mobile= $req->mobile;
        $User->save();
        $req->session()->flash("usermessage","Users updated Successfully");
        return redirect()->back()->with(['User'=>$User]);
   
}

 public function status($id,$status,Request $req){
    $idd=base64_decode($id);
        if(!empty($idd)){
            if($status==1){
                echo "ok";
                 $travel= User::find($idd);
                 $travel->status=1;
                 $travel->save();
        return redirect('/user');
            }
            if($status==0){
                echo "noo";
                     $travel= User::find($idd);
                       $travel->status=0;
                 $travel->save();
        return redirect('/user');
            }
       return redirect('/user');

        }
    }

     public function search(Request $req){

        $search=$req->search;
        $users=User::where('firstname','like','%'.$search.'%')
        ->orWhere("lastname", "LIKE", "%$search%")
        ->orWhere("email", "LIKE", "%$search%")
        ->orWhere("mobile", "LIKE", "%$search%")
        ->paginate(5);
        return view('Admin.user')->with(compact('users','search'));
    }
    
    public function user_details_serach(Request $req,$id){

        $trip_id=$req->trip_id ?? ''; 
        $transaction_status=$req->transaction_status ?? ''; 
        $Transaction_id=$req->Transaction_id ?? ''; 
        $total_cost=$req->total_cost ?? ''; 
     $User= User::find($id);
         $trips=Booking::with('users','trip','tripdetails')->where('user_id',$id);
       
        if(!empty($trip_id)){
               $trips->whereHas('tripdetails', function ($query) use ($trip_id) {
                $query->where('trip_id', 'like', "%$trip_id%");
            });
        }
        if(!empty($transaction_status)){
               $trips->where('transaction_status', 'like', "%$transaction_status%");
            
        }
        if(!empty($Transaction_id)){
               $trips->where('transaction_id', 'like', "%$Transaction_id%");
            
        }
        if(!empty($total_cost)){
               $trips->where('total_cost', 'like', "%$total_cost%");
            
        }
         $Booking= $trips->paginate(10);
        return view('Admin.user_view')->with([
            'User'=>$User,
            'Booking'=>$Booking,
            'trip_id'=>$trip_id,
            'transaction_status'=>$transaction_status,
            'Transaction_id'=>$Transaction_id,
            'total_cost'=>$total_cost
        ]);  
    }
}