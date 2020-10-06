@php
    use Carbon\Carbon;
@endphp
@extends('layouts.master')

@section('styles')
    <style>
        /*custom styles can go here sir*/
        .core-container{
            border: 2px dashed red;
            height: 200px !important;
        }
    </style>
@endsection

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <!-- Row #1 -->
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right core-container" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/empathy.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="1500">Empathy</div>
                        <div class="core">We understand and feel the needs of all stakeholders because we work together to achieve a common goal and we strive harder to meet their expectations.</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right core-container" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/chess.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="780">Nobility</div>
                        <div class="core">We treat our customers like Royalty and continually upgrade our Customer Experience to First-Class.</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right core-container" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/correct.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="15">Assurance</div>
                        <div class="core">We have confidence that we will provide the best services at all times in all ways.</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right core-container" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/seal.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="4252">Integrity</div>
                        <div class="core">We carry out all business in a strict, and in compliance with the best practices in the word. We never compromise in our dealings with all stakeholders.</div>
                    </div>
                </a>
            </div>
            <!-- END Row #1 -->
        </div>
    @if (count($bdays) >= 1)
        <div class="row invisible justify-content-centerd" data-toggle="appear">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3>Today's Birthday</h3>
            <strong>
                <ul>
                    @foreach ($bdays as $bday)
                        <li>{{ $bday->firstname.' '.$bday->lastname }}</li>
                    @endforeach
                </ul>
            </strong> 
            </div>
        </div>
    @endif
    <div class="row invisible" data-toggle="appear">
        <div class="col-md-7 col-xl-9">
            <!-- Message List -->
            <div class="block">
                <div class="block-header block-header-default">
                    <div class="block-title">
                            <strong>Anouncements</strong>
                        </div>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option">
                                <i class="si si-arrow-left"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option">
                                <i class="si si-arrow-right"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <!-- Messages Options -->
                        <div class="push d-none">
                            <button type="button" class="btn btn-rounded btn-alt-secondary float-right">
                                <i class="fa fa-times text-danger mx-5"></i>
                                <span class="d-none d-sm-inline"> Delete</span>
                            </button>
                            <button type="button" class="btn btn-rounded btn-alt-secondary">
                                <i class="fa fa-archive text-primary mx-5"></i>
                                <span class="d-none d-sm-inline"> Archive</span>
                            </button>
                            <button type="button" class="btn btn-rounded btn-alt-secondary">
                                <i class="fa fa-star text-warning mx-5"></i>
                                <span class="d-none d-sm-inline"> Star</span>
                            </button>
                        </div>
                        <!-- END Messages Options -->

                        <!-- Messages -->
                        <!-- Checkable Table (.js-table-checkable class is initialized in Helpers.tableToolsCheckable()) -->
                        <table class="js-table-checkable table table-hover table-vcenter">
                            <tbody>
                            @forelse ($anns as $ann)
                                @php
                                    $brief = substr($ann->details, 0, 50).'...';
                                    $rawDate = Carbon::parse($ann->created_at);
                                    $date = $rawDate->toFormattedDateString();
                                @endphp
                                <tr>
                                    <td class="text-center d-none" style="width: 40px;">
                                        <label class="css-control css-control-primary css-checkboxs">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="font-w600" style="width: 140px;">{{ $ann->firstname.' '.$ann->lastname }}</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message{{ $ann->id }}" href="#">{{ $ann->subject }}</a>
                                        <div class="text-muted mt-5">{{ $brief }}</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted" style="width: 120px;">{{ $date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No announcement</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- END Messages -->
                    </div>
                </div>
                <!-- END Message List -->
            </div>
            <div class="col-md-5 col-xl-3">
                @forelse ($pols as $pol)
                    <a class="btn btn-primary btn-lg" href="{{ asset($pol->path) }}">{{ $pol->title }}</a>
                @empty
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Stay tuned for our handbooks</strong> 

                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    

    
    
</main>



@include('modals.news')

@endsection



