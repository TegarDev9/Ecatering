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
                <a href="{{route('belum_dibayar')}}" class="relative {{($detail->payment_status == 'waiting') ? 'text-red-600' : 'hover:text-red-600' }} block capitalize transition">
                    Belum Dibayar
                </a>
                <a href="{{route('history')}}" class="relative {{($detail->payment_status != 'waiting' && $detail->status == 'Diproses') ? 'text-red-600' : 'hover:text-red-600' }} block capitalize transition">
                    Diproses
                </a>
                <a href="{{route('dikirim')}}" class="relative {{($detail->payment_status != 'waiting' && $detail->status == 'Dikirim') ? 'text-red-600' : 'hover:text-red-600' }} hover:text-red-600 block capitalize transition">
                    Dikirim
                </a>
                <a href="{{route('diterima')}}" class="relative {{($detail->payment_status != 'waiting' && $detail->status == 'Diterima') ? 'text-red-600' : 'hover:text-red-600' }} hover:text-red-600 block capitalize transition">
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

    <!-- detail -->
    <div class="col-span-9 space-y-4">
        <div class="col-span-9 space-y-4">
            <div class="border gap-6 p-4 border-gray-200 rounded">
                <table>
                    <tr>
                        <td>
                            <p style="font-size: 18px; font-weight: bold;">Tanggal</p>
                        </td>
                        <td style="width: 20px; text-align: center;">
                            <p style="font-size: 18px; ">:</p>
                        </td>
                        <td>
                            <p style="font-size: 18px; ">{{$detail->tanggal}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size: 18px; font-weight: bold;">Total Transaksi</p>
                        </td>
                        <td style="width: 20px; text-align: center;">
                            <p style="font-size: 18px; ">:</p>
                        </td>
                        <td>
                            <p style="font-size: 18px; ">Rp. {{number_format($detail->total, 0, ",", ".")}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size: 18px; font-weight: bold;">Status</p>
                        </td>
                        <td style="width: 20px; text-align: center;">
                            <p style="font-size: 18px; ">:</p>
                        </td>
                        <td>
                            <p class="box-status">{{$detail->status}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size: 18px; font-weight: bold;">Detail Lokasi</p>
                        </td>
                        <td style="width: 20px; text-align: center;">
                            <p style="font-size: 18px; ">:</p>
                        </td>
                        <td style="width: 50%;">
                            <p style="font-size: 18px; ">{{$detail->lokasi}}</p>
                        </td>
                    </tr>
                </table>
            </div>
            <p style="font-size: 18px; font-weight: bold; margin-left: 1rem;">Detail Produk</p>
            @foreach($detail->detail_transaksi as $data)
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                <div class="w-28">
                    <img src="{{ url('assets/produk',$data->product->product_galleries[0]->foto)}}" alt=" product 6" style="height: 80px;" class="w-full">
                </div>
                <div class="w-1/3">
                    <h2 class="text-gray-800 text-xl font-medium uppercase">{{$data->product->nama}} x{{$data->quantity}}</h2>
                    <p class="text-gray-500 text-sm">Availability:
                        @if($data->product->stok != 0)
                        <span class="text-green-600">Tersedia</span>
                        @else
                        <span class="text-red-600">Tidak Tersedia</span>
                        @endif
                    </p>
                </div>
                <div class="text-primary text-lg font-semibold">Rp. {{number_format($data->product->price * $data->quantity, 0, ",", ".")}}</div>

                @if($data->product->stok != 0)
                <a href="{{route('pesanan-create',$data->product_id )}}" class="px-6 py-2 text-center text-sm text-white bg-red-600 border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">add
                    to cart</a>
                @else
                <button disabled class="px-6 py-2 text-center text-sm text-white bg-red-300 border border-red-300 rounded">add
                    to cart</button>
                @endif

            </div>
            @endforeach
        </div>
    </div>
    <!-- ./history -->

</div>
<!-- ./wrapper -->
@endsection