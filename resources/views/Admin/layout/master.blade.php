<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Admin Panel</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin/vendors/images/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin/vendors/images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/vendors/images/favicon-16x16.png')}}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<div class="container-scroller">
    @include('Admin.layout.top_bar')
    <div class="container-fluid page-body-wrapper">
        @include('Admin.layout.left_sidebar')
        <div class="main-panel">
            <div class="content-wrapper">

                @section('content')
                @show
            </div>
        </div>
    </div>
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('assets/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/js/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('assets/js/dashboard.js')}}"></script>
<script src="{{asset('assets/js/todolist.js')}}"></script>
<!-- End custom js for this page -->
</body>
</html>