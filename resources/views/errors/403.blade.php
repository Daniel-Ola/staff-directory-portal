<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Forbidden</title>
        <meta name="robots" content="noindex, nofollow">

        <!-- Icons -->
    <link rel="icon" href="{{ asset('assets/media/citi_assets/favicon-192x192.png') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('assets/media/citi_assets/apple-touch-icon-180x180.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/media/citi_assets/favicon.png') }}" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/themes/pulse.min.css') }}">
    </head>
    <body>

        <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="hero bg-white">
                    <div class="hero-inner">
                        <div class="content content-full">
                            <div class="py-30 text-center">
                                <div class="display-3 text-primary">
                                    {{-- text-corporate --}}
                                    <i class="fa fa-ban"></i> 403
                                </div>
                                <h1 class="h2 font-w700 mt-30 mb-10">Oops.. You just found an error page..</h1>
                                <h2 class="h3 font-w400 text-muted mb-50">We are sorry but you do not have permission to access this page..</h2>
                                <a class="btn btn-hero btn-rounded btn-alt-secondary" href="{{ route('general.dashboard') }}">
                                    <i class="fa fa-arrow-left mr-10"></i> Back to main menu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
        <script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>
        
        <script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>
    </body>
</html>