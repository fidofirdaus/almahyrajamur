@extends('backend.app')

@section('content')
<div class="container-fluid">

    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Edit Data Petani</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/petani') }}">Data Petani</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-info">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">Edit Data Petani</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('petani.update', $petani->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input type="text" value="{{ $petani->name }}" name="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Lokasi</label>
                                        <input type="text" value="{{ $petani->lokasi }}" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror">
                                        {{-- <select name="dusun" class="form-control @error('dusun') is-invalid @enderror" style="width: 100%">
                                            <option value="Kampungbaru" {{ $petani->dusun == 'Kampungbaru' ? 'selected' : '' }}>Dusun Kampungbaru</option>
                                            <option value="Perkebunan" {{ $petani->dusun == 'Perkebunan' ? 'selected' : '' }}>Dusun Perkebunan</option>
                                            <option value="Ramiyan" {{ $petani->dusun == 'Ramiyan' ? 'selected' : '' }}>Dusun Ramiyan</option>
                                            <option value="Sumbermulyo" {{ $petani->dusun == 'Sumbermulyo' ? 'selected' : '' }}>Dusun Sumbermulyo</option>
                                        </select> --}}
                                        @error('lokasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Simpan</button>
                            <a href="{{ url('/petani') }}" class="btn btn-inverse">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
</div>
@endsection