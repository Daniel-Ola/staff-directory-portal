@php
    use Illuminate\Support\Facades\File;
    $root = File::directories('filemanager/_public/');
@endphp+
@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <ul class="list-group">
                @php
                    $dirs = [];
                @endphp
                @foreach ($root as $r)
                {{-- @php
                    $imDir = explode("filemanager/_public",$r)[1];
                @endphp --}}
                {{-- {{ File::isDirectory('filemanager') ? 'yes':'no' }} --}}
                    <li class="list-group-item">
                        @php
                            $sub = explode(DIRECTORY_SEPARATOR, $r)[1];
                            $depts = File::directories($r);
                        @endphp
                        {{ $sub }}
                        <ul class="list-group">
                            @foreach ($depts as $d)
                                @php
                                    $dept = explode($sub.DIRECTORY_SEPARATOR, $d)[1];
                                @endphp
                                <li class="list-group-item">
                                    {{ $dept }}
                                    @php
                                        $files = File::allFiles($d);
                                    @endphp
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
</main>



{{-- @include('modals.news') --}}

@endsection
