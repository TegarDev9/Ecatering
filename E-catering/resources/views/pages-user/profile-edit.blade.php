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
                <a href="{{route('profile')}}" class="relative hover:text-red-600 block transition">
                    Detail Profile
                </a>
                <a href="{{route('profile-edit',Auth::user()->id)}}" class="relative text-red-600 block transition">
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
            Edit Profile
        </h4>
        <form method="POST" action="{{ route('profile-update',Auth::user()->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div class="wfull">
                    <div>
                        <label for="nama">Nama Pengguna</label>
                        <input type="text" name="nama" id="nama" class="input-box rounded " placeholder="Input Nama" value="{{$user->profile->nama}}">
                    </div>
                </div>
                <div class="wfull">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="input-box rounded" placeholder="Input Email" value="{{$user->email}}">
                    </div>
                </div>
                <div class="wfull">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="input-box rounded " placeholder="Input Username" value="{{$user->username}}">
                    </div>
                </div>
                <div class="wfull">
                    <div>
                        <label for="no_telp">NO Telp</label>
                        <input type="number" name="no_telp" id="no_telp" class="input-box rounded " placeholder="Input No Telp" value="{{$user->profile->no_telp}}">
                    </div>
                </div>
                <div class="wfull">
                    <div>
                        <label for="alamat">Alamat</label>
                        <textarea rows="4" name="alamat" id="alamat" class="input-box rounded " style="border-color: gray;" placeholder="Input Alamat">{{$user->profile->alamat}}</textarea>
                    </div>
                </div>
                <div class="wfull">
                    <div>
                        <label for="password">Reset Password</label>
                        <input type="password" name="password" minlength="8" id="password" class="input-box rounded " placeholder="Input Password">
                    </div>
                </div>
                <img src="{{url('assets/profile/'.$user->profile->foto)}}" alt="" width="10%">
                <div class="wfull">
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="input-box rounded border" style="border-color: gray;">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="py-3 px-4 text-center text-white bg-red-600 border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Simpan</button>
            </div>
        </form>
    </div>
    <!-- ./profile -->

</div>
<!-- ./wrapper -->
@endsection