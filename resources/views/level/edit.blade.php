@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Level</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('level.update', $level->level_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Level</label>
                <input type="text" name="kode_level" class="form-control @error('kode_level') is-invalid @enderror" value="{{ old('kode_level', $level->kode_level) }}" required>
                @error('kode_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Level</label>
                <input type="text" name="nama_level" class="form-control @error('nama_level') is-invalid @enderror" value="{{ old('nama_level', $level->nama_level) }}" required>
                @error('nama_level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('level.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
