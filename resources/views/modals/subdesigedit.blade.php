<!-- Message Modal -->
<div class="modal fade" id="modal-subdesigedit" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Add Policy</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                {{-- <div class="block-content block-content-full block-content-sm bg-body font-size-sm">
                </div> --}}
                <div class="block-content">
                    <form action="{{ route('editsubdesig') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-12">Name</label>
                            <input type="text" class="form-control" id="getName" name="name" required>
                            <input type="hidden" name="type" id="getType" value="0">
                            <input type="hidden" name="id" id="getId" value="0">
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-alt-info">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Message Modal -->