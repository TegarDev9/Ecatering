@extends('layouts.topbar')

@section('content')
<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <span class="text-sm text-gray-400">
        <i class="fas fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Checkout</p>
</div>
<!-- ./breadcrumb -->

<!-- wrapper -->
<form action="{{route('checkout-store')}}" method="post">
    <div class="container grid grid-cols-12 items-start pb-16 pt-4 gap-6">
        @csrf
        <div class="col-span-8 border border-gray-200 p-4 rounded">
            <h3 class="text-lg font-medium capitalize mb-4">Checkout</h3>
            <div class="space-y-4">
                <div>
                    <label for="pesan" class="text-gray-600">Detail Lokasi</label>
                    <textarea rows="4" name="lokasi" class="input-box" style="border-color: gray;" required></textarea>
                </div>
            </div>
        </div>

        <div class="col-span-4 border border-gray-200 p-4 rounded">
            <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">Detail Order</h4>
            <div class="space-y-2 mb-6" id="sub-total">
                @php $total = 0; @endphp
                @foreach($data as $ps)
                @php $total += $ps->product->price * $ps->quantity ; @endphp
                <div class="flex justify-between mb-2">
                    <div>
                        <h5 class="text-gray-800 font-medium">{{$ps->product->nama}}</h5>
                    </div>
                    <p data-sub-id="{{$ps->id}}" class="sub-quantity text-gray-600">
                        x{{$ps->quantity}}
                    </p>
                    <p data-sub-id="{{$ps->id}}" class="sub-total text-gray-800 font-medium">Rp. {{number_format($ps->product->price * $ps->quantity, 0, ",", ".")}}</p>
                </div>
                @endforeach
            </div>
            <hr>
            <div class=" flex justify-between text-gray-800 font-medium py-3 uppercas">
                <p class="font-semibold">Total</p>
                <input type="hidden" name="total" value="{{$total}}">
                <p id="total-all">Rp. {{number_format($total, 0, ",", ".")}}</p>
            </div>

            <div class="flex items-center mb-4 mt-2">
                <input type="checkbox" name="aggrement" id="aggrement" class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3">
                <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer text-sm">I agree to the <a href="#" class="text-primary">terms & conditions</a></label>
            </div>

            <button type="submit" class="block w-full py-3 px-4 text-center text-white bg-red-600 border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Bayar</button>

        </div>
</form>
</div>
<!-- ./wrapper -->

@endsection