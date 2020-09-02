@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url({{ asset('assets/media/photos/africantogether.jpg') }});">
        <div class="bg-primary-dark-op py-30">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-15">
                    <a class="img-link" href="£">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset($profile->dp) }}" alt="">
                    </a>x
                </div>
                <!-- END Avatar -->

                <!-- Personal -->
                <h1 class="h3 text-white font-w700 mb-10">
                    {{ $profile->firstname.' '.$profile->lastname }}
                </h1>
                <h2 class="h5 text-white-op">
                    <a class="text-primary-light" href="javascript:void(0)">{{ Auth::user()->email }}</a>
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
                        <div class="font-size-sm text-muted">{{ $colig->desname }}</div>
                    </div>
                    <div class="block-content block-content-full">
                        @if ($colig->email)
                            <a class="btn btn-rounded btn-alt-success" href="mailto:{{ $colig->email }}">
                                <i class="fa fa-envelope mr-5"></i>Send Mail
                            </a>
                        @endif
                        @if ($colig->phone)
                            <a class="btn btn-rounded btn-alt-secondary" href="tel:{{ $colig->phone }}">
                                <i class="fa fa-phone mr-5"></i>Phone call
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            You have no known colleagues
        @endforelse
        </div>
        <!-- END Colleagues -->

    </div>
    <!-- END Main Content -->
    <!-- END Page Content -->
</main>
@endsection