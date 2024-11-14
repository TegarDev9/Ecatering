<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkasi PDF</title>
</head>
<body>
<h3 align="center">Data Transaksi</h3>
    
    <!-- tabel diproses  -->
    <h2>Diproses</h2>
    <table border="1" cellpadding="10" align="center">
    <thead>
        <tr>
            <th>No</th>
            <th>Pembeli</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1 @endphp
        @foreach($diproses as $diproses) <tr>
            <td>{{$x++}}</td>
            <td>{{$diproses->nama}}</td>
            <td>{{$diproses->tanggal}}</td>
            @if($diproses->payment_status == 'waiting')
            <td><font color="red">Belum Dibayar</font></td>
            @else
            <td ><font color="green">Lunas</font></td>
            @endif
            <td>Rp. {{number_format($diproses->total, 0, ",", ".")}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>

    <!-- tabel dikirim  -->
    <h2>Dikirim</h2>
    <table border="1" cellpadding="10" align="center">
    <thead>
        <tr>
            <th>No</th>
            <th>Pembeli</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1 @endphp
        @foreach($dikirim as $dikirim) <tr>
            <td>{{$x++}}</td>
            <td>{{$dikirim->nama}}</td>
            <td>{{$dikirim->tanggal}}</td>
            @if($dikirim->payment_status == 'waiting')
            <td><font color="red">Belum Dibayar</font></td>
            @else
            <td><font color="green">Lunas</font></td>
            @endif
            <td>Rp. {{number_format($dikirim->total, 0, ",", ".")}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>

    <!-- tabel diterima  -->
    <h2>Diterima</h2>
    <table border="1" cellpadding="10" align="center">
    <thead>
        <tr>
            <th>No</th>
            <th>Pembeli</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $x=1 @endphp
        @foreach($diterima as $data) <tr>
            <td>{{$x++}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->tanggal}}</td>
            @if($data->payment_status == 'waiting')
            <td><font color="red">Belum Dibayar</font></td>
            @else
            <td><font color="green">Lunas</font></td>
            @endif
            <td>Rp. {{number_format($data->total, 0, ",", ".")}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>