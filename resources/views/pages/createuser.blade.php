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
                        <form action="{{ route('staffs.add') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="contact3-firstname" name="emails" value="{{ old('emails') }}" required>
                                        <label for="contact3-firstname">Enter Emails</label>
                                        <div class="form-text text-muted text-rights">Separate multiple with comma abc@cititrustholdings.com, cba@corecapitalng.com</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        <i class="fa fa-send mr-5"></i> Add Users
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
