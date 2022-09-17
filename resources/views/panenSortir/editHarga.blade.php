@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Tambah/Edit Harga</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/panenSortir') }}">Data Panen Sortir</a></li>
                <li class="breadcrumb-item active">Tambah/Edit Harga</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Tambah/Edit Harga Sortir</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('panenSortir.updateHarga', $dataPanen->id) }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Petani</label>
                                        <input class="form-control" type="text" name="" id="" value="{{ $dataPanen->petani->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Panen</label>
                                        <input class="form-control" type="text" name="" id="" value="{{ Carbon\Carbon::parse($dataPanen->tanggal)->translatedFormat("l, d F Y") }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Berat Sortir</label>
                                        <input class="form-control" type="text" name="" id="" value="{{ $dataPanen->berat }} Kg" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Harga</label>
                                        <input class="form-control" type="number" name="total_harga" id="" value="Rp {{ number_format($dataPanen->total_harga,0,',','.') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{ url('/panenSortir') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection