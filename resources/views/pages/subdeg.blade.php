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

        <!-- Results -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#search-classic">Subsidiaries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#search-photos">Designation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#search-users">Department</a>
                    </li>
                </ul>
                <div class="block-content block-content-full tab-content overflow-hidden">
                    <!-- Classic -->
                    <div class="tab-pane fade show active" id="search-classic" role="tabpanel">
                        <div class="font-size-h3 font-w600 py-30 mb-20 text-center border-b">
                            <span class="text-primary font-w700">{{ count($subs) }}</span> subsidiaries listed
                        </div>
                        <div class="row items-push">
                            <div class="col-lg-12">
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
                                                        <input type="text" id="subfield" class="form-control" name="name" required>
                                                        <label for="subfield">Name</label>
                                                        <input type="hidden" name="type" value="0">
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
                            </div>
                        </div>
                    </div>
                    <!-- END Classic -->

                    <!-- Photos -->
                    <div class="tab-pane fade" id="search-photos" role="tabpanel">
                        <div class="font-size-h3 font-w600 py-30 mb-20 text-center border-b">
                            <span class="text-primary font-w700">{{ count($desigs) }}</span> designations listed
                        </div>
                        <div class="row items-push">
                            <div class="col-12">
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
                                                        <select class="form-control" id="departmentselect" name="dept_id" required>
                                                            <option></option><!-- Empty value for demostrating material select box -->
                                                            @forelse ($depts as $seldept)
                                                                <option value="{{ $seldept->id }}">{{ $seldept->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        <label for="departmentselect">Please Select a department</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-material floating">
                                                        <input type="text" id="designationfield" class="form-control" name="name" required>
                                                        <label for="designationfield">Name</label>
                                                        <input type="hidden" name="type" value="1">
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
                                                    <td>No designations</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        <!-- END Messages -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Photos -->

                    <!-- Users -->
                    <div class="tab-pane fade" id="search-users" role="tabpanel">
                        <div class="font-size-h3 font-w600 py-30 mb-20 text-center border-b">
                            <span class="text-primary font-w700">{{ count($depts) }}</span> departments listed
                        </div>
                        <div class="row items-push">
                            <div class="col-12">
                                <div class="block block-themed">
                                    <div class="block-header bg-info">
                                        <h3 class="block-title">Add New Department</h3>
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
                                                        <input type="text" id="departmentfield" class="form-control" name="name" required>
                                                        <label for="departmentfield">Name</label>
                                                        <input type="hidden" name="type" value="2">
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

                                <div class="block">
                                    <div class="block-header block-header-default">
                                        <div class="block-title">
                                            <strong>Designations <span class="badge badge-primary">{{ count($depts) }}</span> </strong>
                                        </div>
                                    </div>
                                    <div class="block-content">
                
                                        <!-- Messages -->
                                        <table class="table table-hover table-vcenter">
                                            {{-- js-table-checkable  --}}
                                            <tbody>
                                                @php
                                                    $deptCount = 1;
                                                @endphp
                                            @forelse ($depts as $dept)
                                                <tr>
                                                    <td class="d-none d-sm-table-cell font-w600">{{ $deptCount++ }}</td>
                                                    <td class="d-none d-sm-table-cell font-w600">{{ $dept->name }}</td>
                                                    <td class="font-w600s"><button class="btn btn-link btn-lg editsubdesig" target-name="{{ $dept->name }}" target-type="1" target-id="{{ $dept->id }}" data-toggle="modal" data-target="#modal-subdesigedit"> Edit</button></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>No departments</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        <!-- END Messages -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Users -->
                </div>
            </div>
        <!-- END Results -->
    </div>
</main>

@include('modals.subdesigedit')

@endsection
