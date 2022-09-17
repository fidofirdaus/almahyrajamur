@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Edit Status</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/penjualanSortir') }}">Data Penjualan Sortir</a></li>
                <li class="breadcrumb-item active">Edit Status</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Status Sortir</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('penjualanSortir.updateStatus', $dataPenjualan->id) }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pembeli</label>
                                        <input class="form-control" type="text" name="" id="" value="{{ $dataPenjualan->pembeli->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Penjualan</label>
                                        <input class="form-control" type="text" name="" id="" value="{{ Carbon\Carbon::parse($dataPenjualan->tanggal)->translatedFormat("l, d F Y") }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Berat Sortir</label>
                                        <input class="form-control" type="text" name="" id="" value="{{ $dataPenjualan->berat_awal }} Kg" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Status Pembayaran</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" style="width: 100%">
                                            <option value="Sudah Bayar">Sudah Bayar</option>
                                        </select>
                                        @error('status')
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
                            <a href="{{ url('/penjualanSortir') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection