<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} - @yield('title')</title> <!-- SB Admin 2 CSS -->
    <link href="{{ asset('adminsb2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminsb2/css/sb-admin-2.min.css') }}" rel="stylesheet"> <!-- Jetstream & Livewire -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) @livewireStyles
</head>

<body class="bg-gradient-primary">
    <div class="container"> @yield('content') </div> <!-- SB Admin 2 JS -->
    <script src="{{ asset('adminsb2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminsb2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminsb2/js/sb-admin-2.min.js') }}"></script> @livewireScripts
</body>

</html>
