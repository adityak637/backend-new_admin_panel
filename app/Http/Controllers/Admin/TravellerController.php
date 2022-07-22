<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreateTravel;
use App\Models\Createtrip;
use App\Models\UserReview;
use App\Models\Document;
use Illuminate\Support\Facades\Hash;

class TravellerController extends Controller
{
    public function create(Request $req){
        $req->validate([
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'email'=>'required',
            'Contact_No'=>'required|unique:create_travel',
        ]);

        $createtravel=new CreateTravel;
        $createtravel->First_Name=$req->First_Name;
        $createtravel->Last_Name=$req->Last_Name;
        $createtravel->email=$req->email;
        $createtravel->Contact_No=$req->Contact_No;
        $createtravel->password=Hash::make($req->Contact_No);
        if($createtravel->save()){
            // $createtravel->assignRole('Traveller');
            $document=new Document;
            $document->traveller_id=$createtravel->id;
            $document->save();
            

            $req->session()->flash('message',"Traveller Added Successfully");
 return redirect()->back()->with("Traveller Added Successfully");
        }else{
            $req->session()->flash('message',"Please Try Again");
 return redirect()->back()->with("Please Try Again");
        }
    }

    public function fetchtraveller(){
       $travel= CreateTravel::sortable()->paginate(5);
        return view('Admin.traveller')->with(['travel'=>$travel]);
    }
    public function search(Request $req){

        $search=$req->search;
        $travel=CreateTravel::where('First_Name','like','%'.$search.'%')
        ->orWhere("Last_Name", "LIKE", "%$search%")
        ->orWhere("email", "LIKE", "%$search%")
        ->orWhere("Contact_No", "LIKE", "%$search%")
        ->orWhere("City", "LIKE", "%$search%")
        ->paginate(5);

        return view('Admin.traveller')->with(['travel'=>$travel,'search'=>$search]);
    }


    public function travel_delete($id,Request $req){
        $idd=base64_decode($id);
        if(!empty($idd)){
        $travel= CreateTravel::find($idd);
        $travel->delete();
        $req->session()->flash("message","Traveller deleted Successfully");
        return redirect()->back()->with("messaage","Traveller deleted Successfully");
        }
    }
    public function travel_view($id,Request $req){
        $idd=base64_decode($id);
        if(!empty($idd)){
        $travel= CreateTravel::with('tripdetails')->find($idd);
        $trip=Createtrip::with('ratings')->where('traveller_id',$travel->id)->paginate(6);
        // echo "<pre>";
        // print_r($trip);
        // die;
        // foreach($trip as $rating){
        //     $rating=UserReview::where('trip_id',$rating['id'])->get();
        // }
        return view('Admin.traveller_view')->with(['travel'=>$travel,'trip'=>$trip]);
        }
    }
    public function edit_traveller($id,Request $req){
    $idd=base64_decode($id);
        if(!empty($idd)){
        $travel= CreateTravel::find($idd);
        return view('Admin.edit_traveller')->with(['travel'=>$travel]);
        }
    }
    public function status($id,$status,Request $req){
    $idd=base64_decode($id);
        if(!empty($idd)){
            if($status==1){
                echo "ok";
                 $travel= CreateTravel::find($idd);
                 $travel->status=1;
                 $travel->save();
        return redirect('/traveller_user');
            }
            if($status==0){
                echo "noo";
                     $travel= CreateTravel::find($idd);
                       $travel->status=0;
                 $travel->save();
        return redirect('/traveller_user');
            }
       return redirect('/traveller_user');

        }
    }
    public function edit_traveller_profile($id,Request $req){
     $idd=base64_decode($id);
        if(!empty($idd)){
        $CreateTravel= CreateTravel::find($idd);
        $CreateTravel->First_Name=$req->First_Name;
            $CreateTravel->Last_Name=$req->Last_Name;
            $CreateTravel->Short_Intro=$req->short_intro;
            $CreateTravel->DOB=$req->dob;
            $CreateTravel->Contact_No=$req->mobile;
            $CreateTravel->Country=$req->Country;
            $CreateTravel->City=$req->City;
            $CreateTravel->Pin_Code=$req->Pincode;
            if(!empty($req->hasfile('profile'))){
            $file=$req->file('profile');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('traveller/',$filename);
            $CreateTravel->Profile_URLs=$filename;
            }
            if($CreateTravel->save()){
                $req->session()->flash("message","Traveller Profile Updated");
                  return redirect()->back()->with('Updated');
            }
        }
    }


    public function traveller_details_serach($id,Request $req){
        $idd=base64_decode($id);
        $trip_id=$req->trip_id ?? '';
        $trip_status=$req->trip_status ?? '';
        $travel= CreateTravel::with('tripdetails')->find($idd);
        $trips=Createtrip::with('ratings')->where('traveller_id',$travel->id);
       if(!empty($trip_id)){
               $trips->where('trip_id', 'like', "%$trip_id%");
        }
       if(!empty($trip_status)){
               $trips->where('status', 'like', "%$trip_status%");
        }

        $trip= $trips->paginate(10);
        return view('Admin.traveller_view')->with(['travel'=>$travel,'trip'=>$trip,'trip_id'=>$trip_id,'trip_status'=>$trip_status]);
      
    }
}