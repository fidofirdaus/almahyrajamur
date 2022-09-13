@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Edit Data Pengeluaran</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/pengeluaranHarian') }}">Data Pengeluaran</a></li>
                <li class="breadcrumb-item active">Edit Data Pengeluaran</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Data Pengeluaran</h4>
                </div>
                <div class="card-body">
                    @foreach ($dataPengeluaran as $pengeluaran)
                    <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pengeluaran</label>
                                        <input type="text" value="{{ $pengeluaran->nama }}" name="nama" class="form-control @error('nama') is-invalid @enderror">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jumlah Pengeluaran (Rp)</label>
                                        <input type="number" step="100" value="{{ $pengeluaran->jumlah }}" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror">
                                        @error('jumlah')
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
                            <a href="{{ url('/pengeluaranHarian') }}" class="btn btn-inverse">Kembali</a>
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