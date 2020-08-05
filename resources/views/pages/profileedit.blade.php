@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo13@2x.jpg') }});">
        <div class="bg-black-op-75 py-30">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-15">
                    <a class="img-link" href="{{ route('profile.view') }}">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset(Auth::user()->dp) }}" alt="">
                    </a>
                </div>
                <!-- END Avatar -->

                <!-- Personal -->
                <!-- Personal -->
                <h1 class="h3 text-white font-w700 mb-10">
                    {{ Auth::user()->firstname.' '.Auth::user()->lastname }}
                </h1>
                <h2 class="h5 text-white-op">
                    {{ Auth::user()->designation ?? 'Staff' }} <a class="text-primary-light" href="javascript:void(0)">{{ '@' }}{{ Auth::user()->subsidiary ?? 'Cititrust Group' }}</a>
                </h2>
                <!-- END Personal -->

                <!-- Actions -->
                <a href="{{ route('profile.view') }}" class="btn btn-rounded btn-hero btn-sm btn-alt-secondary mb-5">
                    <i class="fa fa-arrow-left mr-5"></i> Back to Profile
                </a>
                <!-- END Actions -->
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Main Content -->
    <div class="content">
        <!-- User Profile -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-user-circle mr-5 text-muted"></i> User Profile
                </h3>
            </div>
            <div class="block-content">
                <form action="{{ route('profile.doedit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Your account’s vital info. Your username will be publicly visible.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-username">Email</label>
                                    <input type="email" class="form-control form-control-lg" id="profile-settings-username" name="email" placeholder="Enter your username.." value="{{ Auth::user()->email }}" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-fname">Firstname</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-fname" name="firstname" placeholder="Enter your name.." value="{{ Auth::user()->firstname }}" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-lname">Lastname</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-lname" name="lastname" placeholder="Enter your name.." value="{{ Auth::user()->lastname }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-phone">Phone</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-phone" name="phone" value="{{ Auth::user()->phone }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-desig">Designation</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-desig" name="designation" value="{{ Auth::user()->designation }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-sub">Subsidiary</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-sub" name="subsidiary" value="{{ Auth::user()->subsidiary }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10 col-xl-6">
                                    <div class="push">
                                        <img class="img-avatar" src="{{ asset(Auth::user()->dp) }}" alt="">
                                    </div>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input" id="profile-settings-avatar" name="dp" data-toggle="custom-file-input">
                                        <label class="custom-file-label" for="profile-settings-avatar">Choose new display picture</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->
    </div>
    <!-- END Main Content -->
    <!-- END Page Content -->
</main>
@endsection