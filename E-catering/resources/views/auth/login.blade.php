@extends('layouts.topbar')

@php $title = 'Login' @endphp
@section('content')
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: '{{session("error")}}',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

<!-- login -->
<div class="contain py-16">
    <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
        <img src="{{ url('assets/user/images/logo2.png')}}" alt="Logo" class="w-25 img-center">
        <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
        <p class="text-gray-600 mb-6 text-sm">
            welcome back customer
        </p>
        <form method="POST" action="{{ route('login') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="space-y-2">
                <div>
                    <label for="username" class="text-gray-600 mb-2 block">Username</label>
                    <input type="text" name="username" id="username" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="riski">
                </div>
                <div>
                    <label for="password" class="text-gray-600 mb-2 block">Password</label>
                    <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                    <label for="remember" class="text-gray-600 ml-3 cursor-pointer">Remember me</label>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="block w-full py-2 text-center text-white bg-red-600 border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Login</button>
            </div>
        </form>

        <p class="mt-4 text-center text-gray-600">Belum Punya Akun? <a href="{{ url('register') }}" class="text-primary">Register</a></p>
    </div>
</div>
<!-- ./login -->
@endsection