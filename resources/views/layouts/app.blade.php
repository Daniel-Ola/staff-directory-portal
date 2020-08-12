<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/media/citi_assets/favicon-192x192.png') }}" sizes="192x192" />
<link rel="apple-touch-icon" href="{{ asset('assets/media/citi_assets/apple-touch-icon-180x180.png') }}" />
<meta name="msapplication-TileImage" content="{{ asset('assets/media/citi_assets/favicon.png') }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/fonts/ionicons.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/codebase.min.css') }}">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    <div id="app">

        <main class="">
            @yield('content')
        </main>
    </div>
</body>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>

        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('assets/js/pages/op_auth_signin.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <!-- Page JS Helpers (Table Tools helper) -->
        <script>jQuery(function(){ Codebase.helpers('table-tools'); });</script>
</html>
