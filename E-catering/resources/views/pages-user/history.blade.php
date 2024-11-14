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
                <a href="{{route('profile')}}" class="relative hover:text-red-600 block capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-user"></i>
                    </span>
                    Profile
                </a>
                <a href="{{route('profile')}}" class="relative hover:text-red-600 block transition">
                    Detail Profile
                </a>
                <a href="{{route('profile-edit',Auth::user()->id)}}" class="relative hover:text-red-600 block transition">
                    Edit Profile
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="{{route('history')}}" class="relative text-red-600 block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fas fa-archive"></i>
                    </span>
                    My order history
                </a>
                <a href="{{route('belum_dibayar')}}" class="relative {{($title == 'Belum Dibayar') ? 'text-red-600' : 'hover:text-red-600' }} block capitalize transition">
                    Belum Dibayar
                </a>
                <a href="{{route('history')}}" class="relative {{($title == 'diproses') ? 'text-red-600' : 'hover:text-red-600' }} block capitalize transition">
                    Diproses
                </a>
                <a href="{{route('dikirim')}}" class="relative {{($title == 'dikirim') ? 'text-red-600' : 'hover:text-red-600' }} hover:text-red-600 block capitalize transition">
                    Dikirim
                </a>
                <a href="{{route('diterima')}}" class="relative {{($title == 'diterima') ? 'text-red-600' : 'hover:text-red-600' }} hover:text-red-600 block capitalize transition">
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

    <!-- history -->
    <div class="col-span-9 space-y-4">
        <div class="col-span-9 space-y-4">
            @if(count($history) != null)
            @foreach($history as $data)
            <div data-id="{{$data->id}}" class="detail w-full flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                <div class="w-28">
                    <img src="{{ url('assets/produk',$data->detail_transaksi[0]->product->product_galleries[0]->foto)}}" alt=" product 6" style="height: 80px;" class="w-full">
                </div>
                <div class="w-1/3">
                    <h2 class="text-gray-800 text-xl font-medium uppercase">{{$data->detail_transaksi[0]->product->nama}}</h2>
                    <p class="text-gray-500 text-sm">{{$data->tanggal}}</p>
                </div>
                <div class="text-primary text-lg font-semibold">Rp. {{number_format($data->total, 0, ",", ".")}}</div>

                @if($data->payment_status == 'waiting' || $data->payment_status == 'pending')
                <a href="{{$data->midtrans_url}}" class="px-6 py-2 text-center text-sm text-white bg-red-600 border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Bayar</a>
                @else
                <div class="px-6 py-2 bg-transparent"></div>
                @endif

                @if($data->status == 'Dikirim')
                <a href="{{route('history-edit',$data->id )}}" class="px-6 py-2 text-center text-sm text-white bg-red-600 border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Diterima</a>
                @else
                <div class="px-6 py-2 bg-transparent"></div>
                @endif

                @if($data->detail_transaksi[0]->ratings == null && $data->status == 'Diterima')
                <a href="{{route('rating-show',$data->id )}}" class="text-gray-600 cursor-pointer hover:text-primary"><i class="fas fa-star"></i>
                </a>
                @endif

            </div>
            @endforeach
            @else
            <div class="text-center pt-5 pt-4">
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon src="https://cdn.lordicon.com/cllunfud.json" trigger="hover" colors="outline:#121331,primary:#646e78,secondary:#ebe6ef" style="width:190px;height:190px">
                </lord-icon>
                <h4 class="pt-2">Pesananmu kosong nih !!</h4>
                <p>Yuk Pesan Sekarang</p>
                <br>
            </div>
            @endif
        </div>
    </div>
    <!-- ./history -->

</div>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fungsi untuk menambah quantity pesanan
        $(function() {
            $('.detail').on('click', function() {
                var id = $(this).data('id');
                window.location.replace("{{url('history')}}/" + id);
            });
        });
    });
</script>
<!-- ./wrapper -->
@endsection