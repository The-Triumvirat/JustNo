@section('titleAuthPage')
Backoffice Login
@endsection

@extends('backoffice.auth.backoffice_auth')
@section('backofficeAuthPage')

<div class="">
  <div class="mb-3 text-center">
    <img src="{{ asset('backoffice/assets/images/logo-icon.png') }}" width="60" alt="">
  </div>
  <div class="text-center mb-4">
    <h5 class="">Backoffice Login </h5>
    <p class="mb-0">Please log in to your account</p>
  </div>
  <div class="form-body">

    <form class="row g-3" method="POST" action="{{ route('login') }}">
      @csrf


      <div class="col-12">
        <label for="inputLogin" class="form-label">Email/Name/Phone</label>
        <input type="text" id="login" name="login" class="form-control @error('login') is-invalid @enderror" id="inputLogin" placeholder="jhon@example.com">
        @error('login')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="col-12">
        <label for="inputChoosePassword" class="form-label">Password</label>
        <div class="input-group" id="show_hide_password">
          <input type="password" name="password" id="password" class="form-control border-end-0 @error('password') is-invalid @enderror" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
          @error('password')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
          <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
        </div>
      </div>
      <div class="col-md-6 text-end"> <a href="{{ route('backoffice.password.request') }}">Forgot Password ?</a>
      </div>
      <div class="col-12">
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </div>
      <!--<div class="col-12">
        <div class="text-center ">
          <p class="mb-0">Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
          </p>
        </div>
      </div>-->
    </form>
  </div>
  <!--<div class="login-separater text-center mb-5"> <span>OR SIGN IN WITH</span>
    <hr>
  </div>
  <div class="list-inline contacts-social text-center">
    <a href="javascript:;" class="list-inline-item bg-facebook text-white border-0 rounded-3"><i class="bx bxl-facebook"></i></a>
    <a href="javascript:;" class="list-inline-item bg-twitter text-white border-0 rounded-3"><i class="bx bxl-twitter"></i></a>
    <a href="javascript:;" class="list-inline-item bg-google text-white border-0 rounded-3"><i class="bx bxl-google"></i></a>
    <a href="javascript:;" class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i class="bx bxl-linkedin"></i></a>
  </div>-->

</div>

@endsection