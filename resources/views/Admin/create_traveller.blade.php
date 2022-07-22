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
            
        <form action="{{route('create_traveller')}}" method="post">
           @csrf
            <div class="form-row">
                <label for="name">First Name</label>
                <input type="name" name="First_Name" required id="name" class="form-control"  value="">
            @error('First_Name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-row">
                <label for="lname">Last Name</label>
                <input type="name" name="Last_Name" required id="lname" class="form-control"  value="">
            @error('Last_Name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-row">
                <label for="lname">Email</label>
                <input type="email" name="email" required id="email" class="form-control"  value="">
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-row  mt-2">
                <label for="mobile">Mobile</label>
                <input type="number" name="Contact_No" pattern="[7-9]{3}-[0-9]{3}-[0-9]{4}" required id="mobile" class="form-control" value="" >
            @error('Contact_No')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-row mt-3">
                <button type="submit"  class="btn btn-dark" >Save</button>
            </div>
        </form> 
    </div>
    </div>
</div>
@endsection