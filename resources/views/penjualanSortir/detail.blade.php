@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Detail Data Penjualan Sortir</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/penjualanSortir') }}">Data Penjualan Sortir</a></li>
                <li class="breadcrumb-item active">Detail Penjualan Sortir</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Detail Data Penjualan Sortir</h4>
                </div>
                <div class="card-body">
                    @foreach ($dataPenjualan as $penjualan)
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama Pembeli</th>
                                <td>{{ $penjualan->pembeli->name }}</td>
                            </tr>
                            <tr>
                                <th>Nama Petani</th>
                                <td>{{ $penjualan->panen->petani->name }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ Carbon\Carbon::parse($penjualan->tanggal)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Berat Awal</th>
                                <td>{{ $penjualan->berat_awal }} Kilogram</td>
                            </tr>
                            <tr>
                                <th>Berat Terjual</th>
                                <td>{{ $penjualan->berat_terjual }} Kilogram</td>
                            </tr>
                            {{-- <tr>
                                <th>Harga Jual</th>
                                <td>Rp {{ number_format($penjualan->total_harga/$penjualan->berat,0,',','.') }}/Kg</td>
                            </tr> --}}
                            <tr>
                                <th>Total Harga</th>
                                <td>Rp {{ number_format($penjualan->total_harga,0,',','.') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $penjualan->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                    <a class="btn btn-danger" href="{{ url('penjualanSortir') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection
