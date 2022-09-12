@extends('backend.app')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">{{ Auth::user()->role }} Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ Auth::user()->role }} Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    @if (Auth::user()->role == 'Kades')
                    Halo, Bapak Kepala Desa !
                    @else
                    Selamat Datang, Bapak {{ Auth::user()->name }} !
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->role == 'admin')
    {{-- <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="fa fa-dollar"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-light">@currency( $pendapatanHariIni )</h3></a>
                            <h5 class="text-muted m-b-0">Pendapatan Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="fa fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketHariIni }}</h3></a>
                            <h5 class="text-muted m-b-0">Penjualan Tiket Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="fa  fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketGratisHariIni }}</h3></a>
                            <h5 class="text-muted m-b-0">Tiket Gratis Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-success"><i class="fa fa-dollar"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-light">@currency( $pendapatanTimur )</h3></a>
                            <h5 class="text-muted m-b-0">Pendapatan Loket Timur</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="fa fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketTimur }}</h3></a>
                            <h5 class="text-muted m-b-0">Penjualan Tiket Loket Timur</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="fa  fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketTimurGratis }}</h3></a>
                            <h5 class="text-muted m-b-0">Tiket Gratis Loket Timur</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="fa fa-dollar"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-light">@currency( $pendapatanBarat )</h3></a>
                            <h5 class="text-muted m-b-0">Pendapatan Loket Barat</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-success"><i class="fa fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketBarat }}</h3></a>
                            <h5 class="text-muted m-b-0">Penjualan Tiket Loket Barat</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="fa  fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketBaratGratis }}</h3></a>
                            <h5 class="text-muted m-b-0">Tiket Gratis Loket Barat</h5></div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
    @elseif(Auth::user()->id == 2 or Auth::user()->id == 3)
    {{-- <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="fa fa-dollar"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-light">@currency( $pendapatanHariIniLoket )</h3></a>
                            <h5 class="text-muted m-b-0">Pendapatan Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="fa fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketHariIniLoket }} Tiket</h3></a>
                            <h5 class="text-muted m-b-0">Penjualan Tiket Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="fa  fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketGratisHariIniLoket }} Tiket</h3></a>
                            <h5 class="text-muted m-b-0">Tiket Gratis Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
    @else
    {{-- <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-warning"><i class="fa fa-dollar"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-light">@currency( $pendapatanBan )</h3></a>
                            <h5 class="text-muted m-b-0">Pendapatan Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info"><i class="fa fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketBan }} Ban</h3></a>
                            <h5 class="text-muted m-b-0">Peminjaman Ban Hari Ini</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-danger"><i class="fa  fa-ticket"></i></div>
                        <div class="m-l-10 align-self-center">
                            <a href="{{ route('tiket.index') }}"><h3 class="m-b-0 font-lgiht">{{ $tiketBanProses }} Ban</h3></a>
                            <h5 class="text-muted m-b-0">Peminjaman Dalam Proses</h5></div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
    @endif
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
</div>
@endsection