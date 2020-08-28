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

    <link rel="icon" href="{{ asset('assets/media/citi_assets/favicon-192x192.png') }}" sizes="192x192" />
<link rel="apple-touch-icon" href="{{ asset('assets/media/citi_assets/apple-touch-icon-180x180.png') }}" />
<meta name="msapplication-TileImage" content="{{ asset('assets/media/citi_assets/favicon.png') }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/codebase.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themes/pulse.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}"> --}}
    
    @if (Request::segment('1') == 'staffs' && Request::segment('2') == 'view')
        <link rel="stylesheet" href="{{ asset('assets/css/citi_profile.css') }}">
    @endif

    <style>
        /* #sidebar {
            background-image: url('https://via.placeholder.com/200x1000/bb0903/FFF?text=CITITRUST') center center no-repeat;
            background-size: cover;
            color: white !important;
            -webkit-box-shadow: 1px 0 10px 1px #d23 !important;
            box-shadow: 1px 0 10px 1px #d23 !important;
            border-top-right-radius: 100px;
            border-bottom-right-radius: 100px;
            border-right: white !important;
        }

        #sidebar:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: linear-gradient(to bottom right,#bb0903,#c10);
            opacity: .7; 
        }

        .nav-main a {
            color: #fff;
        }

        .nav-main a:hover {
            color: #d23;
        }

        .nav-main i {
            color: #fff !important;
        } */
    </style>


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


<script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>
<script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/citi_profile.js') }}"></script>
{{-- <script src="{{ asset('js/mdb.min.js') }}"></script> --}}

        <script>jQuery(function(){ Codebase.helpers('table-tools'); });</script>

        @if (Request::segment('1') == 'staffs' && Request::segment('2') == 'view')
            <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
        @endif


        @if (Request::segment('1') == 'home')
            <script>
                let sday = $('#sday').val();
                document.getElementById('day').selectedIndex = sday;
                let smon = $('#smon').val();
                document.getElementById('month').selectedIndex = smon;
            </script>
        @endif
</html>
