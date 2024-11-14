@extends('layouts.topbar')

@section('content')

<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <span class="text-sm text-gray-400">
        <i class="fas fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Shop</p>
</div>
<!-- ./breadcrumb -->

<!-- shop wrapper -->
<div class="container grid md:grid-cols-4 grid-cols-2 gap-6 pt-4 pb-16 items-start">
    <!-- drawer component -->
    <div id="drawer-example" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
        <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>Info</h5>
        <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="divide-y divide-gray-200 space-y-5">
            <form action="{{route('filter_produk')}}" method="post">

                <div>
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Kategori</h3>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="jenis[]" id="cat-1" value="Makanan" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">Makanan</label>
                            <div class="ml-auto text-gray-600 text-sm">({{$total_makanan}})</div>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="jenis[]" id="cat-2" value="Minuman" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="cat-2" class="text-gray-600 ml-3 cusror-pointer">Minuman</label>
                            <div class="ml-auto text-gray-600 text-sm">({{$total_minuman}})</div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">customer</h3>
                    <div class="space-y-2">
                        @foreach($customer as $data)
                        <div class="flex items-center">
                            <input type="checkbox" name="nama_customer[]" value="{{$data->id}}" id="brand-1" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="brand-1" class="text-gray-600 ml-3 cusror-pointer">{{$data->nama_toko}}</label>
                            <div class="ml-auto text-gray-600 text-sm">({{$data->product_count}})</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Price</h3>
                    <div class="mt-4 flex items-center">
                        <input type="number" name="harga_min" id="min" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="min">
                        <span class="mx-3 text-gray-500">-</span>
                        <input type="number" name="harga_max" id="max" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="max">
                    </div>
                </div>

                <button type="submit" class="block w-full py-1 text-center text-white bg-red-600 border border-primary rounded-md">Filter</button>
        </div>
        </form>
    </div>

    <!-- ./sidebar -->
    <div class="col-span-1 bg-white px-4 pb-6 shadow rounded overflow-hiddenb hidden md:block">
        <form action="{{route('filter_produk')}}" method="post">
            @csrf
            <div class="divide-y divide-gray-200 space-y-5">
                <div>
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Kategori</h3>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="jenis_makanan[]" id="cat-1" value="Makanan" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">Makanan</label>
                            <div class="ml-auto text-gray-600 text-sm">({{$total_makanan}})</div>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="jenis_makanan[]" id="cat-2" value="Minuman" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="cat-2" class="text-gray-600 ml-3 cusror-pointer">Minuman</label>
                            <div class="ml-auto text-gray-600 text-sm">({{$total_minuman}})</div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">customer</h3>
                    <div class="space-y-2">
                        @foreach($customer as $data)
                        <div class="flex items-center">
                            <input type="checkbox" name="nama_customer[]" value="{{$data->id}}" id="brand-1" class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="brand-1" class="text-gray-600 ml-3 cusror-pointer">{{$data->nama_toko}}</label>
                            <div class="ml-auto text-gray-600 text-sm">({{$data->product_count}})</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4">
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Price</h3>
                    <div class="mt-4 flex items-center">
                        <input type="number" name="harga_min" id="min" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="min">
                        <span class="mx-3 text-gray-500">-</span>
                        <input type="number" name="harga_max" id="max" class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm" placeholder="max">
                    </div>
                </div>

                <button type="submit" class="block w-full py-1 text-center text-white bg-red-600 border border-primary rounded-md">Filter</button>
            </div>
        </form>
    </div>
    <!-- products -->
    <div class="col-span-3">
        <div class="flex items-center mb-4">
            <div class="flex ">
                <div class="text-center md:hidden">
                    <button class="text-white hover:bg-red-600 bg-red-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-600 focus:outline-none dark:focus:ring-blue-800 block md:hidden" type="button" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 grid-cols-2 gap-6">
            @foreach($produk as $data)
            @php $image = $data->product_galleries[0]['foto']; $rating = ($data->nilai != null ) ? round($data->nilai, 2) : 0; @endphp
            <div class="bg-white shadow rounded overflow-hidden group">
                <div class="relative">
                    <img src="{{ url('assets/produk',$image)}}" alt="product 1" style="height: 170px; width: 100%;">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                        <a href="{{route('detail_produk',$data->id)}}" class="text-white text-lg w-9 h-8 rounded-full bg-red-600 flex items-center justify-center hover:bg-gray-800 transition" title="view product"><i class="fas fa-eye"></i>
                        </a>
                        <a href="{{route('favorit-create',$data->id)}}" class="text-white text-lg w-9 h-8 rounded-full bg-red-600 flex items-center justify-center hover:bg-gray-800 transition" title="add to wishlist">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>
                <div class="pt-4 pb-3 px-4">
                    <a href="{{route('detail_produk',$data->id)}}">
                        <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">{{$data->nama}}</h4>
                    </a>
                    <div class="flex items-baseline mb-1 space-x-2">
                        <p class="text-xl text-primary font-semibold">Rp. {{number_format($data->price, 0, ",", ".")}}</p>
                    </div>
                    <div class="flex items-center"><i class=""></i>
                        <div class="flex gap-1 text-sm text-yellow-400">
                            <span><i class="{{($rating <= 0) ? 'far fa-star' : (($rating > 0 && $rating < 1 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                            <span><i class="{{($rating <= 1) ? 'far fa-star' : (($rating > 1 && $rating < 2 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                            <span><i class="{{($rating <= 2) ? 'far fa-star' : (($rating > 2 && $rating < 3 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                            <span><i class="{{($rating <= 3) ? 'far fa-star' : (($rating > 3 && $rating < 4 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                            <span><i class="{{($rating <= 4) ? 'far fa-star' : (($rating > 4 && $rating < 5 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                        </div>
                        <div class="text-xs text-gray-500 ml-3">({{$rating}})</div>
                    </div>
                </div>
                @if($data->stok != 0)
                <a href="{{route('pesanan-create',$data->id)}}" class="block w-full py-1 text-center text-white bg-red-600 border border-primary rounded-b hover:bg-transparent hover:text-primary transition">Tambah
                    ke Pesanan</a>
                @else
                <button disabled class="block w-full py-1 text-center text-white bg-red-300 border border-red-300 rounded-b ">Tambah
                    ke Pesanan</button>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- ./products -->
</div>
<!-- ./shop wrapper -->
@endsection