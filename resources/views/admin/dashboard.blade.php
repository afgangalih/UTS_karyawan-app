@extends('layouts.template')

@section('content')
<div class="container-fluid">

 

    {{-- Welcome Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="mb-2">
                        <i class="fas fa-tachometer-alt text-primary me-2"></i> Dashboard Admin
                    </h3>
                    <p class="lead">Selamat Datang, <strong>{{ Auth::user()->nama }}</strong></p>
                    <p class="text-success">
                        <i class="fas fa-shield-alt me-1"></i> Anda login sebagai Administrator
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Management Cards --}}
    <div class="row">
        {{-- Karyawan --}}
        <div class="col-md-4">
            <div class="card h-100 border-left border-primary border-4 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-primary text-white rounded-circle p-3">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Data Karyawan</h5>
                        <p class="mb-2 text-muted">Kelola data karyawan perusahaan</p>
                        <a href="{{ route('karyawan.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-external-link-alt me-1"></i> Lihat Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Departemen --}}
        <div class="col-md-4">
            <div class="card h-100 border-left border-success border-4 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-success text-white rounded-circle p-3">
                        <i class="fas fa-building fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Data Departemen</h5>
                        <p class="mb-2 text-muted">Kelola data departemen perusahaan</p>
                        <a href="#" class="btn btn-sm btn-success">
                            <i class="fas fa-external-link-alt me-1"></i> Lihat Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jabatan --}}
        <div class="col-md-4">
            <div class="card h-100 border-left border-warning border-4 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-warning text-white rounded-circle p-3">
                        <i class="fas fa-briefcase fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Data Jabatan</h5>
                        <p class="mb-2 text-muted">Kelola data jabatan perusahaan</p>
                        <a href="#" class="btn btn-sm btn-warning text-white">
                            <i class="fas fa-external-link-alt me-1"></i> Lihat Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase">Total Karyawan</h6>
                        <h2>{{ $totalKaryawan }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase">Total Departemen</h6>
                        <h2>{{ $totalDepartemen }}</h2>
                    </div>
                    <i class="fas fa-building fa-3x opacity-75"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase">Total Jabatan</h6>
                        <h2>{{ $totalJabatan }}</h2>
                    </div>
                    <i class="fas fa-briefcase fa-3x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('styles')
<style>
    .border-left {
        border-left-width: 4px !important;
    }

    .card:hover {
        transform: translateY(-3px);
        transition: all 0.3s ease-in-out;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('scripts')
<!-- Font Awesome (pastikan sudah include juga di layout utama) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
@endsection
