@extends('layouts.topbar')

@section('content')
<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <span class="text-sm text-gray-400">
        <i class="fas fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Pesanan</p>
</div>
<!-- ./breadcrumb -->

<!-- wrapper -->
<div class="container grid grid-cols-12 items-start pb-16  gap-6">

    <div class="col-span-8  p-4 rounded">
        @if(count($pesanan) != 0)
        @foreach($pesanan as $ps)
        <div class="flex items-center container border gap-6 p-4 pr-12 border-gray-200 rounded  mb-2">
            <div class="w-28">
                <img src="{{url('assets/produk',$ps->product->product_galleries[0]->foto)}}" alt="product 6" style="height: 80px;" class="w-full">
            </div>
            <div class="w-1/3">
                <h2 class="text-gray-800 text-xlfont-medium uppercase">{{$ps->product->nama}}</h2>
                <div class="flex border border-gray-300 mt-2 text-gray-600 divide-x divide-gray-300 w-max">
                    <button data-id="{{$ps->id}}" class="minus h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">-</button>
                    <input data-id="{{$ps->id}}" name="quantity" class="quantity h-8 w-14 text-base flex items-center justify-center text-center" readonly value="{{$ps->quantity}}">
                    <button data-id="{{$ps->id}}" class="plus h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">+</button>
                </div>
            </div>

            <a href="{{route('pesanan-hapus',$ps->id)}}" onclick="notificationforDelete(event, this)" class="text-gray-600 cursor-pointer hover:text-primary" style="margin-left: auto;">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
        @endforeach
        @else
        <div class="text-center pt-4 pt-4">
            <img src="https://media2.giphy.com/media/l3q2z8GufDVOn4XlK/giphy.gif?cid=ecf05e472g9rcaoy4jboufn90j31xhe87zfwfw6lkujgnd8g&rid=giphy.gif&ct=g" width="40%" class="rounded" style="margin-left: auto; margin-right:auto;" alt="...">
            <h4 class="pt-4">Pesananmu kosong nih !!</h4>
            <p>Yuk Order Sekarang</p>
            <br>
            <a href="{{ route('katalog_produk') }}" class=" py-3 px-4 text-center text-white bg-red-600 border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Belanja Sekarang</a>
        </div>
        @endif
    </div>

    <div class="col-span-4 border border-gray-200 p-4 rounded">
        <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">Detail Order</h4>
        <div class="space-y-2 mb-6" id="sub-total">
            @php $total = 0; @endphp
            @foreach($pesanan as $ps)
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
            <p id="total-all">Rp. {{number_format($total, 0, ",", ".")}}</p>
        </div>

        @if(count($pesanan) != 0)
        <a href="{{route('checkout')}}" class="block w-full py-3 px-4 text-center text-white bg-red-600 border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Place
            order</a>
        @endif
    </div>

</div>
<!-- ./wrapper -->

<script>
    function formatRupiah(angka) {
        var rupiah = '';
        var angkaRev = angka.toString().split('').reverse().join('');

        for (var i = 0; i < angkaRev.length; i++) {
            if (i % 3 === 0) {
                rupiah += angkaRev.substr(i, 3) + '.';
            }
        }

        return 'Rp ' + rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fungsi untuk menambah quantity pesanan
        $(function() {
            $('.plus').on('click', function() {
                var id = $(this).data('id');
                var quantityElement = $(this).siblings('.quantity');
                var subQuantity = $('.sub-quantity[data-sub-id="' + id + '"]');
                var subTotal = $('.sub-total[data-sub-id="' + id + '"]');
                var quantity = parseInt(quantityElement.val()) + 1;

                $.ajax({
                    url: "{{route('update-quantity')}}",
                    type: 'POST',
                    data: {
                        id: id,
                        action: 'increase'
                    },
                    success: function(response) {
                        quantityElement.val(response.quantity);
                        subQuantity.text('x' + response.quantity);
                        subTotal.text(formatRupiah(response.sub_total));
                        $('#total-all').html(formatRupiah(response.total_all));
                    }
                });
            });
        });

        // Fungsi untuk mengurangi quantity pesanan

        $(function() {
            $('.minus').on('click', function() {
                var id = $(this).data('id');
                var quantityElement = $(this).siblings('.quantity');
                var subQuantity = $('.sub-quantity[data-sub-id="' + id + '"]');
                var subTotal = $('.sub-total[data-sub-id="' + id + '"]');
                var quantity = parseInt(quantityElement.val()) - 1;

                $.ajax({
                    url: "{{route('update-quantity')}}",
                    type: 'POST',
                    data: {
                        id: id,
                        action: 'decrease'
                    },
                    success: function(response) {
                        quantityElement.val(response.quantity);
                        var subQuantity = $('[data-sub-id="' + id + '"]');
                        subQuantity.text('x' + response.quantity);
                        subTotal.text(formatRupiah(response.sub_total));
                        $('#total-all').html(formatRupiah(response.total_all));
                    }
                });
            });
        });
    });
</script>
@endsection