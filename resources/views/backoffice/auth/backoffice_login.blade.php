@extends('backoffice.auth.backoffice_auth')

@section('titleAuthPage')
Backoffice Login
@endsection

@section('backofficeAuthPage')

<div class="w-[450px] bg-trium-panel border border-trium-border rounded-xl shadow-trium-soft overflow-hidden">

    <!-- Header / Logo -->
    <div class="bg-trium-bg2 p-6 flex flex-col items-center justify-center border-b border-trium-border">
        <img src="{{ asset('backoffice/assets/images/logo-icon.png') }}" width="60" alt="">
        <h1 class="mt-4 text-lg text-trium-300 font-semibold">Backoffice Login</h1>
        <p class="text-sm text-trium-sub">Please log in to your account</p>
    </div>

    <!-- Form -->
    <div class="p-6">
        <form method="POST" action="{{ route('backoffice.login.store') }}" class="space-y-4">
            @csrf

            {{-- Login --}}
            <div>
                <label class="text-sm text-trium-sub">Email / Name / Phone</label>
                <input
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    class="w-full mt-1 bg-trium-bg2 border border-trium-border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-trium-400 outline-none
                           @error('login') border-red-500 @enderror"
                    placeholder="john@example.com"
                >
                @error('login')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="text-sm text-trium-sub">Password</label>
                <div class="relative">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="w-full mt-1 bg-trium-bg2 border border-trium-border rounded-lg px-4 py-2 pr-10
                               focus:ring-2 focus:ring-trium-400 outline-none
                               @error('password') border-red-500 @enderror"
                        placeholder="Enter password"
                    >

                    <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-trium-sub hover:text-trium-300">
                        👁
                    </button>
                </div>

                @error('password')
                    <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-trium-sub">
                    <input type="checkbox" name="remember"
                        class="rounded border-trium-border bg-trium-bg2 text-trium-400 focus:ring-trium-400">
                    Remember me
                </label>

                <a href="{{ route('backoffice.password.request') }}"
                   class="text-trium-300 hover:text-trium-400 transition">
                    Forgot password?
                </a>
            </div>

            {{-- Submit --}}
            <button
                id="loginBtn"
                type="submit"
                class="w-full bg-trium-400 hover:bg-trium-500 text-black font-semibold py-2 rounded-lg
                       transition">
                Sign in
            </button>

        </form>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === "password" ? "text" : "password";
    }
</script>

@endsection
