@extends('layouts.topbar')

@section('content')
<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <span class="text-sm text-gray-400">
        <i class="fas fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Product</p>
</div>
<!-- ./breadcrumb -->

<!-- product-detail -->
<div class="container grid grid-cols-2 gap-6">
    @php $image = $produk->product_galleries[0]['foto']; $rating = ($produk->nilai != null ) ? round($produk->nilai, 2) : 0; @endphp
    <div>
        <img src="{{ url('assets/produk',$image)}}" id="gambarUtama" alt="product" class="w-full">
        <div class="grid grid-cols-5 gap-4 mt-4">
            @foreach($produk->product_galleries as $gambar)
            <img src="{{ url('assets/produk',$gambar->foto)}}" alt="product2" class="gambar w-full cursor-pointer border border-primary" style="height: 70px;">
            @endforeach
        </div>
    </div>

    <div>
        <h2 class="text-3xl font-medium uppercase mb-2">{{$produk->nama}}</h2>
        <div class="flex items-center mb-4">
            <div class="flex gap-1 text-sm text-yellow-400">
                <span><i class="{{($rating <= 0) ? 'far fa-star' : (($rating > 0 && $rating < 1 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating <= 1) ? 'far fa-star' : (($rating > 1 && $rating < 2 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating <= 2) ? 'far fa-star' : (($rating > 2 && $rating < 3 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating <= 3) ? 'far fa-star' : (($rating > 3 && $rating < 4 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating <= 4) ? 'far fa-star' : (($rating > 4 && $rating < 5 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
            </div>
            <div class="text-xs text-gray-500 ml-3">({{$rating}})</div>
        </div>
        <div class="space-y-2">
            <p class="text-gray-800 font-semibold space-x-2">
                <span>Status: </span>
                @if($produk->stok != 0)
                <span class="text-green-600">Tersedia</span>
                @else
                <span class="text-red-600">Tidak Tersedia</span>
                @endif
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">customer: </span>
                <span class="text-gray-600">{{$produk->customer->nama_toko}}</span>
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">Kategori: </span>
                <span class="text-gray-600">{{$produk->jenis}}</span>
            </p>
        </div>
        <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
            <p class="text-xl text-primary font-semibold">Rp. {{number_format($produk->price, 0, ",", ".")}}</p>
        </div>

        <form action="{{route('pesanan-store')}}" method="post">
            @csrf   
            <input type="hidden" name="id" value="{{$produk->id}}">
            <div class="mt-4">
                <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
                <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                    <button type="button" id="minus" class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">-</button>
                    <input id="quantity" name="quantity" class="h-8 w-14 text-base flex items-center justify-center text-center" value="1" min="1">
                    <button type="button" id="plus" class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">+</button>
                </div>
            </div>

            <div class="mt-6 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                @if($produk->stok != 0)
                <button type="submit" class="bg-red-600 border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">
                    <i class="fas fa-shopping-cart"></i> Add to cart
                </button>
                @else
                <button disabled class="bg-red-300 border border-red-300  text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 ">
                    <i class="fas fa-shopping-cart"></i> Add to cart
                </button>
                @endif
                <a href="{{route('favorit-create',$produk->id)}}" class="border {{($favorit == null) ? 'border-gray-300 text-gray-600' : 'border-red-300 text-red-600' }}  px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-primary transition">
                    <i class="fas fa-heart"></i>Favorit
                </a>
            </div>
        </form>
    </div>
</div>
<!-- ./product-detail -->

<!-- description -->
<div class="container pb-16">
    <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 mt-6 text-xl bold ">Product details</h3>
    <div class="w-3/5 pt-6">
        <div class="text-gray-600">
            <p>{!! $str = preg_replace("/\r?\n/", "<br>", $produk->deskripsi_barang) !!}</p>
        </div>
    </div>
</div>
<!-- ./description -->

<!-- related product -->
<div class="container pb-16">
    <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Review Products</h2>
    @foreach($ratings as $data)
    @php $rating_review = ($data->ratings->rating != null ) ? round($data->ratings->rating, 2) : 0; @endphp
    <div class="flex border gap-6 p-4 border-gray-200 rounded mb-3">
        <div class="w-14 h-12">
            <img src="{{url('assets/profile/',$data->transaksi->user->profile->foto)}}" alt="product 6" class="image-top">
        </div>
        <div class="w-full items-center justify-between ">
            <h2 class="text-gray-800 text-xl font-medium uppercase">{{$data->transaksi->user->profile->nama}}</h2>
            <div class="flex gap-1 text-sm text-yellow-400">
                <span><i class="{{($rating_review <= 0) ? 'far fa-star' : (($rating_review > 0 && $rating_review < 1 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating_review <= 1) ? 'far fa-star' : (($rating_review > 1 && $rating_review < 2 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating_review <= 2) ? 'far fa-star' : (($rating_review > 2 && $rating_review < 3 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating_review <= 3) ? 'far fa-star' : (($rating_review > 3 && $rating_review < 4 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
                <span><i class="{{($rating_review <= 4) ? 'far fa-star' : (($rating_review > 4 && $rating_review < 5 ) ? 'fas fa-star-half-alt' : 'fas fa-star')}}"></i></span>
            </div>
            <p>{!! $str = preg_replace("/\r?\n/", "<br>", $data->ratings->review) !!}</p>
        </div>
    </div>
    @endforeach
</div>
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('#minus').on('click', function() {
                let stok = $('#quantity').val();
                if (stok > 1) {
                    $("#quantity").val(stok -= 1);
                } else {
                    $("#quantity").val('1');
                }
            });
        });

        $(function() {
            $('#quantity').on('keyup', function() {
                let id = $('#quantity').val();
                if (id >= <?= $produk->stok ?>) {
                    $("#quantity").val(<?= $produk->stok ?>);
                } else if (id == '') {
                    $("#quantity").val();
                }
            })
        });

        $(function() {
            $('#plus').on('click', function() {
                let stok = $('#quantity').val();
                let plus = parseInt(stok) + 1;
                if (stok >= <?= $produk->stok ?>) {
                    $("#quantity").val(<?= $produk->stok ?>);
                } else {
                    $("#quantity").val(plus);
                }
            });
        });

        $(function() {
            $(".gambar").click(function() {
                var gambarSrc = $(this).attr("src");
                $("#gambarUtama").attr("src", gambarSrc);
            });
        });
    });
</script>
<!-- ./related product -->

@endsection