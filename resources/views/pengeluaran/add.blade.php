@extends('backend.app')

@section('content')
<div class="container-fluid">

    @if (Request::segment(1) == 'pengeluaran' && Request::segment(2) == 'create')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Tambah Data Pengeluaran</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/pengeluaranHarian') }}">Data Pengeluaran</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">

                <div class="card-header">
                    <h4 class="m-b-0 text-white">Tambah Data Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengeluaran.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group col-lg-12 col-md-12">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Nama Pengeluaran</th>
                                            <th>Jumlah (Rp)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="nama[]" class="form-control @error('nama') is-invalid @enderror">
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" min="100" step="100" name="jumlah[]" class="form-control @error('jumlah') is-invalid @enderror">
                                                @error('jumlah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td><a href="javascript:void(0)" class="btn btn-success addRow"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{ url('/pengeluaranHarian') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    @else
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Tambah Data Pengeluaran Terlewat</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/pengeluaranKeseluruhan') }}">Data Pengeluaran</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">

                <div class="card-header">
                    <h4 class="m-b-0 text-white">Tambah Data Pengeluaran Terlewat</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengeluaran.storeTerlewat') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="form-group col-lg-6 col-md-6">
                                <label class="control-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 col-md-12">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Nama Pengeluaran</th>
                                            <th>Jumlah (Rp)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="nama[]" class="form-control @error('nama') is-invalid @enderror">
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" min="100" step="100" name="jumlah[]" class="form-control @error('jumlah') is-invalid @enderror">
                                                @error('jumlah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td><a href="javascript:void(0)" class="btn btn-success addRow"><i class="fa fa-plus"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{ url('/pengeluaranKeseluruhan') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    @endif
</div>
@endsection

@push('custom-js')
<script>
    $('tbody').on('click', '.addRow', function () {
        var tr = "<tr>"+
                    "<td>"+
                        "<input type='text' name='nama[]' class='form-control @error('nama') is-invalid @enderror'>"+
                        "@error('nama')"+
                            "<span class='invalid-feedback' role='alert'>"+
                                "<strong>{{ $message }}</strong>"+
                            "</span>"+
                        "@enderror"+
                    "</td>"+
                    "<td>"+
                        "<input type='number' min='100' step='100' name='jumlah[]' class='form-control @error('jumlah') is-invalid @enderror'>"+
                        "@error('jumlah')"+
                            "<span class='invalid-feedback' role='alert'>"+
                                "<strong>{{ $message }}</strong>"+
                            "</span>"+
                        "@enderror"+
                    "</td>"+
                    "<th><a href='javascript:void(0)' class='btn btn-danger deleteRow'><i class='fa fa-minus'></i></a></th>"+
                "</tr>"
        $('tbody').append(tr);
    });

    $('tbody').on('click', '.deleteRow', function () {
        $(this).parent().parent().remove();
    });
</script>
@endpush