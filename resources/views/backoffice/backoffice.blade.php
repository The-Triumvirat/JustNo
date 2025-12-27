<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="{{ asset('backoffice/assets/images/favicon-32x32.png') }}" type="image/png" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--tagsinput-->
  <link href="{{ asset('backoffice/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
  <!--tagsinput-->

  <!--plugins-->
  <link href="{{ asset('backoffice/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
  <link href="{{ asset('backoffice/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
  <link href="{{ asset('backoffice/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
  <link href="{{ asset('backoffice/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
  <!-- loader
  <link href="{{ asset('backoffice/assets/css/pace.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('backoffice/assets/js/pace.min.js') }}"></script>-->
  <!-- Bootstrap CSS -->
  <link href="{{ asset('backoffice/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backoffice/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link href="{{ asset('backoffice/assets/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('backoffice/assets/css/icons.css') }}" rel="stylesheet">
  <!-- Theme Style CSS -->
  <link rel="stylesheet" href="{{ asset('backoffice/assets/css/dark-theme.css') }}" />
  <link rel="stylesheet" href="{{ asset('backoffice/assets/css/semi-dark.css') }}" />
  <link rel="stylesheet" href="{{ asset('backoffice/assets/css/header-colors.css') }}" />
  <!-- Datatable -->
  <link href="{{ asset('backoffice/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
  <!-- End Datatable -->

  <link href="{{ asset('backoffice/custom/css/toastr.css') }}" rel="stylesheet">
  <title>@yield('title')</title>
</head>

<body>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper -->
    @include('backoffice._body.sidebar')
    <!--end sidebar wrapper -->
    <!--start header -->
    @include('backoffice._body.header')
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
      @yield('backofficepage')
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @include('backoffice._body.footer')
  </div>
  <!--end wrapper-->


  <!--end switcher-->
  <!-- Bootstrap JS -->
  <script src="{{ asset('backoffice/assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('backoffice/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/chartjs/js/chart.js') }}"></script>
  <script src="{{ asset('backoffice/assets/js/index.js') }}"></script>
  <!--tagsinput-->
  <script src="{{ asset('backoffice/assets/plugins/input-tags/js/tagsinput.js') }}"></script>
  <!--tagsinput-->

  <!--app JS-->
  <script src="{{ asset('backoffice/assets/js/app.js') }}"></script>
  <script src="{{ asset('backoffice/assets/js/validate.min.js') }}"></script>
  <!--sweetalert2 JS-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="{{ asset('backoffice/assets/js/code.js') }}"></script>

  <!--<script>
    new PerfectScrollbar(".app-container")
  </script>-->

  <!--Datatable-->
  <script src="{{ asset('backoffice/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <!--End Datatable-->

  @include('shared.message')

  
</body>

</html>