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
                        <h3 class="block-title">Make a Wish <i class="fa fa-wand-magic"></i> </h3>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('wish.make') }}" method="post">
                            @csrf
                            <div class="form-material floating">
                                <textarea class="form-control" id="contact3-msg" name="message" rows="7" required></textarea>
                                <label for="contact3-msg">Make a Wish</label>
                                <div class="form-text text-muted text-right">&nbsp;</div>
                            </div>
                            <input type="hidden" name="maker" value="{{ Auth::user()->id }}" required>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        <i class="fa fa-send mr-5"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Material Contact -->


                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">
                            <strong>Wishes</strong>
                        </div>
                    </div>
                    <div class="block-content">

                        <!-- Messages -->
                        <table class="table table-hover table-vcenter" border="1">
                            <thead>
                                <th>S/N</th>
                                <th>Message</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                            @forelse ($wishes as $wish)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td class="d-none d-sm-table-cell font-w600" styler="width: 140px;">{{ $wish->message }}</td>
                                    <td class="font-w600" style="width: 100px;">
                                        <form action="{{ route('wish.del') }}" id="deleteWish{{ $wish->id }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $wish->id }}" form="deleteWish{{ $wish->id }}">
                                            <button type="submit" class="btn btn-danger active" title="Delete Wish" form="deleteWish{{ $wish->id }}"><i class="fa fa-trash text-white" style="color: white !important;"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">You have no wishes</td>
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
</main>



@endsection
