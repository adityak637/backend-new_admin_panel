
@extends('Admin.layout.master')
@section('content')
	  <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class=" h4">Enquiry Details</h4>
                        <a href="{{url('enquirys')}}" class="btn btn-sm btn-dark mb-2 " style="float: right;">back</a>
					</div>
					<div class="pb-20">
						<table class="data-table table table-responsive-lg  stripe hover nowrap">
							<tbody>
									<tr>
									<th>Title</th>
									<td>{{$Enquiry->title}}</td>
                                    </tr>
									<tr>
									<th>Comment</th>
									<td>{{$Enquiry->query}}</td>
                                    </tr>
									<tr>
									<th>Traveller Name</th>
									<td>{{ucwords($Enquiry->traveller->First_Name)}}  {{ucwords($Enquiry->traveller->Last_Name)}}</td>
                                    </tr>
									<tr>
									<th>Traveller Mobile</th>
									<td>{{$Enquiry->traveller->Contact_No}}</td>
                                    </tr>
									<tr>
									<th>Screenshots</th>
									<td><img class="w-50" src="{{asset('enquiry').'/'.$Enquiry->image}}" ></td>
                                    </tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
@endsection