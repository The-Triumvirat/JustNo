@section('titleAuthPage')
Backoffice Forget Password
@endsection

@extends('backoffice.auth.backoffice_auth')
@section('backofficeAuthPage')
<div class="">
    <div class="mb-3 text-center">
        <img src="{{ asset('backoffice/assets/images/logo-icon.png') }}" width="60" alt="">
    </div>
    <div class="text-center mb-4">
        <h5 class="">Backoffice Forget Password </h5>
        <p class="mb-0">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
    </div>
    <div class="form-body">

        <form class="row g-3" method="POST" action="{{ route('backoffice.password.email.store') }}">
            @csrf


            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="jhon@example.com">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 text-start">Back to Login <a href="{{ route('backoffice.login') }}">Backoffice Login</a>
            </div>

            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Email Password Reset Link</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection