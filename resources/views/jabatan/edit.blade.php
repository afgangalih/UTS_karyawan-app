@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('jabatan/' . $jabatan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kode_jabatan">Kode Jabatan</label>
                <input type="text" class="form-control" name="kode_jabatan" value="{{ old('kode_jabatan', $jabatan->kode_jabatan) }}" required>
                @error('kode_jabatan')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_jabatan">Nama Jabatan</label>
                <input type="text" class="form-control" name="nama_jabatan" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" required>
                @error('nama_jabatan')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Update</button>
            <a href="{{ url('jabatan') }}" class="btn btn-default btn-sm">Kembali</a>
        </form>
    </div>
</div>
@endsection
