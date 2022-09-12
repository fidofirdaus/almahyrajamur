@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Edit Data Penjualan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/penjualanHarian') }}">Data Penjualan</a></li>
                <li class="breadcrumb-item active">Edit Data Harga Jual</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Data Penjualan</h4>
                </div>
                <div class="card-body">
                    @foreach ($dataPenjualan as $penjualan)
                    <form action="{{ route('penjualan.updateHarga', $penjualan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Harga Jual (per Kilogram)</label>
                                        <input type="number" value="{{ $penjualan->total_harga/$penjualan->berat }}" name="harga" class="form-control @error('harga') is-invalid @enderror">
                                        @error('harga')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{ url('/penjualanHarian') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection