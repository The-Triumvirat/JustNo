@section('titleAuthPage')
Backoffice Reset Password
@endsection

@extends('backoffice.auth.backoffice_auth')
@section('backofficeAuthPage')
<div class="">
    <div class="mb-3 text-center">
        <img src="{{ asset('backoffice/assets/images/logo-icon.png') }}" width="60" alt="">
    </div>
    <div class="text-center mb-4">
        <h5 class="">Backoffice Reset Your Password </h5>
        <p class="mb-0">Type here your new password</p>
    </div>
    <div class="form-body">

        <form class="row g-3" method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="jhon@example.com">
                @error('email')
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

            <div class="col-12">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group" id="show_hide_password">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-end-0 @error('password_confirmation') is-invalid @enderror" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection