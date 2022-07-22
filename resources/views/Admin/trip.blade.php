@extends('Admin.layout.master')
@section('content')
<div class="row">
    <div class="col-12">
        <form  method="get" action="{{route('tripsearch')}}" >
           
            <div class="row mx-auto">
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="t_name" class="form-control" placeholder="Trip Name"  value="{{$t_name ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="trip_id" class="form-control" placeholder="Trip_Id"  value="{{$trip_id ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="date" name="start_date" class="form-control" placeholder="start Date"  value="{{$start_date ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="date" name="end_date" class="form-control" placeholder="End Date"  value="{{$end_date ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
               @php 
        $trip_datas=$trip_data ??'';
               @endphp

                 <select name="trip_data" class="form-control" id="service_id">
                            <option value="" >Please select</option>
                            <option value="upcoming_trip" @if($trip_datas=="upcoming_trip") selected  @endif>Upcoming Trip</option>
                            <option value="past_trip" @if($trip_datas=="past_trip") selected  @endif>Past Trip</option>
                            <option value="current_trip" @if($trip_datas=="current_trip") selected  @endif>Current Trip</option>
                            <option value="ongoing" @if($trip_datas=="ongoing") selected  @endif>{{ucwords('ongoing Trip')}}</option>
                            <option value="rejected" @if($trip_datas=="rejected") selected  @endif>{{ucwords('rejected Trip')}}</option>
                            <option value="cancel" @if($trip_datas=="cancel") selected  @endif>{{ucwords('cancel Trip')}}</option>
                            <option value="underreview" @if($trip_datas=="underreview") selected  @endif>{{ucwords('underreview Trip')}}</option>
                           

                        </select>
            </div><!-- //form-group -->  
        </div>
      
        <div class="col-lg-3 col-11">
            <div class="row">
                <div class="col-6">
           <div class="form-group">
               <button class="btn btn-sm btn-danger"  type="submit">Search</button>
            </div><!-- //form-group -->  </div>
           <div class="col-6">
           <div class="form-group">
               <a class="btn btn-sm btn-dark" href="{{url('/trip')}}" type="submit">Reset</a>
            </div><!-- //form-group -->  </div>
        </div>
        </div>
        </div>
        </form>
    </div>
</div>
<div class="row ">
    <div class="col-12">
        <div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Trip Details</h4>
					</div>
					<div class="pb-20">
						<table class=" table table-responsive-lg stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-sort">@sortablelink('trip_id')</th>
									<th>@sortablelink('trip_title')</th>
									<th>@sortablelink('created_at')</th>
									{{-- <th>@sortablelink('start_location')</th> --}}
									{{-- <th>@sortablelink('duration')</th> --}}
									{{-- <th>@sortablelink('cost')</th> --}}
									{{-- <th>@sortablelink('B_number')</th> --}}
									<th>@sortablelink('status')</th>
									{{-- <th>Trip Status</th> --}}
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
                                @foreach ($Createtrip as $item)
								<tr>
									<td class="table-plus">{{$item->trip_id}}</td>
									<td>{{$item->trip_title}}</td>
									<td>{{$item->created_at}}</td>
									{{-- <td>{{$item->start_location}}</td> --}}
									{{-- <td>{{$item->duration}}</td> --}}
									{{-- <td>{{$item->cost}}</td> --}}
									{{-- <td>{{$item->B_number}}</td> --}}
									<td>
                                        @if($item->status==1)
                                        <a>archived</a>
                                        @elseif($item->status==2)
                                        
								<select class="custom-select col-12" name="select_id" onchange="okk('{{$item->id}}')"  id="select_id{{$item->id}}">
									<option value="">Choose...</option>
									<option value="3">rejected</option>
									<option value="4">ongoing</option>
								</select>
                                        @elseif($item->status==3)
                                         <a>Rejected</a>
                                        @elseif($item->status==4)
                                         <a>Ongoing</a>
                                        @elseif($item->status==5)
                                         <a>cancelled</a>
                                        @endif
                                    </td>
									{{-- <td>{{$item->trip_status}}</td> --}}
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{route('trip_view',['id'=>$item->id])}}"><i class="dw dw-eye"></i> View</a>
					
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
                        {!! $Createtrip->appends(\Request::except('page'))->render() !!}
					</div>
                    
				</div>
    </div>
</div>
<script>


    function okk(id){
        d = $("#select_id"+id).val();
    $.ajax({
    type: "GET",
    url: "{{url('tripstatus')}}"+'/'+id+'/'+d,
    success: function (data) {
       if(data.status==200){
           	Swal.fire({
  icon: 'success',
  title: 'Status change successfully',
}).then((value) => {
                            location.reload();
                        });
       }else{
           	Swal.fire({
  icon: 'warning',
  title: ' Something  went wrong',
}).then((value) => {
                            location.reload();
                        });
       }
    }
})
    }
</script>
@endsection