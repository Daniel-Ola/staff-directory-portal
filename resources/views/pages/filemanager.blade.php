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
        <div class="row invisible" data-toggle="appear">
            @php
                $k = 0;
            @endphp
            @forelse ($folders as $folder)
            @php
                $k += 1;
            @endphp
            <div class="col-md-3 m-3 p-3" style="border: 1px ridge grey; border-radius: 5px;">
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
                                <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h text-primary"></i>
                                </a>
                                {{-- remove the padding --}}
                                <div class="dropdown-menu dropdown-menu-right p-0">

                                    
                                    {{-- <a href="#" class="dropdown-item disabled text-center" style="position: absolute; height: 100%; width: 100%; margin-left: 0; opacity: .5; z-index: 9999; font-weight: bolder; color: red;">C<br>o<br>m<br>i<br>n<br>g <br>S<br>o<br>o<br>n</a> --}}

                                    <div *style="filter: blur(2px); -webkit-filter: blur(2px);">
                                        {{-- <a href="#" class="dropdown-item disabled" data-sidebar-target="#view-detail">View Details</a>
                                        <a href="#" class="dropdown-item disabled">Share</a>
                                        <a href="#" class="dropdown-item disabled">Download</a>
                                        <a href="#" class="dropdown-item disabled">Copy to</a>
                                        <a href="#" class="dropdown-item disabled">Move to</a>
                                        <a href="#" class="dropdown-item disabled">Rename</a> --}}
                                        <form action="{{ route('folder.delete') }}" id="deletefile{{ $k }}" method="post">
                                            @csrf
                                            <input type="hidden" name="owner" value="{{ $folder->user_id }}">
                                            <input type="hidden" name="folder_id" value="{{ $folder->id }}">
                                            <input type="hidden" name="folder" value="{{ $folder->path }}">
                                        </form>
                                        <a href="#" class="dropdown-item" 
                                        onclick="
                                            if(confirm('Are you sure you want to delete {{ $folder->name }}?')) {
                                                document.querySelector('#deletefile{{ $k }}').submit();
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
            
            
            <div class="row invisible m-4" data-toggle="appear">
                @php
                    $count = 1;
                @endphp
                @forelse ($files as $file)
                    @php
                        $count += 1;
                    @endphp
                    <div class="col-2 card p-3 m-3" style="border: 1px ridge grey; border-radius: 5px;">
                        <div class="card-body mb-3 d-flex justify-content-between flex-row">
                            <div>
                                <a href="#">
                                    <i class="fa fa-file-o mr-2"></i> {{ $file->name }}
                                    {{-- fa-file-text-o --}}
                                </a>
                                <span class="ml-3 small" style="filter: blur(2px); -webkit-filter: blur(2px);">70 KB</span>
                            </div>
                            <div>

                                <form action="{{ route('file.download') }}" id="downloadfile{{ $count }}" method="post">
                                    @csrf
                                    <input type="hidden" name="owner" value="{{ $file->user_id }}">
                                    <input type="hidden" name="file_id" value="{{ $file->id }}">
                                    <input type="hidden" name="file" value="{{ $file->path }}">
                                </form>
                                <a href="#" title="Download file" onclick="document.getElementById('downloadfile{{ $count }}').submit()">
                                    <i class="fa fa-arrow-down"></i>
                                </a>
                                <a href="{{ asset($file->path) }}" title="View file">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <form action="{{ route('file.delete') }}" id="deletefile{{ $count }}" method="post">
                                    @csrf
                                    <input type="hidden" name="owner" value="{{ $file->user_id }}">
                                    <input type="hidden" name="file_id" value="{{ $file->id }}">
                                    <input type="hidden" name="file" value="{{ $file->path }}">
                                </form>
                                <a href="#" title="Delete file" 
                                    onclick="
                                        if(confirm('Are you sure you want to delete {{ $file->name }}?')) {
                                            document.querySelector('#deletefile{{ $count }}').submit();
                                        }
                                    ">
                                    
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    @if (Request::segment(1) != 'filemanagement')
                        You have no file in this directory
                    @else
                        You cannot create file in the root directory
                    @endif
                @endforelse
            </div>

        </div>
</main>

@include('modals.addfolder')

@endsection
