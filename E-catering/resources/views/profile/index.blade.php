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
<!-- profile feature -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="POST" action="{{ route('profile-update',$user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        @if(Auth::user()->role == 'customer')
                        <label for="exampleInputNama">Nama Pengguna</label>
                        @else
                        <label for="exampleInputNama">Nama costumer</label>
                        @endif
                        <input type="text" class="form-control" id="exampleInputNama" name="nama" placeholder="Input Nama" value="{{$user->profile->nama}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Email</label>
                        <input type="email" class="form-control" id="exampleInputNama" name="email" placeholder="Input Email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Username</label>
                        <input type="text" class="form-control" id="exampleInputNama" name="username" placeholder="Input Username" value="{{$user->username}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">No Telp</label>
                        <input type="number" class="form-control" id="exampleInputNama" name="no_telp" placeholder="Input No Telp" value="{{$user->profile->no_telp}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputAlamat">Alamat</label>
                        <textarea class="form-control" id="exampleInputAlamat" rows="4" placeholder="Input Alamat" name="alamat">{{$user->profile->alamat}}</textarea>
                    </div>
                    @if(Auth::user()->role == 'customer')
                    <div class="form-group">
                        <label for="exampleInputDeskripsiBarang">Deskripsi Cosutumer</label>
                        <textarea class="form-control" id="exampleInputDeskripsiBarang" rows="4" placeholder="Input Deskripsi Toko" name="deskripsi_toko">{{$user->customer->deskripsi_toko}}</textarea>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="inputPassword">Reset Password</label>
                        <div class="input-group mb-3">
                            <input type="password" id="inputPassword" name="password" minlength="8" class="form-control" placeholder="Input Password">
                            <div class="input-group-append">
                                <div class="input-group-text" onclick="toggle('inputPassword')">
                                    <span class="fas fa-lock" id="lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="{{url('assets/profile/'.$user->profile->foto)}}" alt="" width="10%">
                    <div class="form-group">
                        <label for="exampleInputNama">Foto</label>
                        <input type="file" class="form-control" id="exampleInputNama" name="foto" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection