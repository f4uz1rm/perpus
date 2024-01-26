<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Fonts -->
    <title> @yield('title') | Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-ponpes.png') }}" />
    <!-- Plugin css for this page -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/moment.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">

    <!-- End plugin css for this page -->


    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            {{ $slot }}
        </div>
    </div>

    <!-- Plugin css for this page -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
</body>

</html>
