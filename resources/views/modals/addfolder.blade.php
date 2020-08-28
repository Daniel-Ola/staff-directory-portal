<!-- Message Modal -->
<div class="modal fade" id="addFolder" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Create Folder</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                {{-- <div class="block-content block-content-full block-content-sm bg-body font-size-sm">
                </div> --}}
                <div class="block-content">
                    <form action="{{ route('folder.create') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label>Select Folder</label>
                            <select name="parent" class="form-control">
                                @if (!Request::segment(2))
                                    <option value="0">No Parent</option>
                                @endif
                                @forelse ($allfolders as $foldlist)
                                    <option value="{{ $foldlist->id }}"
                                        @if (Request::segment(2) == $foldlist->slug)
                                            selected
                                        @else
                                            disabled
                                        @endif
                                        >{{ $foldlist->name }}</option>
                                @empty
                                    <option value="" disabled>You have no folder</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group row">
                            <label>Folder Name</label>
                            <input type="text" class="form-control" id="" name="name" required>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-alt-info">
                                    Create Folder
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


<!-- Message Modal -->
<div class="modal fade" id="addFile" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Create Folder</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                {{-- <div class="block-content block-content-full block-content-sm bg-body font-size-sm">
                </div> --}}
                <div class="block-content">
                    <form action="{{ route('file.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label>Select Folder</label>
                            <select name="parent" class="form-control">
                                @if (!Request::segment(2))
                                    <option value="0">No Parent</option>
                                @endif
                                @forelse ($allfolders as $foldlist)
                                    <option value="{{ $foldlist->id }}"
                                        @if (Request::segment(2) == $foldlist->slug)
                                            selected
                                        @else
                                            disabled
                                        @endif
                                        >{{ $foldlist->name }}</option>
                                @empty
                                    <option value="" disabled>You have no folder</option>
                                @endforelse
                            </select>
                        </div>
                        {{-- <div class="form-group row">
                            <label>Name File</label>
                            <input type="text" class="form-control" id="" name="name" required>
                        </div> --}}
                        <div class="form-group row">
                            <label for="folderfiles" class="btn btn-primary">Select File(s)</label>
                            <input type="file" style="display: none;" multiple class="form-control" id="folderfiles" name="file[]" required>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-alt-info">
                                    Save file(s)
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