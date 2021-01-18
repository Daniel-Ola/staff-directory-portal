<!-- Message Modal -->
    <div class="modal fade" id="modal-addpolicy" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
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
                        <form action="{{ route('pol.add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-12">Title</label>
                                <select name="subsidiary" class="form-control">
                                    <option value="">All subsidiary</option>
                                    @foreach ($subs as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Title</label>
                                <input type="text" class="form-control" id="" name="title" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">Select File</label>
                                <div class="col-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled" id="example-file-input-custom" accept="application/pdf" name="file" data-toggle="custom-file-input" required>
                                        <label class="custom-file-label" for="example-file-input-custom">Choose file (Allowed file - pdf)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-4">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-info">
                                        Upload Policy
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