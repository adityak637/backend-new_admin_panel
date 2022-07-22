<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquirysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $Enquiry=Enquiry::with('traveller')->orderby('status','asc')->paginate(5);
        return view('Admin.enquiry',[
            'Enquiry'=>$Enquiry
        ]);
    }
    public function enquirydetailsearch(Request $request)
    {
        $title=$request->title ?? '';
        $querys=$request->querys ?? '';
        $t_name=$request->t_name ?? '';
        $t_mobile=$request->t_mobile ?? '';
        $status=$request->status ?? '';
         $Enquirys=Enquiry::with('traveller');
         if(!empty($t_name)){
               $Enquirys->whereHas('traveller', function ($query) use ($t_name) {
                $query->where('First_Name', 'like', "%$t_name%")->orwhere('Last_Name', 'like', "%$t_name%");
            });
        }
         if(!empty($t_mobile)){
               $Enquirys->whereHas('traveller', function ($query) use ($t_mobile) {
                $query->where('Contact_No', 'like', "%$t_mobile%");
            });
        }
        if(!empty($title)){
               $Enquirys->where('title', 'like', "%$title%");
        }
        if(!empty($querys)){
               $Enquirys->where('query', 'like', "%$querys%");
        }
        if(!empty($status)){
               $Enquirys->where('status', $status);
        }
        $Enquiry=$Enquirys->paginate(6);
        return view('Admin.enquiry',[
            'Enquiry'=>$Enquiry,
            'title'=>$title,
            'querys'=>$querys,
            't_name'=>$t_name,
            't_mobile'=>$t_mobile,
            'status'=>$status,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enquirystatus($id,$status)
    {
        echo $id;
        echo $status;
       Enquiry::where('id',$id)->update(['status'=>1]);
       return redirect('enquirys');
       
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Enquiry=Enquiry::with('traveller')->find($id);
        return view('Admin.viewenquiry',[
            'Enquiry'=>$Enquiry
        ]);
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
    public function destroy($id)
    {
        //
    }
}