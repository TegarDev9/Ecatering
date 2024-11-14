@extends('layouts.topbar')

@section('content')
<!-- breadcrumb -->
<div class="container py-4 gap-3">
    <img src="{{ url('assets/user/images/logo.png')}}" alt="merchantLTE Logo" width="20%" class="mt-4" style="opacity: .8">

    <div class="col-span-8 mt-4  w-1-2 p-4 rounded">
        <h3 class="text-lg font-medium capitalize mb-4">Hubungi Kami</h3>
        <div class="space-y-4">
            <div>
                <label for="nama" class="text-gray-600">Nama</label>
                <input type="text" name="nama" id="nama" class="input-box">
            </div>
            <div>
                <label for="pesan" class="text-gray-600">Pesan</label>
                <textarea rows="4" name="pesan" id="pesan" class="input-box" style="border-color: gray;"></textarea>
            </div>
            <div>
                <button id="send" class="block w-full py-3 px-4 text-center text-white bg-red-600 border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium"><i class="fab fa-telegram-plane"></i> Kirim
                    Pesan</button>
            </div>
        </div>
    </div>
</div>
<!-- ./breadcrumb -->
<script>
    $(document).on('click', '#send', function() {
        /* Inputan Formulir */
        var inputName = $("#nama").val(),
            InputPesan = $("#pesan").val();

        /* Pengaturan Whatsapp */
        var walink = 'https://web.whatsapp.com/send',
            phone = '6285213575815',
            success = 'Message send successfully.',
            failed = 'Failed to send message, please check again.';

        /* Smartphone Support */
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            var walink = 'whatsapp://send';
        }

        if (inputName != "") {
            /* Whatsapp URL */
            var send_whatsapp = walink + '?phone=' + phone + '&text=' + 'Halo Saya ' + inputName + '%0A Ingin Menyampaikan ' + InputPesan;

            /* Whatsapp Window Open */
            window.open(send_whatsapp, '_blank');
            document.getElementById("alert").innerHTML = '<div class="alert alert-success">' + success + '</div>';
        } else {
            document.getElementById("alert").innerHTML = '<div class="alert alert-danger">' + failed + '</div>';
        }
    });
</script>
@endsection