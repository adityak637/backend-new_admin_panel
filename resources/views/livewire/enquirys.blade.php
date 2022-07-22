
@extends('Admin.layout.master')
@section('content')
	  <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
			<div class="input-group mb-3">
 		 <input type="text" class="form-control"  placeholder="Search here" wire:model='searchTerm'>
  		
	</div>
					<div class="pd-20">
						<h4 class=" h4">Enquiry Details</h4>
					</div>
					<div class="pb-20">
						<table class="data-table table table-responsive-lg  stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">id</th>
									<th>Title</th>
									<th>Query</th>
									{{-- <th>User Name</th>
									<th>Traveller Name</th> --}}
									<th>Trip Id</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($Enquiry as $item)
									<tr>
											
										
									<td class="table-plus">{{$item->id}}</td>
									<td>{{$item->title}}</td>
									<td>{{$item->query}}</td>
									{{-- <td>{{$item->user->firstname}}</td>
									<td>{{$item->trip->user->First_Name}}</td> --}}
									<td>{{$item->trip_id}}</td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
							<div class="col-12 "><p class="text-center">{{$Enquiry->links()}}</p></div>
					</div>
				</div>
			</div>
		</div>

		
@endsection