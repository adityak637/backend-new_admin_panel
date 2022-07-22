@extends('Admin.layout.master')
@section('content')
	<div class="xs-pd-20-10 pd-ltr-20">

			<div class="title pb-20">
				<h2 class="h3 mb-0" style=" font-family: initial;">Enquirys</h2>
			</div>

			<div class="row pb-10 text-center text-capitalize">
				<div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <a  href="{{url('/enquirys')}}">
					<div class="card-box  height-100-p widget-style3 p-4">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"></div>
								<div class="font-14 text-secondary weight-500">Traveller Enquiry</div>
							</div>
						</div>
					</div>
                    </a>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <a href="{{url('/facingissues')}}">
					<div class="card-box height-100-p widget-style3 p-4">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"></div>
								<div class="font-14 text-secondary weight-500">Traveller Issue</div>
							</div>
						</div>
					</div>
                    </a>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <a href="{{url('/usersissues')}}">
					<div class="card-box height-100-p widget-style3 p-4">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"></div>
								<div class="font-14 text-secondary weight-500">Users Issue</div>
							</div>
						</div>
					</div>
                    </a> 
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <a href="{{url('/generalquerys')}}">
					<div class="card-box height-100-p widget-style3 p-4">
						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"></div>
								<div class="font-14 text-secondary weight-500">General Query</div>
							</div>
						</div>
					</div>
                    </a> 
				</div>
				
			</div>

		</div>

		
@endsection