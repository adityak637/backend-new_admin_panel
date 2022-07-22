
@extends('Admin.layout.master')
@section('content')
	  <div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class=" h4">General Querys Details</h4>
					</div>
					<div class="pd-20">
						<form action="{{route('generalquerysserach')}}" method="post">
							@csrf
							 <div class="row mx-auto">
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name"  value="{{$name ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email"  value="{{$email ?? ''}}">
            </div><!-- //form-group -->  
        </div>
        <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="title"  value="{{$title ?? ''}}">
            </div><!-- //form-group -->  
        </div>
		 <div class="col-lg-3 col-11">
           <div class="form-group">
                <input type="text" name="querys" class="form-control" placeholder="Query"  value="{{$querys ?? ''}}">
            </div><!-- //form-group -->  
        </div>
       <div class="col-lg-3 col-11">
           <div class="form-group">
               

                 <select name="status" class="form-control" id="service_id">
                            <option value="" >Select Status </option>
                            <option value="0" @if(!empty($status) &&($status==0)) selected  @endif>Pending</option>
                            <option value="1" @if(!empty($status) &&($status==1)) selected  @endif>Done</option>
                            

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
               <a class="btn btn-sm btn-dark" href="{{url('/generalquerys')}}" type="submit">Reset</a>
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
									<th>Name</th>
									<th>Email</th>
									<th>Title</th>
									<th>Query</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($General_query as $item)
									<tr>
									<td class="table-plus">{{$item->id}}</td>
									<td>{{$item->name}}</td>
									<td>{{$item->email}}</td>
									<td>{{$item->title}}</td>
									<td>{{$item->querys}}</td>
									<td>
										@if($item->status==0)
										<a class="btn btn-sm btn-warning" href="{{route('generalquerysstatus',['id'=>$item->id,'status'=>1])}}">pending</a>
										@endif
										@if($item->status==1)
										<a class="btn btn-sm btn-info" href="#">Done</a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
							<div class="col-12 "><p class="text-center">{{$General_query->links()}}</p></div>
					</div>
				</div>
			</div>
@endsection