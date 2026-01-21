@section('titleAuthPage')
Backoffice Forget Password
@endsection

@extends('backoffice.auth.backoffice_auth')
@section('backofficeAuthPage')

<div class="w-[450px] bg-trium-panel border border-trium-border rounded-xl shadow-trium-soft overflow-hidden">

    <!-- Header / Logo -->
    <div class="bg-trium-bg2 p-6 flex flex-col items-center justify-center border-b border-trium-border">
        <img src="{{ asset('backoffice/assets/images/logo-icon.png') }}" width="60" alt="">
        <h1 class="mt-4 text-lg text-trium-300 font-semibold">Backoffice Forget Password</h1>
        <p class="text-sm text-trium-sub">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
    </div>

    <!-- Form -->
    <div class="p-6">
        <form method="POST" action="{{ route('backoffice.password.email.store') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <label class="text-sm text-trium-sub">Email address</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full mt-1 bg-trium-bg2 border border-trium-border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-trium-400 outline-none
                           @error('login') border-red-500 @enderror"
                    placeholder="john@example.com">
                @error('email')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 text-start">
                Back to Login 
                <a href="{{ route('backoffice.login') }}"
                   class="text-trium-300 hover:text-trium-400 transition">
                    Backoffice Login</a>
            </div>

            {{-- Submit --}}
            <button
                id="forgetPwBtn"
                type="submit"
                class="w-full bg-trium-400 hover:bg-trium-500 text-black font-semibold py-2 rounded-lg
                       transition">
                Email Password Reset Link
            </button>

        </form>
    </div>

</div>

@endsection