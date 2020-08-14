@php
    use Carbon\Carbon;
@endphp
@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <!-- Row #1 -->
            <h2>Manage Announcements</h2>
            <!-- END Row #1 -->
        </div>
        <div class="row invisible" data-toggle="appear">
            <div class="col-md-12">
                <!-- Message List -->
            @if ($msg = Session::get('status'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ $msg }}</strong> 
                </div>
            @endif
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>Anouncements</strong>
                        </div>
                    </div>
                    <div class="block-content">

                        <!-- Messages -->
                        <table class="table table-hover table-vcenter">
                            {{-- js-table-checkable  --}}
                            <tbody>
                            @forelse ($anns as $ann)
                                @php
                                    $brief = substr($ann->details, 0, 50).'...';
                                    $rawDate = Carbon::parse($ann->created_at);
                                    $date = $rawDate->toFormattedDateString();
                                @endphp
                                <tr>
                                    <td class="d-none d-sm-table-cell font-w600" style="width: 140px;">{{ $ann->firstname.' '.$ann->lastname }}</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message{{ $ann->id }}" href="#">{{ $ann->subject }}</a>
                                        <div class="text-muted mt-5">{{ $brief }}</div>
                                    </td>
                                    <td class="font-w600 text-muted" style="width: 120px;">{{ $date }}</td>
                                    <td class="font-w600" style="width: 120px;">
                                        <form action="{{ route('ann.del') }}" id="deleteAnn{{ $ann->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $ann->id }}" form="deleteAnn{{ $ann->id }}">
                                            <button type="submit" class="btn btn-danger deleteAnn" subject="{{ $ann->subject }}" title="Delete" form="deleteAnn{{ $ann->id }}"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
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
        </div>
    </div>
</main>



@include('modals.news')
@include('modals.book')

@endsection
