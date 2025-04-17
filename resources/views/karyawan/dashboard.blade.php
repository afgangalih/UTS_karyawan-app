@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Dashboard Karyawan</h1>
                <p>Selamat datang, {{ auth()->user()->nama }}!</p>
                <div class="card">
                    <div class="card-body">
                        <h5>Informasi Profil</h5>
                        <p><strong>Username:</strong> {{ auth()->user()->username }}</p>
                        <p><strong>Level:</strong> {{ auth()->user()->level->nama_level ?? 'N/A' }}</p>
                        @if(auth()->user()->karyawan)
                            <p><strong>Nama Karyawan:</strong> {{ auth()->user()->karyawan->nama }}</p>
                            <p><strong>Departemen:</strong> {{ auth()->user()->karyawan->departemen->nama ?? 'N/A' }}</p>
                            <p><strong>Jabatan:</strong> {{ auth()->user()->karyawan->jabatan->nama ?? 'N/A' }}</p>
                        @else
                            <p>Data karyawan belum tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection