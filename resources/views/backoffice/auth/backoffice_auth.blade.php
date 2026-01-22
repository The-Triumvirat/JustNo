<!doctype html>
<html lang="en" class="dark">
<head>
 <meta charset="utf-8">
    <title>@yield('titleAuthPage', 'Backoffice')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('backoffice/assets/images/favicon-32x32.png') }}" type="image/png" />
    <link href="{{ asset('backoffice/custom/css/toastr.css') }}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-trium-bg text-trium-text min-h-screen flex items-center justify-center">

    
    <div class="flex w-full justify-center max-w-md">
        @yield('backofficeAuthPage')
    </div>

    <script src="{{ asset('backoffice/custom/js/jquery371.min.js') }}"></script>

    @include('shared.message')

</body>
</html>
