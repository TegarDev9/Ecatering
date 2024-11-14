@extends('layouts.topbar')

@section('content')
<!-- breadcrumb -->
<div class="container py-4 flex items-center gap-3">
    <span class="text-sm text-gray-400">
        <i class="fas fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Bayar</p>
</div>
<!-- ./breadcrumb -->

<div class="col-span-4 border border-gray-200 p-4 rounded">
    <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">Detail Order</h4>
    <div class="space-y-2 mb-6" id="sub-total">
        @php $total = 0; @endphp
        @foreach($data as $ps)
        @php $total += $ps->product->price * $ps->quantity; @endphp
        <div class="flex justify-between mb-2">
            <div>
                <h5 class="text-gray-800 font-medium">{{ $ps->product->nama }}</h5>
            </div>
            <p data-sub-id="{{ $ps->id }}" class="sub-quantity text-gray-600">
                x{{ $ps->quantity }}
            </p>
            <p data-sub-id="{{ $ps->id }}" class="sub-total text-gray-800 font-medium">Rp. {{ number_format($ps->product->price * $ps->quantity, 0, ",", ".") }}</p>
        </div>
        @endforeach
    </div>
    <hr>
    <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
        <p class="font-semibold">Total</p>
        <input type="hidden" name="total" value="{{ $total }}">
        <p id="total-all">Rp. {{ number_format($total, 0, ",", ".") }}</p>
    </div>
</div>

<div class="container">
    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=Ad59Seev0o9FLVtKeIpk57cwzfoq4muwnHGuH5SMsl0sZO-tP277HSxJp4QUoaKpSyjqZIO4ijO46Tmk&currency=USD"></script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <script>
        // Menggunakan Blade directive untuk menyisipkan nilai total
        let total = @json($total);

        paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
            purchase_units: [{
                amount: {
                    value: total.toString() // Pastikan nilai total dikonversi ke string
                }
            }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                window.location.href = 'http://127.0.0.1:8000/bayarsukses';
            });
        }
        }).render('#paypal-button-container');
    </script>
</div>
<!-- ./wrapper -->

@endsection
