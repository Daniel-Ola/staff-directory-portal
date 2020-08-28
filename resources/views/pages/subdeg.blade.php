@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible justify-content-center" data-toggle="appear">
            <div class="col-xl-6 xl-offset-3 mt-5">
                @if ($msg = Session::get('status'))
                    <div class="alert alert-primary alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="alert-heading font-size-h4 font-w400">Message</h3>
                        <p class="mb-0">{{ $msg }}</p>
                    </div>
                <!-- Material Contact -->
                @endif
            </div>
        </div>
        
        <div class="row">
            <div class="col-6 mt-5">
                <div class="block block-themed">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Add New Subsidiary</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('subdesig') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" name="name" required>
                                        <input type="hidden" name="type" value="0">
                                        <label for="contact3-firstname">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Material Contact -->
            </div>
            <div class="col-6 mt-6">
                <div class="block block-themed">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Add New Designation</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('subdesig') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" name="name" required>
                                        <input type="hidden" name="type" value="1">
                                        <label for="contact3-firstname">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Material Contact -->
            </div>
        </div>

        <div class="row invisible" data-toggle="appear">
            <div class="col-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>Subsidiaries <span class="badge badge-primary">{{ count($subs) }}</span> </strong>
                        </div>
                    </div>
                    <div class="block-content">

                        <!-- Messages -->
                        <table class="table table-hover table-vcenter">
                            {{-- js-table-checkable  --}}
                            <tbody>
                                @php
                                    $subCount = 1;
                                @endphp
                            @forelse ($subs as $sub)
                                <tr>
                                    <td class="d-none d-sm-table-cell font-w600">{{ $subCount++ }}</td>
                                    <td class="d-none d-sm-table-cell font-w600">{{ $sub->name }}</td>
                                    <td class="font-w600s"><button class="btn btn-link btn-lg editsubdesig" target-name="{{ $sub->name }}" target-type="0" target-id="{{ $sub->id }}" data-toggle="modal" data-target="#modal-subdesigedit"> Edit</button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No subsidiaries</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- END Messages -->
                    </div>
                </div>
                <!-- END Message List -->
            </div>
            <div class="col-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>Designations <span class="badge badge-primary">{{ count($desigs) }}</span> </strong>
                        </div>
                    </div>
                    <div class="block-content">

                        <!-- Messages -->
                        <table class="table table-hover table-vcenter">
                            {{-- js-table-checkable  --}}
                            <tbody>
                                @php
                                    $desigCount = 1;
                                @endphp
                            @forelse ($desigs as $desig)
                                <tr>
                                    <td class="d-none d-sm-table-cell font-w600">{{ $desigCount++ }}</td>
                                    <td class="d-none d-sm-table-cell font-w600">{{ $desig->name }}</td>
                                    <td class="font-w600s"><button class="btn btn-link btn-lg editsubdesig" target-name="{{ $desig->name }}" target-type="1" target-id="{{ $desig->id }}" data-toggle="modal" data-target="#modal-subdesigedit"> Edit</button></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No subsidiaries</td>
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

@include('modals.subdesigedit')

@endsection
