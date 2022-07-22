<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Traveler</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin/vendors/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin/vendors/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/vendors/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('admin/vendors/styles/style.css')}}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container-fluid">
			<div class="row align-items-center mx-auto">
				<div class="col-md-6 col-lg-5 align-items-center mx-auto">
					<div class="login-box bg-white box-shadow border-radius-10">
						@if($errors->has('email'))
		<span class="text-danger">The provided credentials do not match our records.</span>
		@endif
						<div class="login-title">
							<!--<h2 class="text-center text-primary">Login To Haldiram's</h2>-->
							<center><img src="{{asset('admin/vendors/images/img1.jpg')}}" class="pt-0"></center>
						</div>
						
						<form action="{{route('logindetailes')}}" method="post">
                           @csrf
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" name="email" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" name="password" placeholder="password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0 align-items-center">
									
										<button class="btn btn-primary align-items-center" type="submit" style="background: #ED1C24; border-color: #ED1C24;"> Login</button>
									</div>
								
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{asset('admin/vendors/scripts/core.js')}}"></script>
	<script src="{{asset('admin/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('admin/vendors/scripts/process.js')}}"></script>
	<script src="{{asset('admin/vendors/scripts/layout-settings.js')}}"></script>
</body>
</html>