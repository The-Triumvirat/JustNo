<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--favicon-->
  <link rel="icon" href="{{ asset('backoffice/assets/images/favicon-32x32.png') }}" type="image/png" />
  <!--plugins-->
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

  <link href="{{ asset('backoffice/custom/css/toastr.css') }}" rel="stylesheet">
  <title>@yield('titleAuthPage')</title>
</head>

<body class="">
  <!--wrapper-->
  <div class="wrapper">
    <div class="section-authentication-cover">
      <div class="">
        <div class="row g-0">

          <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

            <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
              <div class="card-body">
                <img src="{{ asset('backoffice/assets/images/login-images/login-cover.svg') }}" class="img-fluid auth-img-cover-login" width="650" alt="" />
              </div>
            </div>

          </div>

          <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
            <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
              <div class="card-body p-sm-5">
                @yield('backofficeAuthPage')
              </div>
            </div>
          </div>

        </div>
        <!--end row-->
      </div>
    </div>
  </div>
  <!--end wrapper-->
  <!-- Bootstrap JS -->
  <script src="{{ asset('backoffice/assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('backoffice/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('backoffice/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <!--Password show & hide js -->
  <script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("bx-hide");
          $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("bx-hide");
          $('#show_hide_password i').addClass("bx-show");
        }
      });
    });
  </script>
  <!--app JS-->
  <script src="{{ asset('backoffice/assets/js/app.js') }}"></script>

  @include('shared.message')
</body>

</html>