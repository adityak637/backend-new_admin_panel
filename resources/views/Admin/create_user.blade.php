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
            <a href="{{url('/user')}}" class="btn btn-sm float-right btn-dark ">Back</a>
        </div>
        <div class="p-4">
                
            <form action="{{url('/store-user')}}" method="post">
                @csrf
                <input type="hidden" name="add_role"  required class="form-control" value="user">
                <div class="form-row">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" required class="form-control">
                </div>
                <div class="form-row">
                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" required class="form-control">
                </div>
                <div class="form-row mt-2">
                    <label for="email">Email</label>
                    <input type="email" name="email" pattern=".+@gmail.com" required class="form-control" value="">
                </div>
                <div class="form-row  mt-2">
                    <label for="mobile">Mobile</label>
                    <input type="number" name="mobile" pattern="[7-9]{3}-[0-9]{3}-[0-9]{4}" required class="form-control">
                </div>
                <div class="form-row mt-3">
                    <button type="submit"  class="btn btn-primary">Save</button>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection