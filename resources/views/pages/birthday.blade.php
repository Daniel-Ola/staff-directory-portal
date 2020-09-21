@php    
    use App\Wish;
    $randWish = Wish::inRandomOrder()->first();
    $wish = $randWish->message;
    $bgs = [
        'assets/media/birthday/1.jpg',
        'assets/media/birthday/2.jpg',
        'assets/media/birthday/3.jpg',
        'assets/media/birthday/4.jpg',
        'assets/media/birthday/5.jpg',
    ];
    $bg = $bgs[rand(0,3)];
@endphp
@extends('layouts.master')

@section('content')
<main id="main-container">
    <!-- Page Content -->
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url({{ asset($bg) }}); background-size: cover ; background-position: center center; height: 100vh !important; background-repeat: no-repeat;">
        <div class="bg-primary-dark-op py-30" style="height: inherit;">
        </div>
    </div>
</main>



@include('modals.birthday')

@endsection
