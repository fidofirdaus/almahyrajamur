@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Detail Data Panen</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/panen') }}">Data Panen</a></li>
                <li class="breadcrumb-item active">Detail Panen</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Detail Data Panen</h4>
                </div>
                <div class="card-body">
                    @foreach ($dataPanen as $panen)
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama Petani</th>
                                <td>{{ $panen->name }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $panen->lokasi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ Carbon\Carbon::parse($panen->tanggal)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Berat Panen</th>
                                <td>{{ $panen->berat }} Kilogram</td>
                            </tr>
                            <tr>
                                <th>Harga Beli</th>
                                <td>Rp {{ number_format($panen->hasil_penjualan/$panen->berat,0,',','.') }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                @if ($panen->hasil_penjualan != 0)
                                <td>Rp {{ number_format($panen->hasil_penjualan,0,',','.') }}</td>
                                @else
                                <td>Belum Terjual</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                    <a class="btn btn-danger" href="{{ url('panen') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection
