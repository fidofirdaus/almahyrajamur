@extends('backend.app')

@section('css')
<link href="{{ URL('/') }}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="{{ URL('/') }}/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="{{ URL('/') }}/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Laporan Penjualan Tiket</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Laporan Penjualan Tiket</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="card col-md-12">
            <div class="card-body">
                @if (session('success'))
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
                @endif
                <h4 class="card-title">Data Laporan Penjualan Tiket</h4>
                <form action="{{ route('laporan.printPembelian') }}" target="_blank" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-daterange input-group" id="date-range-id">
                                    <input type="text" class="form-control" name="tglAwal" id="tglAwal" placeholder="Tanggal Awal">
                                    <span class="input-group-addon bg-info b-0 text-white">Sampai</span>
                                    <input type="text" class="form-control" name="tglAkhir" id="tglAkhir" placeholder="Tanggal Akhir">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nama Petani</label>
                                <select name="id_petani" class="select2 @error('id_petani') is-invalid @enderror" style="width: 100%">
                                    <option disabled selected>Pilih Salah Satu</option>
                                    @foreach ($dataPetani as $petani)
                                    <option value="{{ $petani->id }}">{{ $petani->name }} (Lokasi: {{ $petani->lokasi }})</option>
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
                    <div class="form-actions">
                        <button name="aksi" value="cetak" type="submit" href="" class="btn btn-info"><i class="fa fa-print"></i> Cetak</button>
                        <button name="aksi" value="download" type="submit" href="" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ URL('/') }}/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{ URL('/') }}/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{ URL('/') }}/assets/plugins/moment/min/moment-with-locales.min.js"></script>
<script src="{{ URL('/') }}/assets/plugins/moment/src/locale/id.js"></script>
<script>
    $('#date-range-id').datepicker({
        toggleActive: true,
        autoclose:true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        locale: 'jv'
    });
</script>
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