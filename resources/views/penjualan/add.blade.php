@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Tambah Data Penjualan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/Penjualan') }}">Data Penjualan</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Tambah Data Penjualan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('penjualan.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Berat Jamur (Kg)</label>
                                        <input type="number" min="1" name="berat" class="form-control @error('berat') is-invalid @enderror">
                                        @error('berat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="hidden" name="hasil_penjualan" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pembeli</label>
                                        <select name="id_pembeli" class="form-control @error('id_pembeli') is-invalid @enderror" style="width: 100%">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataPembeli as $pembeli)
                                            <option value="{{ $pembeli->id }}">{{ $pembeli->name }} (Pembeli {{ $pembeli->role }})</option>
                                            @endforeach
                                        </select>
                                        @error('id_pembeli')
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
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection
