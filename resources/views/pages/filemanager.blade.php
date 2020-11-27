@php
    use App\Http\Controllers\ConfigController;
    $config = new ConfigController;
@endphp
@extends('layouts.master')

@section('content')

<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <form action="{{ route('folder.goback') }}" id="goback" method="post"> @csrf  <input type="hidden" name="slug" value="{{ Request::segment(2) }}"> </form>
            <div class="col-12 my-5">
                @if (Request::segment(1) != 'filemanagement')
                    <button type="submit" form="goback" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Up one level</button>
                    <a href="{{ route('fmi') }}" class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i> Go root folder</a>
                @endif
                <button class="btn btn-primary float-right mx-2" data-toggle="modal" data-target="#addFolder"><i class="fa fa-plus" aria-hidden="true"></i>  New Folder</button>
                @if (Request::segment(1) != 'filemanagement')
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addFile"><i class="fa fa-plus" aria-hidden="true"></i>  New File in this directory</button>
                @endif
            </div>
            @if (Session::has('status'))
            @include('partials.showalert', [
                'status' => Session::get('status'), 
                'message' => Session::get('message'),
                ])
            @endif
        </div>
        <div class="row invisible mt-5 pt-5" data-toggle="appear">


            <table class="table table-striped table-borderless table-hover table-vcenter">
                <thead class="thead-light">
                    <tr>
                        <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                        <th class="text-center" style="width: 70px;"><i class="si si-file"></i></th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell">Created By</th>
                        <th class="d-none d-lg-table-cell" style="width: 15%;">Created On</th>
                        <th class="text-center" style="width: 80px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="6">Folder</td></tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center">
                            <span class="badge badge-pill badge-primary">1</span>
                        </td>
                        <td class="text-center">
                            <i class="fa fa-folder text-primary" style="font-size: 22px;"></i>
                        </td>
                        <td class="font-w600">
                            <a href="{{ route('public.folders') }}">Public Folders</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <span class=""></span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button> --}}
                                {{-- <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                    @forelse ($folders as $folderCount => $folder)
                    <tr>
                        <td class="d-none d-sm-table-cell text-center">
                            <span class="badge badge-pill badge-primary">{{ $folderCount+2 }}</span>
                        </td>
                        <td class="text-center">
                            <i class="fa fa-folder text-primary" style="font-size: 22px;"></i>
                        </td>
                        <td class="font-w600">
                            <a href="{{ route('folder.get', [$folder->slug]) }}">{{ $folder->name }}</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            {{ Auth::user()->firstname.' '.Auth::user()->lastname }}
                        </td>
                        <td class="d-none d-lg-table-cell">
                            <span class="">{{ $folder->created_at }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" 
                                onclick="
                                    if(confirm('Are you sure you want to delete {{ $folder->name }}?')) {
                                        document.querySelector('#deletefolder{{ $folderCount+2 }}').submit();
                                    }
                                " class="btn btn-sm btn-secondary">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="{{ route('folder.delete') }}" id="deletefolder{{ $folderCount+2 }}" method="post">
                                    @csrf
                                    <input type="hidden" name="owner" value="{{ $folder->user_id }}">
                                    <input type="hidden" name="folder_id" value="{{ $folder->id }}">
                                    <input type="hidden" name="folder" value="{{ $folder->path }}">
                                </form>
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-toggle="modal"
                                    data-target="#shareItem"
                                    data-header="Share {{ $folder->name }} folder"
                                    data-item="{{ $folder->id }}"
                                    data-type="folders"
                                    title="Share Folder"
                                >
                                    <i class="fa fa-share"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr colspan="6">You have no folder in this directory</tr>
                    @endforelse
                    <tr><td colspan="6">Files</td></tr>
                    @forelse ($files as $count => $file)
                        <tr>
                            <td class="d-none d-sm-table-cell text-center">
                                <span class="badge badge-pill badge-primary">{{ count($folders)+$count+2 }}</span>
                            </td>
                            <td class="text-center">
                                <i class="fa fa-file text-primary" style="font-size: 22px;"></i>
                            </td>
                            <td class="font-w600">
                                <a href="{{ asset($file->path) }}">{{ $file->name }}</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                @php
                                    $creator = \App\User::find($file->user_id);
                                @endphp
                                {{ $creator->firstname. ' ' .$creator->lastname }}
                            </td>
                            <td class="d-none d-lg-table-cell">
                                <span class="">{{ $file->created_on }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary" 
                                        onclick="
                                            if(confirm('Are you sure you want to delete {{ $file->name }}?')) {
                                                document.querySelector('#deletefile{{ $count }}').submit();
                                            }
                                        ">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('downloadfile{{ $count }}').submit()" style="pointer: cursor;">
                                        <i class="fa fa-download"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <form action="{{ route('file.download') }}" id="downloadfile{{ $count }}" method="post">
                            @csrf
                            <input type="hidden" name="owner" value="{{ $file->user_id }}">
                            <input type="hidden" name="file_id" value="{{ $file->id }}">
                            <input type="hidden" name="file" value="{{ asset($file->path) }}">
                        </form>

                        <form action="{{ route('file.delete') }}" id="deletefile{{ $count }}" method="post">
                            @csrf
                            <input type="hidden" name="owner" value="{{ $file->user_id }}">
                            <input type="hidden" name="file_id" value="{{ $file->id }}">
                            <input type="hidden" name="file" value="{{ $file->path }}">
                        </form>
                    @empty
                        @if (Request::segment(2))
                            <tr><td colspan="6"><strong>There are no files in this directory</strong> </td></tr>
                        @endif
                        {{-- @if (Request::segment(2))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>There are no folders in this directory</strong> 
                            </div>
                        @endif --}}
                    @endforelse
                </tbody>
            </table>









            @if (1==2)
                <div class="col-md-3 m-3 p-3 bg-white shadow d-none" style="border: 0px groove #bb0903; border-radius: 5px;">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <i class="fa fa-folder text-primary" style="font-size: 22px;"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('public.folders') }}"><h5>Public Folders</h5></a>
                            </div>
                            {{-- <p class="small text-muted mb-0" style="filter: blur(2px); -webkit-filter: blur(2px);">1.754 Files</p> --}}
                        </div>
                    </div>
                </div>

                @php
                    $k = 0;
                @endphp
                @forelse ($folders as $folder)
                @php
                    $k += 1;
                @endphp
                <div class="col-md-3 m-3 p-3 bg-white shadow foldercard d-none" menu="#folder{{ $k }}" href="{{ route('folder.get', [$folder->slug]) }}" style="border: 0px groove #bb0903; border-radius: 5px;">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <i class="fa fa-folder text-primary" style="font-size: 22px;"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('folder.get', [$folder->slug]) }}"><h5>{{ $folder->name }}</h5></a>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-floating" id="folder{{ $k }}" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h text-primary"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right p-0">
                                        <div style="*filter: blur(2px); -webkit-filter*: blur(2px); z-index: 9999;">
                                            <a href="{{ route('public.folders', [$folder->slug]) }}" class="dropdown-item" data-sidebar-target="#view-detail">Open Folder</a>
                                            <a href="#" class="dropdown-item"
                                                data-toggle="modal"
                                                data-target="#shareItem"
                                                data-header="Share {{ $folder->name }} folder"
                                                data-item="{{ $folder->id }}"
                                                data-type="folders"
                                            >Share Folder</a>
                                            <form action="{{ route('folder.delete') }}" id="deletefolder{{ $k }}" method="post">
                                                @csrf
                                                <input type="hidden" name="owner" value="{{ $folder->user_id }}">
                                                <input type="hidden" name="folder_id" value="{{ $folder->id }}">
                                                <input type="hidden" name="folder" value="{{ $folder->path }}">
                                            </form>
                                            <a href="#" class="dropdown-item" 
                                            onclick="
                                                if(confirm('Are you sure you want to delete {{ $folder->name }}?')) {
                                                    document.querySelector('#deletefolder{{ $k }}').submit();
                                                }
                                            ">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="small text-muted mb-0" style="filter: blur(2px); -webkit-filter: blur(2px);">1.754 Files</p>
                        </div>
                    </div>
                </div>
                @empty
                You no have folder in this directory
                @endforelse
            @endif

            

        </div>
            
        @if (1==2)
            <div class="row invisible m-4" data-toggle="appear">
                @php
                    $count = 0;
                @endphp
                @forelse ($files as $file)
                    @php
                        $count += 1;
                    @endphp
                        <div class="col-md-6 col-xl-3" data-category="books">
                            <div class="block block-rounded block-link-shadow">
                                <div class="block-content block-content-full text-center">
                                    <div class="item item-circle bg-warning-light text-warning mx-auto my-20">
                                        <a href="{{ $file->path }}"><i class="fa fa-book"></i></a>
                                    </div>
                                    <div class="font-size-lg"><a href="{{ asset($file->path) }}" target="_blank">{{ $file->name }}</a></div>
                                    <div class="font-size-sm text-muted">
                                        <i class="fa fa-trash" title="Delete file" 
                                        onclick="
                                            if(confirm('Are you sure you want to delete {{ $file->name }}?')) {
                                                document.querySelector('#deletefile{{ $count }}').submit();
                                            }
                                        " style="pointer: cursor;"></i>
                                        |
                                        <i class="fa fa-arrow-down" title="Download File" onclick="document.getElementById('downloadfile{{ $count }}').submit()" style="pointer: cursor;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('file.download') }}" id="downloadfile{{ $count }}" method="post">
                            @csrf
                            <input type="hidden" name="owner" value="{{ $file->user_id }}">
                            <input type="hidden" name="file_id" value="{{ $file->id }}">
                            <input type="hidden" name="file" value="{{ asset($file->path) }}">
                        </form>

                        <form action="{{ route('file.delete') }}" id="deletefile{{ $count }}" method="post">
                            @csrf
                            <input type="hidden" name="owner" value="{{ $file->user_id }}">
                            <input type="hidden" name="file_id" value="{{ $file->id }}">
                            <input type="hidden" name="file" value="{{ $file->path }}">
                        </form>
                @empty
                    @if (Request::segment(1) != 'filemanagement')
                        You have no file in this directory
                    @else
                        You cannot create file in the root directory
                    @endif
                @endforelse
            </div>
        @endif
        

    </div>
