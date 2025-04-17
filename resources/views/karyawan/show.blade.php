@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @isset($karyawan)
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID Karyawan</th>
                    <td>{{ $karyawan->karyawan_id }}</td>
                </tr>
                <tr>
                    <th>User Terkait</th>
                    <td>
                        @if($karyawan->user)
                             {{ $karyawan->user->username }}
                        @else
                            <span class="text-danger">Tidak terhubung ke user</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>NIK</th>
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
                    <th>Alamat</th>
                    <td>{{ $karyawan->alamat }}</td>
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
                    <th>Departemen</th>
                    <td>{{ $karyawan->departemen->nama_departemen ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $karyawan->jabatan->nama_jabatan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Dibuat Pada</th>
                    <td>{{ \Carbon\Carbon::parse($karyawan->created_at)->format('d-m-Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Diperbarui</th>
                    <td>{{ \Carbon\Carbon::parse($karyawan->updated_at)->format('d-m-Y H:i') }}</td>
                </tr>
            </table>
        @else
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @endisset
        <a href="{{ url('karyawan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
<style>
    .table th {
        width: 30%;
    }
    .table td {
        width: 70%;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        // Tambahkan script JS jika diperlukan
    });
</script>
@endpush