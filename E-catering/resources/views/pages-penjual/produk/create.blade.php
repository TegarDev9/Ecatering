<div class="modal-header">
    <h4 class="modal-title">Tambah Barang</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('produk-store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputBarang">Nama Barang</label>
            <input type="text" class="form-control" id="exampleInputBarang" name="nama" placeholder="Input Barang" required>
        </div>

        @if(Auth::user()->role == 'merchant')
        <div class="form-group">
            <label for="exampleInputcustomer">customer</label>
            <select class="custom-select rounded-0" id="exampleInputcustomer" name="customer_id" required>
                <option value="">--- Pilih customer---</option>
                @foreach($customer as $customer)
                <option value="{{$customer->id}}">{{$customer->nama_toko}}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="form-group">
            <label for="exampleInputJenisMakanan">Jenis Makanan</label>
            <select class="custom-select rounded-0" id="exampleInputJenisMakanan" name="jenis" required>
                <option value="">--- Pilih Jenis Makanan ---</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputStok">Stok</label>
            <input type="number" class="form-control" id="exampleInputStok" name="stok" placeholder="Input Stok" required>
        </div>
        <div class="form-group">
            <label for="exampleInputHarga">Harga/Pcs</label>
            <input type="number" class="form-control" id="exampleInputHarga" name="price" placeholder="Input Harga" required>
        </div>
        <div class="form-group">
            <label for="exampleInputDeskripsiBarang">Deskripsi Barang</label>
            <textarea class="form-control" id="exampleInputDeskripsiBarang" rows="4" placeholder="Deskripsi Barang" name="deskripsi_barang" required></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Input Gambar</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="form-control" required multiple name="foto[]" id="exampleInputFile">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </form>
</div>