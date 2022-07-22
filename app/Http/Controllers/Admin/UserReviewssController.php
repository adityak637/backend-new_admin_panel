<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserReview;

class UserReviewssController extends Controller
{
     public function index(){
       $user_review= UserReview::with(['users','trip'])->orderby('status','asc')->paginate(10);
    
       return view('Admin.user_review')->with([
           'user_review'=>$user_review
       ]);
    }
    public function status($id,$status){

        UserReview::where('id',$id)->update(['status'=>$status]);
      return redirect('/user_review');
    }

    public function show($id)
    {
        $user_review=UserReview::with('user','trip')->find($id);
        return view('Admin.view_user_review',[
            'facingissuesuser_review'=>$user_review
        ]);
    }

     public function user_reviewsearch (Request $request)
    {
        $username=$request->username ?? '';
        $triptitle=$request->triptitle ?? '';
        $rating=$request->rating ?? '';
        $review=$request->review ?? '';
        $status=$request->status ?? '';
         $Enquirys=UserReview::with('users','trip');
         if(!empty($username)){
               $Enquirys->whereHas('users', function ($query) use ($username) {
                $query->where('firstname', 'like', "%$username%")->orwhere('lastname', 'like', "%$username%");
            });
        }
         if(!empty($triptitle)){
               $Enquirys->whereHas('trip', function ($query) use ($triptitle) {
                $query->where('trip_title', 'like', "%$triptitle%");
            });
        }
         if(!empty($review)){
               $Enquirys->where('review', 'like', "%$review%");
           
        }
         if(!empty($rating)){
               $Enquirys->where('rating', 'like', "%$rating%");
           
        }
         if(!empty($status)){
               $Enquirys->where('status', 'like', "%$status%");
           
        }
         
        $user_review=$Enquirys->paginate(6);
           return view('Admin.user_review')->with([
           'user_review'=>$user_review,
           'username'=>$username,
           'triptitle'=>$triptitle,
           'rating'=>$rating,
           'review'=>$review,
           'status'=>$status,
       ]);
    }
}