@extends('layouts.merchant')

@section('container')
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" style="text-align: right">
                <img src="{{url('assets/profile/',Auth::user()->profile->foto)}}" class="img-circle mb-2" width="35px" alt="User Image">
                <span class="ml-w">{{ Auth::user()->profile->nama }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{url('assets/profile/',Auth::user()->profile->foto)}}" class="img-circle mr-3 mb-2" width="50px" alt="User Image">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ Auth::user()->profile->nama }}
                            </h3>
                            <p class="text-sm"> <b>{{ Auth::user()->role }} </b></p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <a href="{{url('edit_profile/'.Auth::user()->id)}}" class="dropdown-item text-center">Edit Profile</a>
                <a href="#" class="dropdown-item dropdown-footer text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-danger elevation-4" style="">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-align: center;">
        <div class="text-center mb-1">
            <img src="{{ url('assets/user/images/logo.png')}}" alt="merchantLTE Logo" width="50%" style="opacity: .8">
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::user()->role == 'customer')
                <li class="nav-item">
                    <a href="{{url('home_customer')}}" class="nav-link {{($title == 'Dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <p>
                            &nbsp;&nbsp;Dashboard
                        </p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->role == 'merchant')
                <li class="nav-item">
                    <a href="{{url('home_merchant')}}" class="nav-link {{($title == 'Dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <p>
                            &nbsp;&nbsp;Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('customer')}}" class="nav-link {{($title == 'Data customer'  || $title == 'Edit Data customer') ? 'active' : '' }}">
                        <i class="fas fa-store"></i>
                        <p>
                            &nbsp;&nbsp;customer
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{url('produk')}}" class="nav-link {{($title == 'Data Produk' || $title == 'Edit Data Produk') ? 'active' : '' }}">
                        <i class="fas fa-utensils"></i>
                        <p>
                            &nbsp;&nbsp; Produk
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('transaksi')}}" class="nav-link {{($title == 'Manajemen Transaksi') ? 'active' : '' }}">
                        <i class="fas fa-money-check"></i>
                        <p>
                            &nbsp;&nbsp; Transaksi
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-header">EXAMPLES</li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">{{ $title }}</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
</div>
@endsection