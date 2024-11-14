@extends('layouts.user')

@section('container')
<!-- header -->
<header class="py-4 shadow-sm bg-white">
    <div class="container flex items-center justify-between">
        <a href="index.html">
            <img src="{{url('assets/user/images/logo.png')}}" alt="Logo" class="w-32">
        </a>

        <form action="{{route('search_produk')}}" method="post" class="w-full max-w-xl relative flex">
            @csrf
            <span class="absolute left-4 top-3 text-lg text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="search" id="search" class="w-full border border-red-400 border-r-0 pl-12 py-3 pr-3 rounded-l-md hidden md:flex focus:outline-none" placeholder="search">
            <button type="submit" class="bg-red-600 border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition md:flex hidden" style="padding-top:2%;">Search</button>
        </form>

        <div class="flex items-center space-x-4">
            @if(Auth::user())
            <a href="{{route('favorit')}}" class="text-center text-gray-700 hover:text-primary transition relative">
                <div class="text-2xl">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="text-xs leading-3">Favorit</div>
            </a>
            <a href="{{route('pesanan')}}" class="text-center text-gray-700 hover:text-primary transition relative">
                <div class="text-2xl">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="text-xs leading-3">Pesanan</div>
            </a>
            <a href="{{route('profile')}}" class="text-center text-gray-700 hover:text-primary transition relative">
                <div class="text-2xl">
                    <i class="fas fa-user"></i>
                </div>
                <div class="text-xs leading-3">Account</div>
            </a>
            @endif
        </div>
    </div>
</header>
<!-- ./header -->

<!-- navbar -->
<nav class="bg-red-600">
    <div class="container flex">
        <div class="flex items-center justify-between flex-grow md:pl-12 py-5">
            <div class="flex items-center space-x-6 capitalize">
                @if(Auth::user())
                <a href="{{route('home')}}" class="text-gray-200 hover:text-white transition">Home</a>
                @else
                <a href="{{route('halaman_awal')}}" class="text-gray-200 hover:text-white transition">Home</a>
                @endif
                <a href="{{route('katalog_produk')}}" class="text-gray-200 hover:text-white transition">Katalog Produk</a>
                <a href="{{route('about_us')}}" class="text-gray-200 hover:text-white transition">About us</a>
                <a href="{{route('contact_us')}}" class="text-gray-200 hover:text-white transition">Contact us</a>
            </div>
            @if(Auth::user() == null)
            <a href="{{route('login')}}" class="text-gray-200 hover:text-white ">Login/Register</a>
            @endif
        </div>
    </div>
</nav>
<!-- ./navbar -->

<!-- Main content -->
@yield('content')
<!-- /.content -->

@endsection