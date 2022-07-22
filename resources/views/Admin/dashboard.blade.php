@extends('Admin.layout.master')
@section('content')
	<div class="page-header">
		<h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Admin Dashboard
		</h3>
		{{--<nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>--}}
	</div>
	<div class="row">
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-danger card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
					<h4 class="font-weight-normal mb-3">Total No. Users<i
								class="mdi mdi-chart-line mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$users}}</h2>
{{--					<h6 class="card-text">Increased by 60%</h6>--}}
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-info card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">No. of Visiter <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">0</h2>
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-success card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">No. of Trip Created<i class="mdi mdi-diamond mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$Createtrip}}</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-warning card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
					<h4 class="font-weight-normal mb-3">No. of Trip Cancel (Traveller)<i
								class="mdi mdi-chart-line mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$trip_cancel_by_traveller}}</h2>
{{--					<h6 class="card-text">Increased by 60%</h6>--}}
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-secondary card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">No. of Trip Cancel (Users) <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">0</h2>
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-primary card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">Total Revenue<i class="mdi mdi-diamond mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$total_cost}}</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-dark card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
					<h4 class="font-weight-normal mb-3">Total Refunds<i
								class="mdi mdi-chart-line mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$refund_count}}</h2>
{{--					<h6 class="card-text">Increased by 60%</h6>--}}
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-danger card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">Total Refunds (Amount)<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$refund_cost}}</h2>
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-success card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
					<h4 class="font-weight-normal mb-3">Total No. of Queries (Resolve)<i class="mdi mdi-diamond mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$query_resolve}}</h2>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-info card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
					<h4 class="font-weight-normal mb-3">Total No. of Queries (Not Resolve)<i
								class="mdi mdi-chart-line mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{$query_not_resolve}}</h2>
{{--					<h6 class="card-text">Increased by 60%</h6>--}}
				</div>
			</div>
		</div>
	</div>
@endsection