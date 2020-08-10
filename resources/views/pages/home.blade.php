@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <!-- Row #1 -->
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/empathy.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="1500">Empathy</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Core Value</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/chess.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="780">Nobility</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Core Value</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/correct.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="15">Assurance</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Core Value</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block" style="height:65px; width:65px;">
                            <img src="{{ asset('assets/media/values/seal.svg') }}" alt="" class="img-fluid">
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTos" data-speed="1000" data-to="4252">Integrity</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Core Value</div>
                    </div>
                </a>
            </div>
            <!-- END Row #1 -->
        </div>
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
                                <tr>
                                    <td class="text-center d-none" style="width: 40px;">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600" style="width: 140px;">Laura Carr</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Welcome to our service</a>
                                        <div class="text-muted mt-5">It's a pleasure to have you on our service..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted" style="width: 120px;">WED</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Lisa Jenkins</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Your subscription was updated</a>
                                        <div class="text-muted mt-5">We are glad you decided to go with a vip..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">WED</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Brian Stevens</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Update is available</a>
                                        <div class="text-muted mt-5">An update is under way for your app..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">FRI</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Brian Cruz</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">New Sale!</a>
                                        <div class="text-muted mt-5">You had a new sale and earned..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">THU</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Jack Estrada</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Action Required for your account!</a>
                                        <div class="text-muted mt-5">Your account is inactive for a long time and..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">MON</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Lori Moore</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">New Photo Pack!</a>
                                        <div class="text-muted mt-5">Our new photo pack is available now! You..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">MON</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Alice Moore</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Product is released!</a>
                                        <div class="text-muted mt-5">This is a notification about our new product..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">TUE</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Barbara Scott</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Now on Sale!</a>
                                        <div class="text-muted mt-5">Our Book is out! You can buy a copy and..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">WED</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Lisa Jenkins</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Monthly Report</a>
                                        <div class="text-muted mt-5">The monthly report you requested for..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">SAT</td>
                                </tr>
                                <tr>
                                    <td class="text-center d-none">
                                        <label class="css-control css-control-primary css-checkbox">
                                            <input type="checkbox" class="css-control-input">
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-w600">Helen Jacobs</td>
                                    <td>
                                        <a class="font-w600" data-toggle="modal" data-target="#modal-message" href="#">Trial Started!</a>
                                        <div class="text-muted mt-5">You 30-day trial has now started and..</div>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-w600 font-size-sm text-muted">SUN</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- END Messages -->
                    </div>
                </div>
                <!-- END Message List -->
            </div>
            <div class="col-md-5 col-xl-3">
                <button class="btn btn-primary btn-lg">View Handbook</button>
            </div>
        </div>
    </div>
</main>







<!-- Message Modal -->
<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Welcome to our service</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="tooltip" data-placement="left" title="Reply">
                            <i class="fa fa-reply"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full bg-image text-center" style="background-image: url('assets/media/photos/photo6.jpg');">
                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="assets/media/avatars/avatar4.jpg" alt="">
                </div>
                <div class="block-content block-content-full block-content-sm bg-body font-size-sm">
                    <span class="text-muted float-right"><em>2 min ago</em></span>
                    <a href="javascript:void(0)">service@example.com</a>
                </div>
                <div class="block-content">
                    <p>Dear Customer,</p>
                    <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                    <p>Best Regards,</p>
                    <p>Marie Duncan</p>
                </div>
                <div class="block-content bg-body">
                    <div class="row gutters-tiny items-push">
                        <div class="col-sm-4">
                            <div class="options-container fx-overlay-slide-down">
                                <img class="img-fluid options-item" src="assets/media/photos/photo20.jpg" alt="">
                                <div class="options-overlay bg-black-op">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-rounded btn-noborder btn-alt-secondary min-width-75" href="javascript:void(0)">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="font-size-sm text-muted mt-5">Travel_Pack_1.jpg</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="options-container fx-overlay-slide-down">
                                <img class="img-fluid options-item" src="assets/media/photos/photo21.jpg" alt="">
                                <div class="options-overlay bg-black-op">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-rounded btn-noborder btn-alt-secondary min-width-75" href="javascript:void(0)">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="font-size-sm text-muted mt-5">Travel_Pack_2.jpg</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="options-container fx-overlay-slide-down">
                                <img class="img-fluid options-item" src="assets/media/photos/photo22.jpg" alt="">
                                <div class="options-overlay bg-black-op">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-rounded btn-noborder btn-alt-secondary min-width-75" href="javascript:void(0)">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="font-size-sm text-muted mt-5">Travel_Pack_3.jpg</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Message Modal -->



@endsection