</main>

@include('modals.addfolder')



@push('scripts')
    <script>
        $('.foldercard').contextmenu(function(e){
            e.preventDefault();
            $($(this).attr('menu'))
            .dropdown('toggle');
        });

        $('.foldercard').dblclick(function(e) {
            e.preventDefault();
            window.location.href = $(this).attr('href');
        });

        $('#shareItem').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            const item = button.data('item');
            const header = button.data('header');
            const type = button.data('type');
            const modal = $(this);
            modal.find('.block-title').text(header);
            modal.find('input[name="item_id"]').val(item);
            modal.find('input[name="type"]').val(type);
        });

        $('#sharedType').change(function(e) {
            select = $(this);
            form = '';
            if(select.val() == 'single')
            {
                form = '<input type="text" name="shared_with" placeholder="Enter User Email" class="form-control" required>';
            } else if(select.val() == 'group')
            {
                form = '<select class="custom-select" name="shared_with" required>'
                                +'<option value="" selected disable hidden>Select a group</option>'
                                @forelse($createdGroups as $cg)
                                    +'<option value="{{ $cg->id }}">{{ $cg->name }}</option>'
                                @empty
                                    '<option value="">You have created no group</option>'
                                @endforelse
                            +'</select>';
            }
            $('#sharedWith').html(form);
        });

        @if(Session::has(['status', 'notify']) && Session::get('notify') == true)
        <script src="{{ asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
            Codebase.helpers('notify', {
                align: 'right',             // 'right', 'left', 'center'
                from: 'top',                // 'top', 'bottom'
                type: "{{ session('status') }}",               // 'info', 'success', 'warning', 'danger'
                icon: 'fa fa-info mr-5',    // Icon class
                message: "{{ Session('message') }}"
            });
        @endif
    </script>
@endpush




@endsection
