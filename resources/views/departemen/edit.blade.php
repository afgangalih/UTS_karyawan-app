@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Departemen</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('departemen.update', $departemen->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Departemen</label>
                <input type="text" name="kode_departemen" class="form-control @error('kode_departemen') is-invalid @enderror" value="{{ old('kode_departemen', $departemen->kode_departemen) }}" required>
                @error('kode_departemen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Departemen</label>
                <input type="text" name="nama_departemen" class="form-control @error('nama_departemen') is-invalid @enderror" value="{{ old('nama_departemen', $departemen->nama_departemen) }}" required>
                @error('nama_departemen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('departemen.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
