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
                <form method="POST" action="{{ route('customer-update',$data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputNama">Nama customer</label>
                        <input type="text" class="form-control" id="exampleInputNama" name="nama" placeholder="Input Nama customer" value="{{$data->profile->nama}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNamaToko">Nama Toko</label>
                        <input type="text" class="form-control" id="exampleInputNamaToko" name="nama_toko" placeholder="Input Nama Toko" value="{{$data->customer->nama_toko}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="Input Email" required value="{{$data->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername" name="username" placeholder="Input Username" required value="{{$data->username}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNoTelp">No Telp</label>
                        <input type="number" class="form-control" id="exampleInputNoTelp" name="no_telp" placeholder="Input No Telp" required value="{{$data->profile->no_telp}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDeskripsi">Deskripsi</label>
                        <textarea class="form-control" id="exampleInputDeskripsi" rows="4" placeholder="Deskripsi Toko" name="deskripsi_toko" required>{{$data->customer->deskripsi_toko}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection