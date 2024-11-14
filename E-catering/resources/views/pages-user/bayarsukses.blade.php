@extends('layouts.topbar')

@section('content')
<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <span class="text-sm text-gray-400">
        <i class="fas fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Bayar Sukses</p>
</div>
<!-- ./breadcrumb -->

<!-- wrapper -->
<div class="container py-4">
    <h2 class="text-center text-2xl font-semibold text-gray-800">Pembayaran Berhasil</h2>
    <p class="text-center text-gray-600 mt-4">Terima kasih atas pembayaran Anda. Pesanan Anda akan segera diproses.</p>
    <div class="flex justify-center mt-6">
        <a href="{{ url('/') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Kembali ke Beranda</a>
    </div>
</div>
<!-- ./wrapper -->

@endsection
