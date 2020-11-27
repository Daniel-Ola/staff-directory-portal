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
                <a class="block text-center @can('superadmin') openEditUserModal @endcan" href="javascript:void(0)"
                    @can('superadmin') 
                        data-fname="{{ $staff->firstname }}"
                        data-email="{{ $staff->email }}"
                        data-id="{{ $staff->id }}"
                        data-subsidiary="{{ $staff->subsidiary }}"
                        data-department="{{ $staff->department }}"
                        data-designation="{{ $staff->designation }}"
                    @endcan
                >
                    <div class="block-content block-content-full bg-body-light">
                        <img class="img-avatar img-avatar-thumb" src="{{ asset($staff->dp) }}" alt="">
                    </div>
                    <div class="block-content block-content-full">
                        <div class="font-w600 mb-5">{{ "{$staff->firstname} {$staff->lastname}" }}</div>
                        <div class="font-size-sm text-muted">{{ $staff->desname ?? 'Not Set'  }}</div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <span class="font-w600 font-size-sm text-danger" style="word-wrap: break-word;">{{ $staff->email }}</span>
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
    <div wire:ignore>
        @include('modals.staffdirectorymodal')
    </div>

</div>
