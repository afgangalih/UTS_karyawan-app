<!-- resources/views/pegawai/dashboard.blade.php -->
@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Selamat Datang, {{ Auth::user()->nama }}</h4>
                <p class="card-text">Anda login sebagai Pegawai</p>
            </div>
        </div>
    </div>
</div>

@if($karyawan)
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Pribadi</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">NIK</th>
                        <td>{{ $karyawan->nik }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $karyawan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $karyawan->email }}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>{{ $karyawan->no_telepon }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $karyawan->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Departemen</th>
                        <td>{{ $karyawan->departemen ? $karyawan->departemen->nama_departemen : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $karyawan->jabatan ? $karyawan->jabatan->nama_jabatan : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk</th>
                        <td>{{ date('d-m-Y', strtotime($karyawan->tanggal_masuk)) }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-warning mt-4">
    Data karyawan Anda belum terdaftar dalam sistem. Silahkan hubungi administrator.
</div>
@endif
@endsection