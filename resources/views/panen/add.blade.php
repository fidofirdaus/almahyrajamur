@extends('backend.app')

@section('css')
<link href="{{ URL('/') }}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Tambah Data Panen</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/panen') }}">Data Panen</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Tambah Data Panen</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('panen.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Bobot Panen (Kg) 
                                           <small class="text-danger">Jika tidak bulat, pisahkan angka dengan (.) Contoh: 2.5</small>
                                        </label>
                                        <input type="number" min="0.1" step=".01" name="berat" class="form-control @error('berat') is-invalid @enderror">
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
                                        <label class="control-label">Nama Petani
                                        </label>
                                        <select name="id_petani" class="select2 @error('id_petani') is-invalid @enderror" style="width: 100%">
                                            <option disabled selected>Pilih Salah Satu</option>
                                            @foreach ($dataPetani as $petani)
                                            <option value="{{ $petani->id }}">{{ $petani->name }}, Lokasi {{ $petani->lokasi }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_petani')
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
                            <a href="{{ url('/panen') }}" class="btn btn-inverse">Kembali</a>
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
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>
@endpush