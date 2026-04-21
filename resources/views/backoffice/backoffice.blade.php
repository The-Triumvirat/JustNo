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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.min.js"></script>
    <!-- legacy bootstrap -->

    {{-- Legacy CSS behalten wir NUR für Plugins (DataTables, TagsInput) --}}
    <link href="{{ asset('backoffice/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('backoffice/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backoffice/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backoffice/custom/css/toastr.css') }}" rel="stylesheet">

    {{-- Das alte Bootstrap-CSS werfen wir raus, sobald das Layout steht --}}
    {{-- <link href="{{ asset('backoffice/assets/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <title>@yield('title')</title>
</head>

<body class="bg-trium-bg text-trium-text font-sans antialiased">

    {{-- Wrapper mit Tailwind Flexbox --}}
    <div class="flex min-h-screen">

        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-trium-bg2 border-r border-trium-border transition-transform lg:translate-x-0 lg:static lg:inset-0">
            @include('backoffice._body.sidebar')
        </aside>

        <div class="flex-1 flex flex-col min-w-0">

            <header class="h-16 bg-trium-panel border-b border-trium-border sticky top-0 z-40 shadow-trium-soft">
                @include('backoffice._body.header')
            </header>

            <main class="p-6">
                @yield('backofficepage')
            </main>

            @include('backoffice._body.footer')
        </div>

    </div>

    {{-- Scripts --}}
    <script src="{{ asset('backoffice/assets/js/jquery.min.js') }}"></script>
    {{-- Behalte Plugins nur solange du sie brauchst --}}
    <script src="{{ asset('backoffice/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @include('shared.message')
</body>

</html>