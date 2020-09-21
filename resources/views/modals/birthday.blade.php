@php
    use Carbon\Carbon;
    $rawDate = Carbon::now();
    $date = $rawDate->toFormattedDateString();
@endphp

    <div class="modal fade" id="birthdayModal" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Happy Birthday</h3>
                        <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-image text-center" style="background-color: white;">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset('assets/media/citi_assets/favicon.png') }}  " alt="">
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body font-size-sm">
                        <span class="text-muted float-right"><em>{{ $date }}</em></span>
                        <a href="javascript:void(0)">{{ 'Happy Birthday to you '.Auth::user()->firstname  }}</a>
                    </div>
                    <div class="block-content">
                        <p>
                            <strong>Dear {{ Auth::user()->firstname.' '.Auth::user()->lastname }}, </strong>
                        </p>
                        <p>
                            {{ $wish }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>