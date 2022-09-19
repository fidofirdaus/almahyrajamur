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
            <h3 class="text-themecolor m-b-0 m-t-0">Rekap Keuntungan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Rekap Keuntungan</li>
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
                <h4 class="card-title">Rekap Keuntungan</h4>
                <form action="{{ route('rekap.printRekapKeuntungan') }}" target="_blank" method="post">
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
                    </div>
                    <div class="form-actions">
                        <button type="submit" href="" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat</button>
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