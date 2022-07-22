@extends('Admin.layout.master')
@section('content')
<div class="row mt-5">
    <div class="col-6 mx-auto card">
        		  @if (Session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <span>{{session('message')}}</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    @endif
        <div class="mt-3">
            <a href="{{url('/traveller_user')}}" class="btn btn-sm float-right btn-dark ">Back</a>
            </div>
        <div class="p-4">
        <form action="{{route('edit_traveller_profile',['id'=>base64_encode($travel->id)])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-6">
                <label for="name">First Name</label>
                <input type="name" name="First_Name" required id="name" class="form-control"  value="{{$travel->First_Name}}">
            </div>
            <div class="col-6 ">
                <label for="Last_Name">Last Name</label>
                <input type="text" name="Last_Name"  required id="Last_Name" class="form-control" value="{{$travel->Last_Name}}">
            </div>
            </div>
            <div class="form-row  mt-2">
                <label for="mobile">Mobile</label>
                <input type="number" name="mobile" required id="mobile" pattern="[7-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" value="{{$travel->Contact_No}}" >
            </div>
            <div class="form-row  mt-2">
                <label for="dob">DOB</label>
                <input type="text" name="dob" required id="dob" class="form-control" value="{{$travel->DOB}}" >
            </div>
            <div class="form-row  mt-2">
                <label for="City">City</label>
                <input type="text" name="City" required id="City" class="form-control" value="{{$travel->City}}" >
            </div>
            <div class="form-row  mt-2">
                <label for="Country">Country</label>
                <input type="text" name="Country" required id="Country" class="form-control" value="{{$travel->Country}}" >
            </div>
            <div class="form-row  mt-2">
                <label for="Pincode">Pincode</label>
                <input type="number" name="Pincode" pattern="[3-9]{6}" required id="Pincode" class="form-control" value="{{$travel->Pin_Code}}" >
            </div>
            <div class="form-row  mt-2">
                <label for="short_intro">Short Intro</label>
                <textarea name="short_intro" class="form-control">
                    {{$travel->Short_Intro}}
                </textarea>
            </div>
            <div class="form-row  mt-2">
                <label for="profile">Profile</label>
                <input type="file" name="profile" id="profile" class="form-control">
               <img src="{{asset('traveller').'/'.$travel->Profile_URLs}}" style="height: 100px;">
               
                
            </div>
            <div class="form-row mt-3">
                <button type="submit"  class="btn btn-primary" >Save</button>
            </div>
        </form> 
    </div>
    </div>
</div>
@endsection