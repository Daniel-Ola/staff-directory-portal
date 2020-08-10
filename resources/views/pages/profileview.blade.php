@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/photo13@2x.jpg') }});">
        <div class="bg-primary-dark-op py-30">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-15">
                    <a class="img-link" href="£">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset(Auth::user()->dp) }}" alt="">
                    </a>x
                </div>
                <!-- END Avatar -->

                <!-- Personal -->
                <h1 class="h3 text-white font-w700 mb-10">
                    {{ Auth::user()->firstname.' '.Auth::user()->lastname }}
                </h1>
                <h2 class="h5 text-white-op">
                    {{ Auth::user()->designation ?? 'Staff' }} <a class="text-primary-light" href="javascript:void(0)">{{ '@' }}{{ Auth::user()->subsidiary ?? 'Cititrust Group' }}</a>
                </h2>
                <!-- END Personal -->

                <!-- Actions -->
                <a class="btn btn-rounded btn-hero btn-sm btn-alt-secondary mb-5 px-20" href="{{ route('profile.edit') }}" title="Edit Profile">
                    <i class="fa fa-pencil"></i>
                </a>
                <!-- END Actions -->
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Main Content -->
    <div class="content">

        <!-- Colleagues -->
        <h2 class="content-heading">
            {{-- <a href="{{ route('staffs.view') }}" class="btn btn-sm btn-rounded btn-alt-secondary float-right">View More..</a> --}}
            <i class="si si-users mr-5"></i> Colleagues
        </h2>
        <div class="row items-push">
        @forelse ($colleagues as $colig)
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded text-center">
                    <div class="block-content block-content-full">
                        <img class="img-avatar" src="{{ asset($colig->dp) }}" alt="">
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <div class="font-w600 mb-5">{{ $colig->firstname.' '.$colig->lastname }}</div>
                        <div class="font-size-sm text-muted">{{ $colig->designation }}</div>
                    </div>
                    {{-- <div class="block-content block-content-full">
                        <a class="btn btn-rounded btn-alt-success" href="javascript:void(0)">
                            <i class="fa fa-plus mr-5"></i>Add
                        </a>
                        <a class="btn btn-rounded btn-alt-secondary" href="javascript:void(0)">
                            <i class="fa fa-user-circle mr-5"></i>Profile
                        </a>
                    </div> --}}
                </div>
            </div>
        @empty
            You have no colleagues
        @endforelse
        </div>
        <!-- END Colleagues -->

    </div>
    <!-- END Main Content -->
    <!-- END Page Content -->
</main>
@endsection