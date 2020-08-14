@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <!-- Row #1 -->
            <h2>Policy Management</h2>
            <!-- END Row #1 -->
        </div>
        <div class="row invisible" data-toggle="appear">
            <div class="col-md-7 col-xl-9">
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
                            <strong>Policies</strong>
                        </div>
                    </div>
                    <div class="block-content">

                        <!-- Messages -->
                        <table class="table table-hover table-vcenter">
                            {{-- js-table-checkable  --}}
                            <tbody>
                            @forelse ($pols as $pol)
                                <tr>
                                    <td class="d-none d-sm-table-cell font-w600" style="width: 140px;">{{ $pol->title }}</td>
                                    <td class="font-w600 text-muted" style="width: 120px;"><a href="{{ asset($pol->path) }}">View Policy</a></td>
                                    <td class="font-w600" style="width: 120px;">
                                        <form action="{{ route('pol.del') }}" id="deletePol{{ $pol->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $pol->id }}" form="deletePol{{ $pol->id }}">
                                            <button type="submit" class="btn btn-danger deletePol" subject="{{ $pol->title }}" title="Delete" form="deletePol{{ $pol->id }}"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No policies</td>
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
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-addpolicy"><i class="fa fa-plus"></i> Add Policy</button>
            </div>
        </div>
    </div>
</main>



@include('modals.addpolicy')

@endsection
