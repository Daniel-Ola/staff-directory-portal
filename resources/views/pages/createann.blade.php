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

                <div class="block block-themed ann_type" id="all">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Post Announcement</h3>
                        <div class="block-options">
                            {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button> --}}
                            <div class="dropdown">
                                <button type="button" class="btn-block-option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#all">
                                        To all of us
                                    </a>
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#sub">
                                        To Subsidiary
                                    </a>
                                    {{-- <div class="dropdown-divider"></div> --}}
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#dept">
                                        To Department
                                    </a>
                                </div>
                            </div>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('ann.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="contact30-firstname" name="subject">
                                        <label for="contact30-firstname">Subject</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="all_of_us" value="1">
                            <div class="form-material floating">
                                <textarea class="form-control" id="contact3-msg" name="details" rows="7"></textarea>
                                <label for="contact3-msg">Message Details</label>
                                <div class="form-text text-muted text-right">&nbsp;</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        <i class="fa fa-send mr-5"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="block block-themed ann_type" style="display: none;" id="sub">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Post Announcement</h3>
                        <div class="block-options">
                            {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button> --}}
                            <div class="dropdown">
                                <button type="button" class="btn-block-option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#all">
                                        To all of us
                                    </a>
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#sub">
                                        To Subsidiary
                                    </a>
                                    {{-- <div class="dropdown-divider"></div> --}}
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#dept">
                                        To Department
                                    </a>
                                </div>
                            </div>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('ann.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <select class="form-control" id="material-select-sub2" name="sub">
                                            <option hidden></option><!-- Empty value for demostrating material select box -->
                                            @forelse ($subs as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @empty
                                                <option value="">Nothing found</option>
                                            @endforelse
                                        </select>
                                        <label for="material-select-sub2">Please Select Subsidiary</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="contact31-firstname" name="subject">
                                        <label for="contact31-firstname">Subject</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-material floating">
                                <textarea class="form-control" id="contact3-msg" name="details" rows="7"></textarea>
                                <label for="contact3-msg">Message Details</label>
                                <div class="form-text text-muted text-right">&nbsp;</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        <i class="fa fa-send mr-5"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="block block-themed ann_type" style="display: none;" id="dept">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Post Announcement</h3>
                        <div class="block-options">
                            {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button> --}}
                            <div class="dropdown">
                                <button type="button" class="btn-block-option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#all">
                                        To all of us
                                    </a>
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#sub">
                                        To Subsidiary
                                    </a>
                                    {{-- <div class="dropdown-divider"></div> --}}
                                    <a class="dropdown-item openSection" href="javascript:void(0)" target="#dept">
                                        To Department
                                    </a>
                                </div>
                            </div>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('ann.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <select class="form-control" id="material-select-sub2" name="sub">
                                            <option hidden></option><!-- Empty value for demostrating material select box -->
                                            @forelse ($subs as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @empty
                                                <option value="">Nothing found</option>
                                            @endforelse
                                        </select>
                                        <label for="material-select-sub2">Please Select Subsidiary</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <select class="form-control" id="material-select2-dept" name="dept">
                                            <option hidden></option><!-- Empty value for demostrating material select box -->
                                            @forelse ($depts as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                            @empty
                                                <option value="">Nothing found</option>
                                            @endforelse
                                        </select>
                                        <label for="material-select2-dept">Please Select Department</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="contact32-firstname" name="subject">
                                        <label for="contact32-firstname">Subject</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-material floating">
                                <textarea class="form-control" id="contact3-msg" name="details" rows="7"></textarea>
                                <label for="contact3-msg">Message Details</label>
                                <div class="form-text text-muted text-right">&nbsp;</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        <i class="fa fa-send mr-5"></i> Send Message
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.openSection').click(function(e) {
                e.preventDefault();
                target = $(this).attr('target');
                $('.ann_type').hide();
                $(target).show();
            });
        });
    </script>
@endpush