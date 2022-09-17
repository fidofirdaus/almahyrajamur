@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Edit Data Panen</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/panen') }}">Data Panen</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Data Panen</h4>
                </div>
                <div class="card-body">
                    @foreach ($detailPanen as $panen)
                    <form action="{{ route('panen.update', $panen->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Harga Jamur (Kilogram)</label>
                                        <input type="number" value="{{ $panen->hasil_penjualan/$panen->berat }}" name="harga" class="form-control @error('harga') is-invalid @enderror">
                                        @error('harga')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Berat Jamur (Kilogram)</label>
                                        <input type="number" step=".5" value="{{ $panen->berat }}" name="berat" class="form-control @error('berat') is-invalid @enderror">
                                        @error('berat')
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
                            <a href="{{ url('/panen') }}" class="btn btn-inverse">Kembali ke Panen Harian</a>
                            <a href="{{ url('/panenKeseluruhan') }}" class="btn btn-inverse">Kembali ke Panen Keseluruhan</a>
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