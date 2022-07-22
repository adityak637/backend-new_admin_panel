<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacingIssue;

class FacingIssuesController extends Controller
{
    public function index(){
       $facingissue= FacingIssue::orderby('status','asc')->paginate(10);
       return view('Admin.facingissue')->with([
           'facingissue'=>$facingissue
       ]);
    }
    public function status($id,$status){

        FacingIssue::where('id',$id)->update(['status'=>$status]);
      return redirect('/facingissues');
    }

    public function show($id)
    {
        $facingissues=FacingIssue::find($id);
        return view('Admin.view_facingissues',[
            'facingissues'=>$facingissues
        ]);
    }

    public function facingissuessearch (Request $request)
    {
        $title=$request->title ?? '';
        $name=$request->name ?? '';
        $email=$request->email ?? '';
        $mobile=$request->mobile ?? '';
        $status=$request->status ?? '';
         $facingissues=FacingIssue::where('status', $status);
         if(!empty($title)){
               $facingissues->where('title', 'like', "%$title%");
        }
        if(!empty($name)){
               $facingissues->where('name', 'like', "%$name%");
        }
        if(!empty($email)){
               $facingissues->where('email', 'like', "%$email%");
        }
        if(!empty($mobile)){
               $facingissues->where('phone_no', 'like', "%$mobile%");
        }

        $facingissue=$facingissues->paginate(6);
        return view('Admin.facingissue')->with([
           'facingissue'=>$facingissue,
           'title'=>$title,
           'name'=>$name,
           'email'=>$email,
           'mobile'=>$mobile,
           'status'=>$status
       ]);
    }
}