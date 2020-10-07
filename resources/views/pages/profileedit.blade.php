@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/africantogether.jpg') }});">
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
                    <a class="text-primary-light" href="javascript:void(0)">{{ Auth::user()->email }}</a>
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
        @error('dp')
            <div class="alert alert-warning">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        @if (Session::has('profileErr') && strlen(Session::get('profileErr')) > 0)
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{!! Session::get('profileErr') !!}</strong>
            </div>
        @endif
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
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-fname" name="firstname" placeholder="Enter your name.." value="{{ Auth::user()->firstname }}" required @if (Auth::user()->firstname) {{ 'readonly' }} @endif>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-lname">Lastname</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-lname" name="lastname" placeholder="Enter your name.." value="{{ Auth::user()->lastname }}" required>
                                    <input type="hidden" name="profile" value="1" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="profile-settings-phone">Phone</label>
                                    <input type="text" class="form-control form-control-lg" id="profile-settings-phone" name="phone" value="{{ Auth::user()->phone }}" required>
                                </div>
                            </div>
                            {{-- @if (Auth::user()->profile == 0) --}}
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-desig">Department</label>
                                        <select name="department" id="profile-dept-edit" class="form-control" required>
                                            <option value="0" disabled hidden @if(Auth::user()->department == 0) {{ 'selected' }} @endif>Select One</option>
                                            @foreach ($depts as $dept)
                                                <option value="{{ $dept->id }}" @if($dept->id == Auth::user()->department) {{ 'selected' }} @endif>{{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="form-contr
                                        ol form-control-lg" id="profile-settings-desig" value="{{ Auth::user()->department ?? '0' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-desig">Designation</label>
                                        <select name="designation" id="profile-desig-edit" class="form-control" required>
                                            <option value="0" disabled hidden @if(Auth::user()->designation == 0) {{ 'selected' }} @endif>Select One</option>
                                            @forelse ($desigs as $desig => $des)
                                                <optgroup label="{{ $desig }} Department">
                                                    @forelse ($des as $de)
                                                        <option value="{{ $de['id'] }}" @if($de['id'] == Auth::user()->designation) {{ 'selected' }} @endif>{{ $de['name'] }}</option>
                                                    @empty
                                                        <option value="">Nill</option>
                                                    @endforelse
                                                </optgroup>
                                            @empty
                                                <option value='0' selected disabled>No designations found</option>
                                            @endforelse
                                        </select>
                                        <input type="hidden" class="form-contr
                                        ol form-control-lg" id="profile-settings-desig" value="{{ Auth::user()->designation ?? '0' }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="profile-settings-sub">Subsidiary</label>
                                        <select name="subsidiary" id="profile-sub-edit" class="form-control" required>
                                            <option value="0" disabled hidden @if(Auth::user()->designation == 0) {{ 'selected' }} @endif>Select One</option>
                                            @foreach ($subs as $sub)
                                                <option value="{{ $sub->id }}" @if($sub->id == Auth::user()->subsidiary) {{ 'selected' }} @endif>{{ $sub->name }}</option>
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
                                        {{-- <input type="hidden" value="{{ Auth::user()->day }}" id="sday" required> --}}
                                        <label for="profile-settings-sub">Day</label>
                                        @php
                                            $theday = 1;
                                        @endphp
                                        <select name="day" id="day" class="form-control" required>
                                            <option value="" disabled @if (Auth::user()->month == '0') {{ 'selected' }} @endif>Select day</option>
                                            <option value="1" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>01</option>
                                            <option value="2" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>02</option>
                                            <option value="3" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>03</option>
                                            <option value="4" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>04</option>
                                            <option value="5" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>05</option>
                                            <option value="6" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>06</option>
                                            <option value="7" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>07</option>
                                            <option value="8" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>08</option>
                                            <option value="9" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>09</option>
                                            <option value="10" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>10</option>
                                            <option value="11" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>11</option>
                                            <option value="12" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>12</option>
                                            <option value="13" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>13</option>
                                            <option value="14" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>14</option>
                                            <option value="15" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>15</option>
                                            <option value="16" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>16</option>
                                            <option value="17" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>17</option>
                                            <option value="18" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>18</option>
                                            <option value="19" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>19</option>
                                            <option value="20" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>20</option>
                                            <option value="21" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>21</option>
                                            <option value="22" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>22</option>
                                            <option value="23" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>23</option>
                                            <option value="24" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>24</option>
                                            <option value="25" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>25</option>
                                            <option value="26" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>26</option>
                                            <option value="27" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>27</option>
                                            <option value="28" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>28</option>
                                            <option value="29" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>29</option>
                                            <option value="30" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>30</option>
                                            <option value="31" @if (Auth::user()->day == $theday++) {{ 'selected' }} @endif>31</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        {{-- <input type="hidden" id="smon" value="{{ Auth::user()->month }}" required> --}}
                                        <label for="profile-settings-sub">Month</label>
                                        @php
                                            $themonth = 1;
                                        @endphp
                                        <select name="month" id="month" class="form-control" required>
                                            <option value="" disabled @if (Auth::user()->month == '0') {{ 'selected' }} @endif>Select month</option>
                                            <option value="1" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Jan</option>
                                            <option value="2" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Feb</option>
                                            <option value="3" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Mar</option>
                                            <option value="4" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Apr</option>
                                            <option value="4" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>May</option>
                                            <option value="5" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Jun</option>
                                            <option value="7" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Jul</option>
                                            <option value="8" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Aug</option>
                                            <option value="9" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Sep</option>
                                            <option value="10" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Oct</option>
                                            <option value="11" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Nov</option>
                                            <option value="12" @if (Auth::user()->month == $themonth++) {{ 'selected' }} @endif>Dec{{ $themonth++ }}</option>
                                        </select>
                                    </div>
                                </div>
                            {{-- @endif --}}
                            <div class="form-group row">
                                <div class="col-md-10 col-xl-6">
                                    <div class="push">
                                        <img class="img-avatar" id="dpPreview" src="{{ asset(Auth::user()->dp) }}" alt="">
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

@push('scripts')
    <script>
        function readURL(input) {
            const preview = $('#dpPreview');
            if (input.files && input.files[0]) {
                let fileType = input.files[0].type;
                console.log(fileType);
                let reader = new FileReader();
                
                // preview.append("<span id='prevMsg' class='text-info'></span>");
                // prevMsg = $(document).find('span#prevMsg');
                reader.onload = function(e) {
                    if(fileType == 'image/jpeg' || fileType == 'image/png') {
                        // prevMsg.text('Loading Preview');
                        preview.attr('src', e.target.result);
                        preview.removeClass('img-avatar');
                        preview.addClass('img-fluid');
                    } else {
                        alert('Invalid file type');
                        input = '';
                        // prevMsg.text('Invalid file type');
                        preview.attr('src', "{{ asset(Auth::user()->dp) }}");
                        preview.removeClass('img-fluid');
                        preview.addClass('img-avatar');
                    }
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            } else {
                preview.attr('src', "{{ asset(Auth::user()->dp) }}");
                preview.removeClass('img-fluid');
                preview.addClass('img-avatar');
            }
        }

        $("#profile-settings-avatar").change(function() {
            readURL(this);
        });
    </script> 
@endpush
