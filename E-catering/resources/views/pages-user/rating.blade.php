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
                <a href="#" class="relative hover:text-red-600 block capitalize transition">
                    Manage account
                </a>
                <a href="#" class="relative hover:text-red-600 block capitalize transition">
                    Profile information
                </a>
                <a href="#" class="relative hover:text-red-600 block capitalize transition">
                    Manage addresses
                </a>
                <a href="#" class="relative hover:text-red-600 block capitalize transition">
                    Change password
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="{{route('history')}}" class="relative text-red-600 block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-archive"></i>
                    </span>
                    My order history
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
    <!-- history -->
    <div class="col-span-9 space-y-4">
        <form action="{{route('rating-store')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$rating->id}}">
            <div class="col-span-9 space-y-4">
                @foreach($rating->detail_transaksi as $data)
                <div class="border gap-6 p-4 border-gray-200 rounded">
                    <div class="flex mb-4 items-center  ">
                        <div class="w-28">
                            <img src="{{ url('assets/produk',$data->product->product_galleries[0]->foto)}}" alt=" product 6" style="height: 80px;" class="w-full">
                        </div>
                        <div class="w-1/3 ml-4">
                            <h2 class="text-gray-800 text-xl font-medium uppercase">{{$data->product->nama}}</h2>
                            <p class="text-gray-500 text-sm">{{$data->transaksi->tanggal}}</p>
                        </div>
                        <div class="rating" style="margin-left: auto;">
                            <input type="radio" id="star5_{{$data->id}}" name="rating_{{$data->id}}" required value="5">
                            <label class="full" for="star5_{{$data->id}}"></label>
                            <input type="radio" id="star4_{{$data->id}}" name="rating_{{$data->id}}" required value="4">
                            <label class="full" for="star4_{{$data->id}}"></label>
                            <input type="radio" id="star3_{{$data->id}}" name="rating_{{$data->id}}" required value="3">
                            <label class="full" for="star3_{{$data->id}}"></label>
                            <input type="radio" id="star2_{{$data->id}}" name="rating_{{$data->id}}" required value="2">
                            <label class="full" for="star2_{{$data->id}}"></label>
                            <input type="radio" id="star1_{{$data->id}}" name="rating_{{$data->id}}" required value="1">
                            <label class="full" for="star1_{{$data->id}}"></label>
                        </div>
                    </div>

                    <div style="display: block;">
                        <label for="review" class="text-gray-600">Review</label>
                        <textarea rows="4" name="review_{{$data->id}}" id="review" class="input-box" placeholder="Input Review" style="border-color: gray;"></textarea>
                    </div>

                </div>
                @endforeach
                <button class="px-6 py-2 text-center text-sm text-white bg-red-600 border border-red-600 rounded" style="float: right;">Simpan</button>
            </div>
        </form>
    </div>
    <!-- ./history -->

</div>
<!-- ./wrapper -->
@endsection