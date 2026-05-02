<!doctype html>
<html lang="en" class="dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--favicon-->
    <link rel="icon" href="{{ asset('brand/tt-lion.png') }}" type="image/png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/backoffice/app.css', 'resources/js/app.js'])

    <script src="{{ asset('backoffice/custom/js/alpine.min.js') }}"></script>

    <link href="{{ asset('backoffice/custom/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backoffice/custom/css/toastr.css') }}" rel="stylesheet">

    <title>@yield('title')</title>
</head>

<body class="bg-trium-bg font-sans antialiased text-trium-text">
    <div
        x-data="{ sidebarOpen: false }"
        @keydown.escape.window="sidebarOpen = false"
        class="flex min-h-screen">
        {{-- Mobile Overlay --}}
        <div
            x-show="sidebarOpen"
            x-cloak
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/50 backdrop-blur-[1px] lg:hidden"></div>

        {{-- Sidebar --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 border-r border-trium-border bg-trium-bg2 transition-transform duration-300 ease-in-out lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            @include('backoffice._body.sidebar')
        </aside>

        {{-- Main area --}}
        <div class="flex min-h-screen min-w-0 flex-1 flex-col lg:ml-64">
            @include('backoffice._body.header')

            <main class="flex-1 p-6">
                @yield('backofficepage')
            </main>

            @include('backoffice._body.footer')
        </div>
    </div>

    <script src="{{ asset('backoffice/custom/js/jquery371.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('shared.message')
</body>

</html>