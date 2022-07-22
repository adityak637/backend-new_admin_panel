@extends('Admin.layout.master')
@section('content')
<div class="row mt-5">
    <div class="col-6 mx-auto card">
        <div class="mt-3">
            <a href="{{url('/user')}}" class="btn btn-sm float-right btn-dark ">Back</a>
            </div>
        <div class="p-4">
            
        <form action="{{route('user_edit')}}" method="post">
           @csrf
            <input type="hidden" name="id" value="{{$User->id}}">

            <div class="form-row">
                <label for="name">Name</label>
                
                <input type="name" name="firstname" required id="name" class="form-control"  value="{{$User->firstname}}">
            </div>
            <div class="form-row mt-2">
                <label for="email">Email</label>
                <input type="email" name="email" pattern=".+@gmail.com" required id="email" class="form-control" value="{{$User->email}}">
            </div>
            <div class="form-row  mt-2">
                <label for="mobile">Mobile</label>
                <input type="number" name="mobile" pattern="[7-9]{3}-[0-9]{3}-[0-9]{4}" required id="mobile" class="form-control" value="{{$User->mobile}}" >
            </div>
            <div class="form-row mt-3">
                <button type="submit"  class="btn btn-primary" >Save</button>
            </div>
        </form> 
    </div>
    </div>
</div>
@if(Session('usermessage'))
		<script>
		Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'User Updated Successful',
  showConfirmButton: false,
  timer: 1500
})
</script>
		@endif
@endsection