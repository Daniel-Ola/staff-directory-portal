<div>
    
    {{-- blank --}}

    <div class="row">
        <div class="col-12">
            <form class="push" action="be_pages_generic_search.html" method="post">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="Search..." wire:model="query">
                </div>
            </form>
        </div>
        <div class="col-12 text-center" wire:loading wire:target="query">
            <div class="spinner-border text-danger" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

    <div class="row" wire:loading.remove wire:target="query">
        @forelse ($staffs as $i => $staff)
            <div class="col-md-6 col-xl-3">
                <a class="block text-center" href="javascript:void(0)">
                    @can('superadmin')
                        <div class="ribbon-box"> <i class="fa fa-pencil" aria-hidden="true" data-toggle="modal" wire:click="openModal({{ $i }})" data-target="#modal-edituser"></i> </div>
                    @endcan
                    <div class="block-content block-content-full bg-body-light">
                        <img class="img-avatar img-avatar-thumb" src="{{ asset($staff->dp) }}" alt="">
                    </div>
                    <div class="block-content block-content-full">
                        <div class="font-w600 mb-5">{{ "{$staff->firstname} {$staff->lastname}" }}</div>
                        <div class="font-size-sm text-muted">{{ $staff->desname ?? 'Not Set'  }}</div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <span class="font-w600 font-size-sm text-danger">{{ $staff->email }}</span>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-md-6 col-xl-3">
                <a class="block text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full bg-body-light">
                        <img class="img-avatar img-avatar-thumb" src="{{ asset('assets/media/avatars/avatar15.jpg') }}" alt="">
                    </div>
                    <div class="block-content block-content-full">
                        <div class="font-w600 mb-5">{{ "No User Found" }}</div>
                        <div class="font-size-sm text-muted">0 results</div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <span class="font-w600 font-size-sm">Try fulltext search</span>
                    </div>
                </a>
            </div>
        @endforelse

        <div class="col-12"> {{ $staffs->links() }} </div>
        

    </div>

    {{-- editing modal --}}

        <div class="modal fade" id="modal-edituser" tabindex="-1" role="dialog" aria-labelledby="modal-message" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popout" role="document" style="border-bottom: 5px solid #343a40;">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Edit User</h3>
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
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="firstname" value="{{ $fname }}">
                                </div>
                                <div class="form-group row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-info" name="action" value="update">
                                            Update
                                        </button>
                                        <button type="submit" class="btn btn-alt-danger" name="action" value="delete">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {{-- editing modal --}}


    {{-- blank --}}

</div>
