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
                                    <select name="designation" id="profile-desig-edit" class="form-control" required>
                                        <option value="0" disabled hidden selected>Select One</option>
                                        @foreach ($desigs as $desig)
                                            <option value="{{ $desig->id }}">{{ $desig->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-contr
                                    ol form-control-lg" id="profile-settings-desig" value="{{ Auth::user()->designation ?? '0' }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-sub">Subsidiary</label>
                                    <select name="subsidiary" id="profile-sub-edit" class="form-control" required>
                                        <option value="0" disabled hidden selected>Select One</option>
                                        @foreach ($subs as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" class="form-control form-control-lg" id="profile-settings-sub" value="{{ Auth::user()->subsidiary ?? '0' }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-sub">Birthday info</label>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" value="{{ Auth::user()->day }}" id="sday">
                                    <label for="profile-settings-sub">Day</label>
                                    <select name="day" id="day" class="form-control">
                                        <option value="0" disabled hidden selected>Select day</option>
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="smon" value="{{ Auth::user()->month }}">
                                    <label for="profile-settings-sub">Month</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="0" disabled hidden selected>Select month</option>
                                        <option value="1">Jan</option>
                                        <option value="2">Feb</option>
                                        <option value="3">Mar</option>
                                        <option value="4">Apr</option>
                                        <option value="4">May</option>
                                        <option value="5">Jun</option>
                                        <option value="7">Jul</option>
                                        <option value="8">Aug</option>
                                        <option value="9">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
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