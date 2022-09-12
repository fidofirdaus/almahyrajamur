@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Detail Data Penjualan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/penjualanHarian') }}">Data Penjualan</a></li>
                <li class="breadcrumb-item active">Detail Penjualan</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Detail Data Penjualan</h4>
                </div>
                <div class="card-body">
                    @foreach ($dataPenjualan as $penjualan)
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama Petani</th>
                                <td>{{ $penjualan->name }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pembeli</th>
                                <td>{{ $penjualan->role }}</td>
                            </tr>
                            <tr>
                                <th>Asal Pembeli</th>
                                <td>{{ $penjualan->lokasi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Berat Penjualan</th>
                                <td>{{ $penjualan->berat }} Kilogram</td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td>Rp {{ number_format($penjualan->total_harga/$penjualan->berat,0,',','.') }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                @if ($penjualan->total_harga != 0)
                                <td>Rp {{ number_format($penjualan->total_harga,0,',','.') }}</td>
                                @else
                                <td>Rp 0,00</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Status</th>
                                @if ($penjualan->status == 'Belum Bayar')
                                <td><p class="text-danger">Belum Bayar</p></td>
                                @else
                                <td><p class="text-success">Sudah Bayar</p></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                    <a class="btn btn-danger" href="{{ url('penjualanHarian') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection
