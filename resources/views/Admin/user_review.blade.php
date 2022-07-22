
@extends('Admin.layout.master')
@section('content')
	  <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class=" h4">{{ucwords('user_review')}} Details</h4>
					</div>
					<div class="pd-20">
						<form action="{{route('user_reviewsearch')}}" method="post">
							@csrf
							 <div class="row mx-auto">
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="username"  value="{{$username ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="triptitle" class="form-control" placeholder="triptitle"  value="{{$triptitle ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="review" class="form-control" placeholder="review"  value="{{$review ?? ''}}">
            </div><!-- //form-group -->  
        </div>
		 <div class="col-lg-3 col-11">
           <div class="form-group">
               @php 
        $rates=$rating ?? '';
		
               @endphp

                 <select name="rating" class="form-control" id="service_id">
                            <option value="" @if($rates=='') selected  @endif>Select Rating </option>
                            <option value="1" @if($rates==1) selected  @endif>1</option>
                            <option value="2" @if($rates==2) selected  @endif>2</option>
                            <option value="3" @if($rates==3) selected  @endif>3</option>
                            <option value="4" @if($rates==4) selected  @endif>4</option>
                            <option value="5" @if($rates==5) selected  @endif>5</option>
                            

                        </select>
            </div><!-- //form-group -->  
        </div>
       <div class="col-lg-3 col-11">
           <div class="form-group">
               @php 
        $trip_datas=$status ?? '';
		
               @endphp

                 <select name="status" class="form-control" id="service_id">
                            <option value="" >Select Status </option>
                            <option value="0" @if(!empty($status) && ($status==0)) selected  @endif>Pending</option>
                            <option value="1" @if(!empty($status) && ($status==1)) selected  @endif>Done</option>
                            

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
               <a class="btn btn-sm btn-dark" href="{{url('/user_review')}}" type="submit">Reset</a>
            </div><!-- //form-group -->  </div>
        </div>
							 </div>
						</form>
					</div>
					<div class="pb-20">
						<table class="data-table table table-responsive-lg  stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">id</th>
									<th>User Name</th>
									<th>Trip Title</th>
									<th>rating</th>
									<th>Review</th>
									<th>status</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($user_review as $item)
									<tr>
									<td class="table-plus">{{$item->id}}</td>
                                    @if(!empty($item->users->firstname))
									<td>{{$item->users->firstname}}</td>
                                    @endif
									<td><a href="{{url('/trip_view').'/'.$item->trip_id}}">{{$item->trip->trip_title}}</a></td>
									<td>{{$item->rating}}</td>
									<td>{{$item->review}}</td>
									<td>
										@if($item->status==0)
										<a class="btn btn-sm btn-warning" href="{{route('user_reviewstatus',['id'=>$item->id,'status'=>1])}}">pending</a>
										@endif
										@if($item->status==1)
										<a class="btn btn-sm btn-info" href="#">Done</a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
							<div class="col-12 "><p class="text-center">{{$user_review->links()}}</p></div>
					</div>
				</div>
			</div>
@endsection