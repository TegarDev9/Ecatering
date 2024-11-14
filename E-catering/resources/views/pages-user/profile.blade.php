@extends('layouts.topbar')

@section('content')

<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <span class="text-sm text-gray-400">
        <i class="fas fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Profile</p>
</div>
<!-- ./breadcrumb -->

<!-- wrapper -->
<div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

    <!-- sidebar -->
    <div class="col-span-3">
        <div class="px-4 py-3 shadow flex items-center gap-4">
            <div class="flex-shrink-0">
                <img src="{{url('assets/profile',Auth::user()->profile->foto)}}" alt="profile" class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
            </div>
            <div class="flex-grow">
                <p class="text-gray-600">Hello,</p>
                <h4 class="text-gray-800 font-medium">{{Auth::user()->profile->nama}}</h4>
            </div>
        </div>

        <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
            <div class="space-y-1 pl-8">
                <a href="{{route('profile')}}" class="relative text-red-600 block capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-user"></i>
                    </span>
                    Profile
                </a>
                <a href="{{route('profile')}}" class="relative text-red-600 block transition">
                    Detail Profile
                </a>
                <a href="{{route('profile-edit',Auth::user()->id)}}" class="relative hover:text-red-600 block transition">
                    Edit Profile
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="{{route('history')}}" class="relative hover:text-red-600 block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-archive"></i>
                    </span>
                    My order history
                </a>
                <a href="{{route('belum_dibayar')}}" class="relative hover:text-red-600 block capitalize transition">
                    Belum Dibayar
                </a>
                <a href="{{route('history')}}" class="relative hover:text-red-600 block capitalize transition">
                    Diproses
                </a>
                <a href="{{route('dikirim')}}" class="relative hover:text-red-600 block capitalize transition">
                    Dikirim
                </a>
                <a href="{{route('diterima')}}" class="relative hover:text-red-600 block capitalize transition">
                    Diterima
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="{{route('favorit')}}" class="relative hover:text-red-600 font-medium block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-heart"></i>
                    </span>
                    My wishlist
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="#" class="relative hover:text-red-600 block font-medium capitalize transition" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
    </div>
    <!-- ./sidebar -->

    <!-- profile -->
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7">
        <h4 class="text-lg font-medium capitalize mb-4">
            Detail Profile
        </h4>

        <div class="space-y-4">
            <div class="w-full">
                <center>
                    <img src="{{url('assets/profile/'.Auth::user()->profile->foto)}}" alt="" width="10%" class="profile">
                </center>
            </div>
            <div class="grid grid-cols-2 gap-4" style="padding-left: 20%;">
                <div>
                    <p for="first" style="font-weight: bold;">Nama Pengguna</p>
                    <p style="padding-top: 1rem;">{{Auth::user()->profile->nama}}</p>
                </div>
                <div>
                    <p for="first" style="font-weight: bold;">Email</p>
                    <p style="padding-top: 1rem;">{{Auth::user()->email}}</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4" style="padding-left: 20%;">
                <div>
                    <p for="first" style="font-weight: bold;">Username</p>
                    <p style="padding-top: 1rem;">{{Auth::user()->username}}</p>
                </div>
                <div>
                    <p for="first" style="font-weight: bold;">No Telp</p>
                    <p style="padding-top: 1rem;">{{(Auth::user()->profile->no_telp == null) ? '-' : Auth::user()->profile->no_telp}}</p>
                </div>
            </div>
            <div class="w-full" style="padding-left: 20%;">
                <div>
                    <p for="first" style="font-weight: bold;">Alamat</p>
                    <p style="padding-top: 1rem;">{{(Auth::user()->profile->alamat == null) ? '-' : Auth::user()->profile->alamat}}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ./profile -->

</div>
<!-- ./wrapper -->
@endsection