<div class="modal-header">
    <h4 class="modal-title">Tambah customer</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
<div class="modal-body">
    <form method="POST" action="{{ route('customer-store') }}" enctype="multipart/form-data" onsubmit="return cekdata()">
        @csrf
        <div class="form-group">
            <label for="exampleInputNama">Nama customer</label>
            <input type="text" class="form-control" id="exampleInputNama" name="nama" placeholder="Input Nama customer" required>
        </div>
        <div class="form-group">
            <label for="exampleInputNamaToko">Nama Toko</label>
            <input type="text" class="form-control" id="exampleInputNamaToko" name="nama_toko" placeholder="Input Nama Toko" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="Input Email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputUsername">Username</label>
            <input type="text" class="form-control" id="exampleInputUsername" name="username" placeholder="Input Username" required>
        </div>
        <div class="form-group">
            <label for="exampleInputNoTelp">No Telp</label>
            <input type="number" class="form-control" id="exampleInputNoTelp" name="no_telp" placeholder="Input No Telp" required>
        </div>
        <div class="form-group">
            <label for="exampleInputDeskripsi">Deskripsi</label>
            <textarea class="form-control" id="exampleInputDeskripsi" rows="4" placeholder="Deskripsi Toko" name="deskripsi_toko" required></textarea>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <div class="input-group mb-3">
                <input type="password" id="inputPassword" name="password" minlength="8" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text" onclick="toggle('inputPassword')">
                        <span class="fas fa-lock" id="lock"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="RetypePassword">Confirm Password</label>
            <div class="input-group mb-3">
                <input type="password" id="RetypePassword" class="form-control" minlength="8" name="password_confirmation" placeholder="Confirm password">
                <div class="input-group-append">
                    <div class="input-group-text" onclick="toggle1('RetypePassword')">
                        <span class="fas fa-lock" id="lock1"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </form>
</div>