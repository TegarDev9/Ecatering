<div class="modal-header">
    <h4 class="modal-title">Detail Transaksi</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <table>
        <tr>
            <td><b>Custumer</b></td>
            <td style="padding : 5px;">:</td>
            <td>{{$data->user->profile->nama}}</td>
        </tr>
        <tr>
            <td><b>Total</b></td>
            <td style="padding : 5px;">:</td>
            <td>Rp. {{number_format($data->total, 0, ",", ".")}}</td>
        </tr>
        <tr>
            <td><b>Lokasi</b></td>
            <td style="padding : 5px;">:</td>
            <td>{{$data->lokasi}}</td>
        </tr>
    </table>

    <table id="example1" class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Product</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @php $x=1 @endphp
            @foreach($data->detail_transaksi as $dt)
            <tr>
                <td>{{$x++}}</td>
                <td><img alt="Avatar" width="50" src="{{url('assets/produk',$dt->product->product_galleries[0]->foto)}}"></td>
                <td>{{$dt->product->nama}}</td>
                <td>{{$dt->quantity}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    </div>
</div>