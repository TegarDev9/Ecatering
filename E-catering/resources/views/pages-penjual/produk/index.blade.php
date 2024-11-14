@extends('layouts.sidebar')

@section('content')

@foreach($errors->all() as $error)
<script>
    Swal.fire({
        icon: 'error',
        title: '<?= $error ?>',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endforeach
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card mb-3">
            <div class="card-body">
                <button class="btn btn-primary mb-3" onclick="show('<?= route('produk-create') ?>')"><i class="fas fa-plus"></i></i>&nbsp; Tambah Data</button>
                <div class="card-header">
                    <a href="{{route('produk-pdf')}}" class="btn btn-danger btn-md"> Export To PDF</a>
                    <a href="{{route('produk-excel')}}" class="btn btn-success btn-md"> Export To Excel</a>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Barang</th>
                            <th>stok</th>
                            <th>Harga/pcs</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach($data as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td><img alt="Avatar" width="50" src="{{url('assets/produk/',$data->product_galleries[0]->foto)}}"></td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->stok}}</td>
                            <td>Rp. {{number_format($data->price, 0, ",", ".")}}</td>
                            <td style="width: 230px;">
                                <a class="btn btn-info btn-sm mt-1" href="{{route('produk-edit', $data->id)}}"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Edit</a>
                                <a class="btn btn-danger btn-sm mt-1" onclick="notificationforDelete(event, this)" href="{{route('produk-hapus',$data->id)}}"><i class="fas fa-trash"></i>&nbsp;&nbsp; Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection