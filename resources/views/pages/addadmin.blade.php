@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible justify-content-center" data-toggle="appear">
            <div class="col-xl-6 xl-offset-3 mt-5">
                <!-- Material Contact -->
                @if ($msg = Session::get('status'))
                    <div class="alert alert-primary alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="alert-heading font-size-h4 font-w400">Message</h3>
                        <p class="mb-0">{{ $msg }}</p>
                    </div>
                @endif

                <div class="block block-themed">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Add Users</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('admin.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" name="email" list="email" required>
                                        <label for="contact3-firstname">Email</label>
                                    </div>
                                    <datalist id="email">
                                        @foreach ($emails as $email)
                                            <option value="{{ $email->email }}">{{ $email->email }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-material floating open">
                                        <select class="form-control" id="contact3-subject" name="access" required>
                                            <option value="">Select one</option>
                                            <option value="1">Super Admin</option>
                                            <option value="2">Admin</option>
                                        </select>
                                        <label for="contact3-subject">Role</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        Update Role
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Material Contact -->
            </div>
        </div>
    </div>
</main>



@endsection
