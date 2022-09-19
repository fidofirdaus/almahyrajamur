@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Data Penjualan Belum Bayar</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Penjualan Belum Bayar</li>
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
                <h4 class="card-title">Data Penjualan Belum Bayar</h4>
                @if (Auth::user()->role == 'Pengepul')
                <a href="{{ URL('/penjualan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Penjualan</a>
                @endif
                <div class="row">
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No.</th>
                                    <th style="width: 20%">Tanggal</th>
                                    <th style="width: 20%">Nama Pembeli</th>
                                    <th style="width: 10%">Berat</th>
                                    @if (Auth::user()->role == 'Pengepul')
                                    <th style="width: 10%">Status</th>
                                    <th style="width: 20%">Total Harga</th>
                                    <th style="width: 15%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPenjualan as $no => $penjualan)
                                <tr>
                                    @if ($penjualan->total_harga == 0 && $penjualan->status == 'Belum Bayar')
                                    <td class="text-danger">{{ $no+1 }}</td>
                                    <td class="text-danger">{{ Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat("l, d F Y") }}</td>
                                    <td class="text-danger">{{ $penjualan->pembeli->name }}</td>
                                    <td class="text-danger">{{ $penjualan->berat }} Kg</td>
                                    <td><b><p class="text-danger">Belum Bayar</p></b></td>
                                    <td><a href="{{ URL('/penjualan/createHarga') }}" class="btn btn-warning"><i class="fa fa-dollar"></i>Masukkan Harga</a></td>
                                    <td><a href="{{ route('penjualan.detail', $penjualan->id) }}" class="btn btn-success"><i class="fa fa-info"></i> Detail</a>
                                    </td>

                                    @elseif ($penjualan->total_harga != 0 && $penjualan->status == 'Belum Bayar')
                                    <td class="text-danger">{{ $no+1 }}</td>
                                    <td class="text-danger">{{ Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat("l, d F Y") }}</td>
                                    <td class="text-danger">{{ $penjualan->pembeli->name }}</td>
                                    <td class="text-danger">{{ $penjualan->berat }} Kg</td>
                                    <td><b><p class="text-danger">Belum Bayar</p></b></td>
                                    <td class="text-danger">Rp {{ number_format($penjualan->total_harga,0,',','.') }}
                                        <a href="{{ route('penjualan.editHarga', $penjualan->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil"></i></a>
                                    </td>
                                    <td><a href="{{ route('penjualan.detail', $penjualan->id) }}" class="btn btn-success"><i class="fa fa-info"></i> Detail</a>
                                    <a href="{{ route('penjualan.editStatus', $penjualan->id) }}" class="btn btn-warning"><i class="fa fa-check"></i> Ganti Status</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
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