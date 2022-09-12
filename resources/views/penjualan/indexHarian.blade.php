@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Data Penjualan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Penjualan</li>
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
                <h4 class="card-title">Data Penjualan</h4>
                @if (Auth::user()->role == 'Pengepul')
                <a href="{{ URL('/penjualan/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Penjualan</a>
                @endif
                {{-- @elseif (Auth::user()->role == 'Pengepul' || Auth::user()->role == 'Kades') --}}
                @if (Auth::user()->role == 'Pengepul')
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
                                    <th style="width: 15%">Total Harga</th>
                                    <th class="text-center" style="width: 20%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPenjualan as $no => $penjualan)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat("l, d F Y") }}</td>
                                    <td>{{ $penjualan->name }} ({{ $penjualan->role }})</td>
                                    <td>{{ $penjualan->berat }} Kg</td>
                                    @if ($penjualan->status == null)
                                    <td><p class="text-danger">Belum Bayar</p></td>
                                    @else
                                    <td><p class="text-success">{{ $penjualan->status }}</p></td>
                                    @endif

                                    @if ($penjualan->total_harga == 0 && Auth::user()->role == 'Pengepul')
                                    <td><a href="{{ URL('/penjualan/createHarga') }}" class="btn btn-warning"><i class="fa fa-dollar"></i>Masukkan Harga</a></td>
                                    <td><a href="{{ route('penjualan.detail', $penjualan->id) }}" class="btn btn-success"><i class="fa fa-info"></i> Detail</a>
                                    </td>

                                    @elseif($penjualan->total_harga != 0 && $penjualan->role == 'Umum')
                                    <td>Rp {{ number_format($penjualan->total_harga,0,',','.') }} 
                                        @if ($penjualan->status == null)
                                        <a href="{{ route('penjualan.editHarga', $penjualan->id) }}" class="btn btn-primary">
                                        <i class="fa fa-pencil"></i></a>
                                        @endif
                                    </td> 
                                    <td class="text-center"><a href="{{ route('penjualan.detail', $penjualan->id) }}" class="btn btn-success"><i class="fa fa-info"></i> Detail</a>
                                        @if ($penjualan->status == null)
                                        <a href="{{ route('penjualan.editStatus', $penjualan->id) }}" class="btn btn-warning"><i class="fa fa-check"></i> Ganti Status</a>
                                        @endif
                                    </td>

                                    @elseif ($penjualan->total_harga != 0 && $penjualan->role == 'Langganan')
                                    <td>Rp {{ number_format($penjualan->total_harga,0,',','.') }}</td>
                                    <td class="text-center"><a href="{{ route('penjualan.detail', $penjualan->id) }}" class="btn btn-success"><i class="fa fa-info"></i> Detail</a>
                                        @if ($penjualan->status == null)
                                        <a href="{{ route('penjualan.editStatus', $penjualan->id) }}" class="btn btn-warning"><i class="fa fa-check"></i> Ganti Status</a>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- @elseif(Auth::user()->role == 'Petani')
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
                                @foreach ($dataPenjualan2 as $no => $penjualan)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat("l, d F Y") }}</td>
                                    <td>{{ $penjualan->berat }} Kg</td>
                                    @if ($penjualan->hasil_penjualan != 0)
                                    <td>Rp {{ number_format($penjualan->hasil_penjualan,2,',','.') }}</td>
                                    @else
                                    <td>Belum Ada Penjualan</td>
                                    @endif
                                    <td><a href="{{ route('penjualan.detail', $penjualan->id) }}" class="btn btn-success">Detail</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
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
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group +
                                '</td></tr>');
                            last = group;
                        }
                    });
                }
            });

        });
    });
</script>
@endpush