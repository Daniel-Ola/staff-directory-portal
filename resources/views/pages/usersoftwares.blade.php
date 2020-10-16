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
            <div class="col-12">
                @livewire('search-user')
            </div>
        </div>
</main>



{{-- @include('modals.news') --}}

@endsection
