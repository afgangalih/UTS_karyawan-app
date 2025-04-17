@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('jabatan') }}">
            @csrf
            <div class="form-group">
                <label for="kode_jabatan">Kode Jabatan</label>
                <input type="text" class="form-control" id="kode_jabatan" name="kode_jabatan" value="{{ old('kode_jabatan') }}" required>
                @error('kode_jabatan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_jabatan">Nama Jabatan</label>
                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required>
                @error('nama_jabatan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="{{ url('jabatan') }}" class="btn btn-secondary btn-sm ml-2">Kembali</a>
        </form>
    </div>
</div>
@endsection
