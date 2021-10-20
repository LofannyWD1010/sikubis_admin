@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Tambah Data
    </div>
    <div class="card-body">
        <form action="{{ route("admin.jurusans.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nama') ? 'has-validated' : '' }}">
                <label for="nama">Nama Jurusan</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', isset($jurusan) ? $jurusan->nama : '') }}" step="0.01" required>
                <span class='text-danger'>{{$errors->first('nama')}}</span>
            </div>  
            <div class="form-group {{ $errors->has('id_fakultas') ? 'has-validated' : '' }}">
                <input type="hidden" id="id_fakultas" name="id_fakultas" class="form-control" value="{{ $id_fakultas }}" step="0.01">
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection