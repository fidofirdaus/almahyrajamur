@extends('backend.app')

@section('css')
<link href="{{ URL('/') }}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Tambah Data Penjualan Sortir</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/penjualanSortir') }}">Data Penjualan Sortir</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Tambah Data Penjualan Sortir</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('penjualanSortir.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Berat Jamur (Kg) 
                                            <small class="text-danger">Jika tidak bulat, pisahkan angka dengan (.) Contoh: 2.5</small>
                                         </label>
                                         <input type="number" min="0.5" step=".5" name="berat" class="form-control @error('berat') is-invalid @enderror">
                                        @error('berat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <input type="hidden" name="total_harga" value="0">
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Petani</label>
                                        <select name="id_panen" class="select2 @error('id_panen') is-invalid @enderror" style="width: 100%">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataPanen as $panen)
                                            <option value="{{ $panen->id }}">{{ $panen->petani->name }} | Berat Sortir {{ $panen->berat }} Kg | Tanggal Panen {{ Carbon\Carbon::parse($panen->tanggal)->translatedFormat("d F Y") }}</option>
                                            <input type="hidden" name="berat_awal" value="{{ $panen->berat }}">
                                            @endforeach
                                        </select>
                                        @error('id_pembeli')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pembeli</label>
                                        <select name="id_pembeli" class="select2 @error('id_pembeli') is-invalid @enderror" style="width: 100%">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataPembeli as $pembeli)
                                            <option value="{{ $pembeli->id }}">{{ $pembeli->name }}</option>
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

@push('custom-js')
<script src="{{ URL('/') }}/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
@endpush

@push('after-js')
<script>
    jQuery(document).ready(function() {
        // For select 2
        $(".select2").select2();
    });
</script>
@endpush