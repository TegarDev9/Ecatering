@extends('layouts.topbar')

@section('content')
<!-- banner -->
<div class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('<?= url("assets/user/images/banner.png") ?>');">
    <div class="container">
        <h1 class="text-6xl text-gray font-medium mb-4 capitalize">
            best collection for <br> home decoration
        </h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam <br>
            accusantium perspiciatis, sapiente
            magni eos dolorum ex quos dolores odio</p>
        <div class="mt-12">
            <a href="{{route('katalog_produk')}}" class="bg-red-600 border border-primary text-white px-8 py-3 font-medium 
                    rounded-md hover:bg-red-400  hover:text-white">Beli Sekarang</a>
        </div>
    </div>
</div>
<!-- ./banner -->

<!-- categories -->
<div class="container py-16">
    <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Kategori Produk</h2>
    <div class="grid grid-cols-2 gap-3">
        <div class="relative rounded-sm overflow-hidden group">
            <img src="{{ url('assets/user/images/category/kategori6.jpg')}}" alt="category 1" class="w-full">
            <a href="#" class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">Makanan</a>
        </div>
        <div class="relative rounded-sm overflow-hidden group">
            <img src="{{ url('assets/user/images/category/kategori7.jpg')}}" alt="category 1" class="w-full">
            <a href="#" class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">Minuman</a>
        </div>
    </div>
</div>
<!-- ./categories -->

<!-- new arrival -->
<div class="container pb-16">
    <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Top Seller</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($produk as $p)
        @php $foto = $p->product_galleries[0]['foto']; @endphp
        <div class="bg-white shadow rounded overflow-hidden group">
            <div class="relative">
                <img src="{{ url('assets/produk',$foto)}}" alt="product 1" style="height: 170px; width: 100%;">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                    <a href="{{route('detail_produk',$p->id)}}" class="text-white text-lg w-9 h-8 rounded-full bg-red-600 flex items-center justify-center hover:bg-gray-800 transition" title="view product"><i class="fas fa-eye"></i>
                    </a>
                    <a href="{{route('favorit-create',$p->id)}}" class="text-white text-lg w-9 h-8 rounded-full bg-red-600 flex items-center justify-center hover:bg-gray-800 transition" title="add to wishlist">
                        <i class="fas fa-heart"></i>
                    </a>
                </div>
            </div>
            <div class="pt-4 pb-3 px-4">
                <a href="{{route('detail_produk',$p->id)}}">
                    <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">{{$p->nama}}</h4>
                </a>
                <div class="flex items-baseline mb-1 space-x-2">
                    <p class="text-xl text-primary font-semibold">Rp. {{number_format($p->price, 0, ",", ".")}}</p>
                </div>
                <div class="flex items-center">
                    <div class="text-xs text-gray-500 ml-3">{{$p->detail_transaksi_count}}X Dibeli</div>
                </div>
            </div>

            @if($p->stok != 0)
            <a href="{{route('pesanan-create',$p->id)}}" class="block w-full py-1 text-center text-white bg-red-600 border border-primary rounded-b hover:bg-transparent hover:text-primary transition">Tambah
                ke Pesanan</a>
            @else
            <button disabled class="block w-full py-1 text-center text-white bg-red-300 border border-red-300 rounded-b">Tambah
                ke Pesanan</button>
            @endif
        </div>
        @endforeach
    </div>
</div>
<!-- ./new arrival -->

<!-- ads -->
<div class="container pb-16">
    <a href="#">
        <img src="{{ url('assets/user/images/offer2.jpg')}}" alt="ads" class="w-full">
    </a>
</div>
<!-- ./ads -->

<!-- product -->
<div class="container pb-16">
    <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Rekomendasi Untuk Kamu</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($rekomendasi as $data)
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
            <button disabled class="block w-full py-1 text-center text-white bg-red-300 border border-red-300 rounded-b">Tambah
                ke Pesanan</button>
            @endif
        </div>
        @endforeach
    </div>
</div>
<!-- ./product -->
@endsection