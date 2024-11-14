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
                <form method="POST" action="{{ route('produk-update',$data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputBarang">Nama Barang</label>
                        <input type="text" class="form-control" id="exampleInputBarang" name="nama" placeholder="Input Barang" required value="{{$data->nama}}">
                    </div>
                    @if(Auth::user()->role == 'merchant')
                    <div class="form-group">
                        <label for="exampleInputcustomer">customer</label>
                            <select class="custom-select rounded-0" id="exampleInputcustomer" name="customer_id" required>
                                <option value="">--- Pilih customer---</option>
                                @foreach($customer as $customer)
                                <option value="{{$customer->id}}" {{($data->customer_id == $customer->id) ? 'selected' : ''}}>{{$customer->nama_toko}}</option>
                                @endforeach
                            </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputJenisMakanan">Jenis Makanan</label>
                        <select class="custom-select rounded-0" id="exampleInputJenisMakanan" name="jenis" required>
                            <option value="">--- Pilih Jenis Makanan ---</option>
                            <option value="Makanan" {{($data->jenis == "Makanan") ? 'selected' : ''}}>Makanan</option>
                            <option value="Minuman" {{($data->jenis == "Minuman") ? 'selected' : ''}}>Minuman</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStok">Stok Lama</label>
                        <input type="text" class="form-control" id="exampleInputStok" name="stok" placeholder="Input Stok" readonly value="{{$data->stok}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStok">Tambah Stok</label>
                        <input type="number" class="form-control" id="exampleInputStok" name="tambah_stok" placeholder="Input Stok Baru" value="0">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStok">Kurangi Stok</label>
                        <input type="number" class="form-control" id="exampleInputStok" name="kurang_stok" placeholder="Input Stok Baru" value="0">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputHarga">Harga/Pcs</label>
                        <input type="number" class="form-control" id="exampleInputHarga" name="price" placeholder="Input Harga" value="{{$data->price}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDeskripsiBarang">Deskripsi Barang</label>
                        <textarea class="form-control" id="exampleInputDeskripsiBarang" rows="4" placeholder="Deskripsi Barang" name="deskripsi_barang" required>{{$data->deskripsi_barang}}</textarea>
                    </div>

                    <div style="display:flex; text-align:left;">
                        @foreach($product_gallery as $gallery)
                        <span style="text-align:center;"><img src="{{url('assets/produk/'.$gallery->foto)}}" alt="" width="50%"><br><a href="{{route('hapus_gallery',$gallery->id.'-'.$data->id)}}" class="text-danger">Hapus</a></span>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Input Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="form-control" multiple name="foto[]" id="exampleInputFile">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection