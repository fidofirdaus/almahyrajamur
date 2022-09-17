@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Detail Data Panen Sortir</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/panenSortir') }}">Data Panen Sortir</a></li>
                <li class="breadcrumb-item active">Detail Panen Sortir</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Detail Data Panen Sortir</h4>
                </div>
                <div class="card-body">
                    @foreach ($dataPanen as $panen)
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama Petani</th>
                                <td>{{ $panen->petani->name }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $panen->petani->lokasi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ Carbon\Carbon::parse($panen->tanggal)->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Berat Sortir</th>
                                <td>{{ $panen->berat }} Kilogram</td>
                            </tr>
                            <tr>
                                <th>Harga Beli</th>
                                <td>Rp {{ number_format($panen->total_harga/$panen->berat,0,',','.') }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>Rp {{ number_format($panen->total_harga,0,',','.') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $panen->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                    <a class="btn btn-danger" href="{{ url('panenSortir') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection
