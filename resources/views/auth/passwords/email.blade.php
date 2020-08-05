@extends('layouts.app')

@section('content')

    <div id="page-container" class="main-content-boxed">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="bg-image" style="background-image: url({{ asset('assets/media/photos/photo34@2x.jpg') }});">
                    <div class="row mx-0 bg-black-op">
                        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                            <div class="p-30 invisible" data-toggle="appear">
                                <p class="font-size-h3 font-w600 text-white">
                                    CITITRUST GROUP STAFF DIRECTORY
                                </p>
                                <p class="font-italic text-white-op">
                                    Copyright &copy; <span class="js-year-copy"></span>
                                </p>
                            </div>
                        </div>
                        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                            <div class="content content-full">
                                <!-- Header -->
                                <div class="px-30 py-10">
                                    <a class="link-effect font-w700" href="index.html">
                                        <i class="si si-trophy"></i>
                                        <span class="font-size-xl text-primary-dark">{{ config('app.compFName') }}</span><span class="font-size-xl text-danger" style="color: #c10 !important;">{{ config('app.compLName') }}</span>
                                    </a>
                                    <h1 class="h3 font-w700 mt-30 mb-10">Don’t worry, we’ve got your back</h1>
                                    <h2 class="h5 font-w400 text-muted mb-0">Please enter your email</h2>
                                </div
>                                <!-- END Header -->

                                <!-- Sign In Form -->
                                <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-validation-reminder px-30" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                            <i class="fa fa-asterisk mr-10"></i> Send Password Reset Link
                                        </button>
                                        <div class="mt-30">
                                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('login') }}">
                                                <i class="fa fa-user text-muted mr-5"></i> Sign In
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>

@endsection
