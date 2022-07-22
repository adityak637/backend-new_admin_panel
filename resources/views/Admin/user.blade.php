@extends('Admin.layout.master')
@section('content')
	  <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
		<form method="post" action="{{url('/userssearch')}}">
			@csrf
			<div class="input-group mb-3">
 		 <input type="search" class="form-control" value="{{ $search ?? ''}}" name="search" placeholder="Search here" aria-label="Recipient's username" aria-describedby="basic-addon2">
  		<div class="input-group-append">
   			 <button class="btn btn-danger" type="submit">Search</button>
				 
  		</div>
		  <div class="input-group-append ml-1">
		  <a class="btn btn-secondary" href="{{url('/user')}}">Reset</a>
		  </div>
		</div>
		</form>
	</div>
					<div class="pd-20">
						<h4 class=" h4">User Details</h4>
						<a href="{{url('create_user')}}" class="btn btn-sm btn-danger mb-2 " style="float: right;">Add User</a>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Status</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($users as $user)
									<tr>
									<td class="table-plus">{{$user->firstname.' '.$user->lastname ?: ''}}</td>
									<td>{{$user->email}}</td>
									<td>{{$user->mobile}}</td>
									<td>
											@if ($user->status==1)
								<a class="btn btn-danger btn-sm" href="{{route('userstatuss',['id'=>base64_encode($user->id),'status'=>0])}}"> Active</a>
										@endif
										@if ($user->status==0)
								<a class="btn btn-primary btn-sm" href="{{route('userstatuss',['id'=>base64_encode($user->id),'status'=>1])}}"> DeActive</a>
										@endif
									</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{url('/user_view').'/'.$user->id}}"><i class="dw dw-eye"></i> View</a>
												 <a class="dropdown-item" href="{{url('/edit_user').'/'.$user->id}}"><i class="dw dw-edit2"></i> Edit</a> 
												<a class="dropdown-item" href="{{url('/user_delete').'/'.$user->id}}"><i class="dw dw-delete-3"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								@empty
								<tr>
									<td class="text-muted text-center" colspan="8">
										No users found to display here.
									</td>
								</tr>
								@endforelse
							</tbody>
						</table>
						<div class="col-12 "><p class="text-center">{{ $users->links() }}</p>								
						</div>
					</div>
				</div>
			</div>
		</div>
@if(Session('usermessage'))
		<script>
		Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'User deleted Successful',
  showConfirmButton: false,
  timer: 1500
})
</script>
		@endif
		
@endsection