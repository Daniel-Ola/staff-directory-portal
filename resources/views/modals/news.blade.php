@php
    use Carbon\Carbon;
@endphp

<!-- Message Modal -->
@forelse ($anns as $ann)
@php
    $rawDate = Carbon::parse($ann->created_at);
    $date = $rawDate->toFormattedDateString();
@endphp
    <div class="modal fade" id="modal-message{{ $ann->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">{{ $ann->subject }}</h3>
                        <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full bg-image text-center" style="*background-image: url('assets/media/photos/photo6.jpg'); background-color: white;">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset('assets/media/citi_assets/favicon.png') }}  " alt="">
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body font-size-sm">
                        <span class="text-muted float-right"><em>{{ $date }}</em></span>
                        <a href="javascript:void(0)">{{$ann->email  }}</a>
                    </div>
                    <div class="block-content">
                        <p>{{ $ann->details }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    
@endforelse
<!-- END Message Modal -->