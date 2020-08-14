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
            <h2>Manage Admins</h2>
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
                            <strong>Super Amins</strong>
                        </div>
                    </div>
                    <div class="block-content">

                        <!-- Messages -->
                        <table class="table table-hover table-vcenter">
                            {{-- js-table-checkable  --}}
                            <tbody>
                            @forelse ($supers as $super)
                                <tr>
                                    <td class="d-none d-sm-table-cell font-w600" style="width: 140px;">{{ $super->firstname.' '.$super->lastname }}</td>
                                    <td>{{ $super->email }}</td>
                                    <td class="font-w600" style="width: 100px;">
                                        <form action="{{ route('admin.remove') }}" id="removeRole{{ $super->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $super->id }}" form="removeRole{{ $super->id }}">
                                            <button type="submit" class="btn btn-danger removeRole" user="{{ $super->firstname.' '.$super->lastname }}" title="Remove Role" form="removeRole{{ $super->id }}"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No Super Admins</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>


                        <!-- END Messages -->
                    </div>
                </div>
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>Admins</strong>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-hover table-vcenter">
                            {{-- js-table-checkable  --}}
                            <tbody>
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td class="d-none d-sm-table-cell font-w600" style="width: 140px;">{{ $admin->firstname.' '.$admin->lastname }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td class="font-w600" style="width: 100px;">
                                            <form action="{{ route('admin.remove') }}" id="removeRole{{ $admin->id }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $admin->id }}" form="removeRole{{ $admin->id }}">
                                                <button type="submit" class="btn btn-danger removeRole" user="{{ $super->firstname.' '.$super->lastname }}" title="Remove Role" form="removeRole{{ $admin->id }}"><i class="fa fa-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No Admins</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Message List -->
            </div>
        </div>
    </div>
</main>


@endsection
