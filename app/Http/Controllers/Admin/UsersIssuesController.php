<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users_Issue;

class UsersIssuesController extends Controller
{
      public function index(){
        $General_query=Users_Issue::paginate(10);
        return view('Admin.user_issue',[
            'General_query'=>$General_query
        ]);
    }

    public function usersissuesstatus($id,$status)
    {
     
       Users_Issue::where('id',$id)->update(['status'=>1]);
       return redirect('usersissues');
       
    }
    public function usersissuessearch (Request $request)
    {
        $username=$request->username ?? '';
        $useremail=$request->useremail ?? '';
        $transactionId=$request->transactionId ?? '';
        $tripId=$request->tripId ?? '';
        $details=$request->details ?? '';
        $status=$request->status ?? '';
         $facingissues=Users_Issue::where('status', $status);
         if(!empty($username)){
               $facingissues->where('username', 'like', "%$username%");
        }
        if(!empty($useremail)){
               $facingissues->where('useremail', 'like', "%$useremail%");
        }
        if(!empty($transactionId)){
               $facingissues->where('transactionId', 'like', "%$transactionId%");
        }
        if(!empty($tripId)){
               $facingissues->where('tripId', 'like', "%$tripId%");
        }
        if(!empty($details)){
               $facingissues->where('details', 'like', "%$details%");
        }

        $General_query=$facingissues->paginate(6);
       return view('Admin.user_issue',[
            'General_query'=>$General_query,
            'username'=>$username,
            'useremail'=>$useremail,
            'transactionId'=>$transactionId,
            'tripId'=>$tripId,
            'details'=>$details,
            'status'=>$status,
        ]);
    }
}