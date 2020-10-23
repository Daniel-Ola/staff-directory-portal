@php
    use App\Http\Controllers\ConfigController;
    $config = new ConfigController;
@endphp
@extends('layouts.master')

@section('styles')
    <style>
        .list-group-item {
            cursor: context-menu;
        }

        .list-group-item:hover {
            background-color: #f2f2f2;
        }
    </style>
@endsection

@section('content')

<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <form action="{{ route('folder.goback') }}" id="goback" method="post"> @csrf  <input type="hidden" name="slug" value="{{ Request::segment(2) }}"> </form>
            <div class="col-12 my-5">
                {{-- @if (Request::segment(1) == 'publicfolder' && !empty(Request::segment(2))) --}}
                <a href="{{ route('shared.folders') }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Shared Folders</a>
                <a href="{{ route('fmi') }}" class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i> Go root folder</a>
                {{-- @endif --}}
                {{-- <button class="btn btn-primary float-right mx-2" data-toggle="modal" data-target="#addFolder"><i class="fa fa-plus" aria-hidden="true"></i>  New Folder</button> --}}
                {{-- @if (Request::segment(1) == 'publicfolder' && !empty(Request::segment(2))) --}}
                    {{-- <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addFile"><i class="fa fa-plus" aria-hidden="true"></i>  New File in this directory</button> --}}
                {{-- @endif --}}
            </div>
            @if (Session::has('status'))
            @include('partials.showalert', [
                'status' => Session::get('status'), 
                'message' => Session::get('message'),
                ])
            @endif
        </div>
        <div class="row invisible mt-5 pt-5" data-toggle="appear">


            @php
                $k = 0;
            @endphp
            @forelse ($sharedDocs as $folder)
            @php
                $k += 1;
            @endphp
                <div class="col-md-3 m-3 p-3 bg-white shadow foldercard {{ $folder->scope == 'sub' ? 'd-none':'' }}" menu="#folder{{ $k }}" href="{{ route('shared.folders', [$folder->slug]) }}" style="border: 0px groove #bb0903; border-radius: 5px;">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <i class="fa fa-folder text-primary" style="font-size: 22px;"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('shared.folders', [$folder->slug]) }}"><h5>{{ $folder->name }}</h5></a>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-floating" id="folder{{ $k }}" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h text-primary"></i>
                                    </a>
                                    {{-- remove the padding --}}
                                    <div class="dropdown-menu dropdown-menu-right p-0">

                                        
                                        {{-- <a href="#" class="dropdown-item disabled text-center" style="position: absolute; height: 100%; width: 100%; margin-left: 0; opacity: .5; z-index: 9999; font-weight: bolder; color: red;">C<br>o<br>m<br>i<br>n<br>g <br>S<br>o<br>o<br>n</a> --}}

                                        <div *style="filter: blur(2px); -webkit-filter: blur(2px);">
                                            <a href="{{ route('shared.folders', [$folder->slug]) }}" class="dropdown-item" data-sidebar-target="#view-detail">Open Folder</a>
                                            {{-- <a href="#" class="dropdown-item disabled">Share</a>
                                            <a href="#" class="dropdown-item disabled">Download</a>
                                            <a href="#" class="dropdown-item disabled">Copy to</a>
                                            <a href="#" class="dropdown-item disabled">Move to</a>
                                            <a href="#" class="dropdown-item disabled">Rename</a> --}}
                                            {{-- <form action="{{ route('folder.delete') }}" id="deletefolder{{ $k }}" method="post">
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
                                            ">Delete</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="small text-muted mb-0" style="filter: blur(2px); -webkit-filter: blur(2px);">1.754 Files</p>
                        </div>
                    </div>
                </div>
            @empty
                {{-- @if (Request::segment(2))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>There are no folders in this directory</strong> 
                    </div>
                @endif --}}
            @endforelse
        </div>
            
            
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
                @if (Request::segment(2))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>There are no files in this directory</strong> 
                    </div>
                @endif
                @if (empty(Request::segment(2)))
                    You cannot create file in the public root directory
                @endif
            @endforelse
        </div>

    </div>
    

    <div class="fixed-bottom mb-2 mr-2">
        <ul class="list-group w-auto float-right">
            <span class="bottomMenuList" style="display: none;">
                <li class="list-group-item active" data-toggle="modal" data-target="#addGroup" style="cursor: pointer;"><i class="fa fa-users text-white" style="color: white !important;" aria-hidden="true"></i> Create Group</li>
                {{-- <li class="list-group-item">Item</li> --}}
            </span>
            <li class="list-group-item" style="background-color: none !important;">
                <button class="btn btn-primary rounded-circle float-right p-3 shadow-lg showMenu"><span class="fa fa-bars"></span></button>
            </li>
        </ul>
    </div>
</main>

@include('modals.addfolder')

@endsection

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

        $('.showMenu').click(function () {
            $('.bottomMenuList').toggle();
            $(this).find('fa').toggleClass('fa-bars', 'fa-times');
            // $(this).find('fa').toggleClass('fa-times');
        });
    </script>
@endpush