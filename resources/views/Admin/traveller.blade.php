@extends('Admin.layout.master')
@section('content')
	  <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					  @if (Session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <span>{{session('message')}}</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    @endif
	<div class="pd-20">
		<form method="post" action="{{route('search')}}">
			@csrf
			<div class="input-group mb-3">
 		 <input type="search" class="form-control" value="{{ $search ?? ''}}" name="search" placeholder="Search here" aria-label="Recipient's username" aria-describedby="basic-addon2">
  		<div class="input-group-append">
   			 <button class="btn btn-danger" type="submit">Search</button>
  		</div>
		   <div class="input-group-append ml-1">
		  <a class="btn btn-secondary" href="{{url('/traveller_user')}}">Reset</a>
		  </div>
		</div>
		</form>
	</div>
					<div class="pd-20">
						<h4 class=" h4">Traveller Details</h4>
						<a href="{{url('create_traveller')}}" class="btn btn-sm btn-danger mb-2 " style="float: right;">Add Traveller</a>
					</div>
					<div class="pb-20">
						<table class="data-table table table-responsive-lg  stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">@sortablelink('First_Name')</th>
									<th>@sortablelink('email')</th>
									<th>@sortablelink('Short_Intro')</th>
									<th>@sortablelink('Contact_No')</th>
									<th>Status</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($travel as $item)
									<tr>
									<td class="table-plus">{{$item->First_Name}} {{$item->Last_Name}}</td>
									<td>{{$item->email}}</td>
									<td>{{$item->Short_Intro}}</td>
									<td>{{$item->Contact_No}}</td>
									<td>
										@if ($item->status==1)
								<a class="btn btn-danger btn-sm" href="{{route('status',['id'=>base64_encode($item->id),'status'=>0])}}"> Active</a>
										@endif
										@if ($item->status==0)
								<a class="btn btn-primary btn-sm" href="{{route('status',['id'=>base64_encode($item->id),'status'=>1])}}"> DeActive</a>
										@endif

									</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{route('travel_view',['id'=>base64_encode($item->id)])}}"><i class="dw dw-eye"></i> View</a>
												 <a class="dropdown-item" href="{{route('edit_traveller',['id'=>base64_encode($item->id)])}}"><i class="dw dw-edit2"></i> Edit</a> 
												<a class="dropdown-item" href="{{route('travel_delete',['id'=>base64_encode($item->id)])}}"><i class="dw dw-delete-3"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
								
							</tbody>
						</table>
							<div class="col-12 "><p class="text-center">
								 {!! $travel->appends(\Request::except('page'))->render() !!}
							</p></div>
					</div>
				</div>
			</div>
		</div>

		
@endsection