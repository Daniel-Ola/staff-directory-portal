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
                            <input type="text" class="form-control" name="name" required>
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


<!-- Message Modal -->
<div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Create Group</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{ route('group.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Group Name" class="form-control" required>
                        </div>
                        <input type="hidden" value="users" name="type">
                        @livewire('select-multiple')
                        <div class="form-group row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-alt-info">
                                    Create Group
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
<div class="modal fade" id="shareItem" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideleft fixed-bottom mb-0" role="document" style="border-bottom: 5px solid #343a40;">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Share</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{ route('share.folder') }}" method="post">
                        @csrf
                        <input type="hidden" name="item_id">
                        <input type="hidden" name="shared_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="type">
                        <div class="form-group sharedWith">
                            <label for=""></label>
                            <select class="custom-select" id="sharedType" name="shared_type">
                                <option selected disabled hidden>Select one</option>
                                <option value="single">Share with a user</option>
                                <option value="group">Share with a group</option>
                            </select>
                        </div>
                        <div class="form-group" id="sharedWith">
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-alt-info">
                                    Share
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