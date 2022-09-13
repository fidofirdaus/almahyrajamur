@extends('backend.app')

@section('content')
<div class="container-fluid">

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
                                            <th><a href="javascript:void(0)" class="btn btn-success addRow"><i class="fa fa-plus"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataKemarin as $kemarin)
                                        <tr>
                                            <td>
                                                <input type="text" value="{{ $kemarin->nama }}" name="nama[]" class="form-control @error('nama') is-invalid @enderror">
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" value="{{ $kemarin->jumlah }}" min="100" step="100" name="jumlah[]" class="form-control @error('jumlah') is-invalid @enderror">
                                                @error('jumlah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <th><a href='javascript:void(0)' class='btn btn-danger deleteRow'><i class='fa fa-minus'></i></a></th>
                                        </tr>
                                        @endforeach
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
</div>
@endsection

@push('custom-js')
<script>
    $('thead').on('click', '.addRow', function () {
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