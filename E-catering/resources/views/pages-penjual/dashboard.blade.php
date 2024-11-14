@extends('layouts.sidebar')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-info" style="height: 133px">
                    <div class="inner">
                        <h3><i class="fas fa-utensils"></i> &nbsp;{{$total_makanan}}</h3>

                        <p>Total Pesanan Makanan</p>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-secondary" style="height: 133px">
                    <div class="inner">
                        <h3><i class="fas fa-glass-martini-alt"></i> &nbsp;{{$total_minuman}}</h3>

                        <p>Total Pesanan Minuman</p>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-danger" style="height: 133px">
                    <div class="inner">
                        <h3>Rp. {{number_format($total_customeran, 0, ",", ".")}}</h3>
                        <p>Total customeran</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="chart">
            <div style="min-height: 230px; height: 300px; max-height: 300px; max-width: 100%; background-color:#ffff;">
                <canvas id="myChart2" style="min-height: 230px; height: 300px; max-height: 300px; max-width: 100%; background-color:#ffff;"></canvas>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<script>
    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                $data = null;
                if (count($customeran_makanan) > count($customeran_minuman)) {
                    $data = $customeran_makanan;
                } else if (count($customeran_makanan) < count($customeran_minuman)) {
                    $data = $customeran_minuman;
                } else {
                    $data = $customeran_makanan;
                }
                foreach ($data as $bulan) {
                    $date = null;
                    if ($bulan->bulan == 1) {
                        $date = "Januari";
                    } else if ($bulan->bulan == 2) {
                        $date = "February";
                    } else if ($bulan->bulan == 3) {
                        $date = "Maret";
                    } else if ($bulan->bulan == 4) {
                        $date = "April";
                    } else if ($bulan->bulan == 5) {
                        $date = "Mei";
                    } else if ($bulan->bulan == 6) {
                        $date = "Juni";
                    } else if ($bulan->bulan == 7) {
                        $date = "Juli";
                    } else if ($bulan->bulan == 8) {
                        $date = "Agustus";
                    } else if ($bulan->bulan == 9) {
                        $date = "September";
                    } else if ($bulan->bulan == 10) {
                        $date = "Oktober";
                    } else if ($bulan->bulan == 11) {
                        $date = "November";
                    } else if ($bulan->bulan == 12) {
                        $date = "Desember";
                    }
                ?> '<?= $date ?> ',
                <?php } ?>
            ],
            datasets: [{
                label: 'Total customeran Makanan',
                data: [<?php foreach ($customeran_makanan as $dm) { ?> <?= $dm->makanan  ?>,
                    <?php } ?>
                ],
                backgroundColor: [
                    'rgba(60,141,188,1)'
                ],
                borderColor: [
                    'rgba(60,141,188, 1)',
                ],
                borderWidth: 1
            }, {
                label: 'Total customeran Minuman',
                data: [<?php foreach ($customeran_minuman as $dmn) { ?> <?= $dmn->minuman ?>,
                    <?php } ?>
                ],
                backgroundColor: [
                    'rgba(210, 214, 222, 1)'
                ],
                borderColor: [
                    'rgba(210, 214, 222, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection