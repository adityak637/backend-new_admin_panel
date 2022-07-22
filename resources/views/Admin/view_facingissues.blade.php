
@extends('Admin.layout.master')
@section('content')
	  <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class=" h4">{{ucwords('facingissues') }}Details</h4>
                        <a href="{{url('facingissues')}}" class="btn btn-sm btn-dark mb-2 " style="float: right;">back</a>
					</div>
					<div class="pb-20">
						<table class="data-table table table-responsive-lg  stripe hover nowrap">
							<tbody>
									<tr>
									<th>Name</th>
									<td>{{ucwords($facingissues->name)}}</td>
                                    </tr>
									<tr>
									<th>Email</th>
									<td>{{ucwords($facingissues->email)}}</td>
                                    </tr>
									<tr>
									<th>Phone No.</th>
									<td>{{$facingissues->phone_no}}</td>
                                    </tr>
									<tr>
									<th>Title</th>
									<td>{{$facingissues->title}}</td>
                                    </tr>
									<tr>
									<th>Details</th>
									<td>{{$facingissues->details}}</td>
                                    </tr>
                                    @if(!empty($facingissues->screenshots))
									<tr>
									<th>Screenshots</th>
									<td><img class="w-50" src="{{asset('facingissue').'/'.$facingissues->screenshots}}" ></td>
                                    </tr>
                                    @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
@endsection