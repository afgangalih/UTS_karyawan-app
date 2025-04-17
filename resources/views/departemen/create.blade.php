@extends('layouts.template')
    
@section('title', 'Tambah Departemen')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Departemen Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('departemen.store') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kode_departemen" class="form-label">Kode Departemen</label>
                            <input type="text" 
                                   class="form-control @error('kode_departemen') is-invalid @enderror" 
                                   id="kode_departemen" 
                                   name="kode_departemen" 
                                   value="{{ old('kode_departemen') }}" 
                                   placeholder="Contoh: DEP001" 
                                   required>
                            @error('kode_departemen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_departemen" class="form-label">Nama Departemen</label>
                            <input type="text" 
                                   class="form-control @error('nama_departemen') is-invalid @enderror" 
                                   id="nama_departemen" 
                                   name="nama_departemen" 
                                   value="{{ old('nama_departemen') }}" 
                                   placeholder="Contoh: Teknologi Informasi" 
                                   required>
                            @error('nama_departemen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('departemen.index') }}" class="btn btn-secondary">
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
