<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Epac Inventory Management System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/dist/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/summernote/summernote-bs4.css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!--gijgo -->
    <link rel="stylesheet" href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ URL::asset('backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    @stack('styles')
    @stack('scripts')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('backend.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    @include('backend.partials.footer')


</div>
<!-- ./wrapper -->

@include('backend.partials.script')

@include('sweetalert::alert')

@stack('scripts')
</body>
</html>
