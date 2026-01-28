@extends('backoffice.auth.backoffice_auth')

@section('titleAuthPage')
Backoffice Reset Password
@endsection

@section('backofficeAuthPage')

<div class="w-[380px] bg-trium-panel border border-trium-border rounded-xl shadow-trium-soft overflow-hidden">

    <!-- Header -->
    <div class="bg-trium-bg2 p-6 text-center border-b border-trium-border">
        <img 
            src="{{ url('brand/tt-lion.png') }}"
            alt="TT Lion"
            draggable="false"
            class="mx-auto block max-w-[120px] w-auto select-none">
        <h1 class="text-lg text-trium-300 font-semibold">Reset your password</h1>
        <p class="text-sm text-trium-sub">Type your new password below</p>
    </div>

    <!-- Form -->
    <div class="p-6">
        <form method="POST" action="{{ route('backoffice.password.update') }}" class="space-y-4">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Email --}}
            <div>
                <label class="text-sm text-trium-sub">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    class="w-full mt-1 bg-trium-bg2 border border-trium-border rounded-lg px-4 py-2
                           focus:ring-2 focus:ring-trium-400 outline-none
                           @error('email') border-red-500 @enderror"
                    placeholder="john@example.com">
                @error('email')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="text-sm text-trium-sub">New password</label>
                <div class="relative">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="w-full mt-1 bg-trium-bg2 border border-trium-border rounded-lg px-4 py-2 pr-10
                               focus:ring-2 focus:ring-trium-400 outline-none
                               @error('password') border-red-500 @enderror"
                        placeholder="Enter new password">
                    <button type="button"
                        onclick="togglePassword('password')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-trium-sub hover:text-trium-300">
                        👁
                    </button>
                </div>
                @error('password')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm --}}
            <div>
                <label class="text-sm text-trium-sub">Confirm password</label>
                <div class="relative">
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="w-full mt-1 bg-trium-bg2 border border-trium-border rounded-lg px-4 py-2 pr-10
                               focus:ring-2 focus:ring-trium-400 outline-none
                               @error('password_confirmation') border-red-500 @enderror"
                        placeholder="Repeat password">
                    <button type="button"
                        onclick="togglePassword('password_confirmation')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-trium-sub hover:text-trium-300">
                        👁
                    </button>
                </div>
                @error('password_confirmation')
                <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-trium-400 hover:bg-trium-500 text-black font-semibold py-2 rounded-lg transition">
                Reset password
            </button>

        </form>
    </div>

</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === "password" ? "text" : "password";
    }
</script>

@endsection