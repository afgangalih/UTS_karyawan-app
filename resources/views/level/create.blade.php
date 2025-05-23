@extends('layouts.template')
    
@section('title', 'Tambah Level Karyawan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Level Karyawan Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('level.store') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kode_level" class="form-label">Kode Level</label>
                            <input type="text" 
                                   class="form-control @error('kode_level') is-invalid @enderror" 
                                   id="kode_level" 
                                   name="kode_level" 
                                   value="{{ old('kode_level') }}" 
                                   placeholder="Contoh: LVL001" 
                                   required>
                            @error('kode_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_level" class="form-label">Nama Level</label>
                            <input type="text" 
                                   class="form-control @error('nama_level') is-invalid @enderror" 
                                   id="nama_level" 
                                   name="nama_level" 
                                   value="{{ old('nama_level') }}" 
                                   placeholder="Contoh: Supervisor" 
                                   required>
                            @error('nama_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('level.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if($errors->any())
<script>
    $(document).ready(function() {
        // Scroll to first error
        $('html, body').animate({
            scrollTop: $('.is-invalid').first().offset().top - 100
        }, 500);
    });
</script>
@endif
@endsection