@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Data Sortir</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Panen Sortir</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="card col-md-12">
            <div class="card-body">
                @if (session('success'))
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
                @elseif(session('warning'))
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('warning') }}
                        </div>
                    </div>
                </div>
                @endif
                <h4 class="card-title">Data Panen Sortir</h4>
                @if (Auth::user()->role == 'Pengepul')
                <a href="{{ URL('/panenSortir/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Panen Sortir</a>
                @endif
                {{-- @elseif (Auth::user()->role == 'Pengepul' || Auth::user()->role == 'Kades') --}}
                @if (Auth::user()->role == 'Pengepul')
                <div class="row">
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No.</th>
                                    <th style="width: 25%">Tanggal</th>
                                    <th style="width: 20%">Nama Petani</th>
                                    <th style="width: 15%">Berat</th>
                                    @if (Auth::user()->role == 'Pengepul')
                                    <th style="width: 20%">Total Harga</th>
                                    <th style="width: 15%">Status</th>
                                    <th style="width: 20%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPanen as $no => $panen)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ Carbon\Carbon::parse($panen->tanggal)->translatedFormat("l, d F Y") }}</td>
                                    <td>{{ $panen->petani->name }}</td>
                                    <td>{{ $panen->berat }} Kg</td>
                                    @if ($panen->total_harga == 0)
                                    <td><a href="{{ route('panenSortir.editHarga', $panen->id) }}" class="btn btn-warning"><i class="fa fa-dollar"></i>Masukkan Harga</a></td>
                                    <td>{{ $panen->status }}</td>
                                    <td><a href="{{ route('panenSortir.detail', $panen->id) }}" class="btn btn-success"><i class="fa fa-info"></i> Detail</a></td>
                                    @elseif ($panen->total_harga != 0 && $panen->status == 'Belum Dibayar')
                                    <td>Rp {{ number_format($panen->total_harga,0,',','.') }} 
                                        {{-- @if ($panen->status == null)
                                        <a href="{{ route('panen.edit', $panen->id) }}" class="btn btn-danger"><i class="fa fa-pencil"></i> Edit</a>
                                        @endif --}}
                                    </td>
                                    <td>{{ $panen->status }}</td> 
                                    <td><a href="{{ route('panenSortir.detail', $panen->id) }}" class="btn btn-success"><i class="fa fa-info"></i> Detail</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-warning"><i class="fa fa-bar-chart-o"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h2 class="m-b-0">{{ $beratPanen }} Kg</h2><h3>Rp {{ number_format($uangPanen,0,',','.') }}</h3>
                                        <h5 class="text-muted m-b-0">Panen Hari Ini</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                @elseif(Auth::user()->role == 'Petani')
                <div class="row">
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No.</th>
                                    <th style="width: 35%">Tanggal</th>
                                    <th style="width: 20%">Berat</th>
                                    <th style="width: 30`%">Hasil Penjualan</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPanen2 as $no => $panen)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ Carbon\Carbon::parse($panen->tanggal)->translatedFormat("l, d F Y") }}</td>
                                    <td>{{ $panen->berat }} Kg</td>
                                    @if ($panen->hasil_penjualan != 0)
                                    <td>Rp {{ number_format($panen->hasil_penjualan,0,',','.') }}</td>
                                    @else
                                    <td>Belum Ada Penjualan</td>
                                    @endif
                                    <td><a href="{{ route('panen.detail', $panen->id) }}" class="btn btn-success">Detail</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/sweetalert/sweetalert.min.js"></script>
@endpush

@push('after-js')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "displayLength": 25,
        });
    });
</script>
@endpush