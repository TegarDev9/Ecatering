@extends('layouts.sidebar')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-info" style="height: 133px">
                    <div class="inner">
                        <h3><i class="fas fa-store"></i> &nbsp;{{$total_customer}}</h3>

                        <p>Total customer</p>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- small box -->
                <div class="small-box bg-secondary" style="height: 133px">
                    <div class="inner">
                        <h3><i class="fas fa-users"></i> &nbsp;{{$total_customer}}</h3>

                        <p>Total User</p>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection