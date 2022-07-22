<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General_query;

class GeneralQuerysController extends Controller
{
    public function index(){
        $General_query=General_query::paginate(10);
        return view('Admin.general_query',[
            'General_query'=>$General_query
        ]);
    }

    public function generalquerysstatus($id,$status)
    {
     
       General_query::where('id',$id)->update(['status'=>1]);
       return redirect('generalquerys');
       
    }

    public function generalquerysserach (Request $request)
    {
        $title=$request->title ?? '';
        $name=$request->name ?? '';
        $email=$request->email ?? '';
        $querys=$request->querys ?? '';
        $status=$request->status ?? '';
         $facingissues=General_query::where('status', $status);
         if(!empty($title)){
               $facingissues->where('title', 'like', "%$title%");
        }
        if(!empty($name)){
               $facingissues->where('name', 'like', "%$name%");
        }
        if(!empty($email)){
               $facingissues->where('email', 'like', "%$email%");
        }
        if(!empty($querys)){
               $facingissues->where('querys', 'like', "%$querys%");
        }

        $General_query=$facingissues->paginate(6);
       return view('Admin.general_query',[
            'General_query'=>$General_query,
            'title'=>$title,
           'name'=>$name,
           'email'=>$email,
           'querys'=>$querys,
           'status'=>$status
        ]);
    }
}