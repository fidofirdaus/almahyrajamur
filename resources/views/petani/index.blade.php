@extends('backend.app')

@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Data Petani</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL('/admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Petani</li>
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
                @elseif(session('warning'))
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('warning') }}
                        </div>
                    </div>
                </div>
                @endif
                <h4 class="card-title">Data Petani</h4>
                <a href="{{ URL('/petani/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Petani</a>
                <div class="row">
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No.</th>
                                    <th style="width: 25%">Nama Petani</th>
                                    <th style="width: 25%">Lokasi</th>
                                    <th style="width: 25%">Jumlah Log</th>
                                    <th style="width: 20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPetani as $no => $petani)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $petani->name }}</td>
                                    <td>{{ $petani->lokasi }}</td>
                                    @if ($petani->jml_log == null)
                                    <td>Belum ada data Log</td>
                                    @else
                                    <td>{{ $petani->jml_log }} Buah</td>
                                    @endif
                                    <td><a href="{{ route('petani.edit', $petani->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/sweetalert/sweetalert.min.js"></script>
@endpush

@push('after-js')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group +
                                '</td></tr>');
                            last = group;
                        }
                    });
                }
            });

        });
    });
</script>
@endpush