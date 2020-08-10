<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ asset('_assets/bootstrap/css/bootstrap.min.css') }}"> --}}
    {{-- <!-- <link rel="stylesheet" href="{{ asset('_assets/fonts/ionicons.min.css') }}"> --> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/codebase.min.css') }}">
    {{-- <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --> --}}
    
    @if (Request::segment('1') == 'staffs' && Request::segment('2') == 'view')
        {{-- <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/citi_profile.css') }}">
    @endif
</head>
<body>
    <div id="app">

        <main class="">
            <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">
                <!-- Side Overlay-->
                @include('partials.sideoverlay')
                <!-- END Side Overlay -->
            
                <!-- Sidebar -->
                <!--
                    Helper classes
            
                    Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                    Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                        If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes
            
                    Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
                    Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                        - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
                -->
                @include('partials.sidebar')
                <!-- END Sidebar -->
            
                <!-- Header -->
                @include('partials.header')
                <!-- END Header -->
            
                <!-- Main Container -->
                        @yield('content')
                <!-- END Main Container -->
            
                <!-- Footer -->
                @include('partials.footer')
                <!-- END Footer -->
            </div>
        </main>
    </div>
</body>

    {{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script> --}}

    <script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>

        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>

        <!-- Page JS Plugins -->
        {{-- <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('assets/js/pages/op_auth_signin.min.js') }}"></script> --}}
        

        <!-- Page JS Helpers (Table Tools helper) -->
        <script>jQuery(function(){ Codebase.helpers('table-tools'); });</script>

        @if (Request::segment('1') == 'staffs' && Request::segment('2') == 'view')
            <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
            <script src="{{ asset('assets/js/pages/citi_profile.js') }}"></script>
        @endif

</html>
