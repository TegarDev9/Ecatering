<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3 align="center">Data Product</h3>
    
    <table border="1" cellpadding="10" align="center">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jenis Produk</th>
            <th>Harga/pcs</th>
            <th>Stok</th>
            <th>Deskripsi Produk</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1 @endphp
        @foreach($data as $data)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->jenis}}</td>
            <td>Rp. {{number_format($data->price, 0, ",", ".")}}</td>
            <td>{{$data->stok}}</td>
            <td>{{$data->deskripsi_barang}}</td>
            
        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>