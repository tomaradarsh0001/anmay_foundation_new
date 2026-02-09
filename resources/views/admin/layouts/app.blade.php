<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    
    <!-- favicon  -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title', 'Dashboard - Anmay Foundation')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/fontawesome-7.1.0/css/all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-5.3.8.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/css/aos.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/css/swiper-bundle-12.0.3.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body>
    <div class="page-wrapper">
        @include('admin.layouts.header-mobile')
        @include('admin.layouts.sidebar')
        
        <div class="page-container">
            @include('admin.layouts.header-desktop')
            
            <!-- Main Content -->
            <main class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </main>
            <!-- End Main Content -->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/js/vanilla-utils.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-5.3.8.bundle.min.js') }}"></script>
    <!-- Vendor JS -->
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/chart.umd.js-4.5.1.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/bootstrap5-init.js') }}"></script>
    <script src="{{ asset('admin/js/main-vanilla.js') }}"></script>
    <script src="{{ asset('admin/js/swiper-bundle-12.0.3.min.js') }}"></script>
    <script src="{{ asset('admin/js/aos.js') }}"></script>
    <script src="{{ asset('admin/js/modern-plugins.js') }}"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>