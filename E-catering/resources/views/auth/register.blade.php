@extends('layouts.topbar')

@php $title = 'Register' @endphp
@section('content')
@foreach($errors->all() as $error)
<script>
    Swal.fire({
        icon: 'error',
        title: '<?= $error ?>',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endforeach


<!-- login -->
<div class="contain py-16">
    <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
        <img src="{{ url('assets/user/images/logo2.png')}}" alt="Logo" class="w-25 img-center">
        <h2 class="text-2xl uppercase font-medium mb-1">Create an account</h2>
        <p class="text-gray-600 mb-6 text-sm">
            Register for new cosutumer
        </p>
        <form method="POST" action="{{ route('register') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="space-y-2">
                <div>
                    <label for="name" class="text-gray-600 mb-2 block">Nama Lengkap</label>
                    <input type="text" name="nama" id="name" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="fulan fulana">
                </div>
                <div>
                    <label for="username" class="text-gray-600 mb-2 block">Username</label>
                    <input type="text" name="username" id="username" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="riski">
                </div>
                <div>
                    <label for="email" class="text-gray-600 mb-2 block">Email</label>
                    <input type="email" name="email" id="email" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="youremail.@domain.com">
                </div>
                <div>
                    <label for="password" class="text-gray-600 mb-2 block">Password</label>
                    <input type="password" name="password" id="password" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                </div>
                <div>
                    <label for="confirm" class="text-gray-600 mb-2 block">Confirm password</label>
                    <input type="password" name="password_confirmation" id="confirm" class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400" placeholder="*******">
                </div>
            </div>
            <div class="mt-6">
                <div class="flex items-center">
                    <input type="checkbox" name="aggrement" id="aggrement" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                    <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer">I have read and agree to the <a href="#" class="text-primary">terms & conditions</a></label>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="block w-full py-2 text-center text-white bg-red-600 border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                    Register</button>
            </div>
        </form>

        <p class="mt-4 text-center text-gray-600">Sudah Punya Akun? <a href="{{ url('login') }}" class="text-primary">Register</a></p>
    </div>
</div>
<!-- ./login -->
@endsection