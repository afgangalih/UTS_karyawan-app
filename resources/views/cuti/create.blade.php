@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Pengajuan Cuti</h3>
        <div class="card-tools">
            <a href="{{ url('cuti') }}" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <form action="{{ route('cuti.store') }}" method="POST">
 
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="karyawan_id">Nama Karyawan</label>
                <select name="karyawan_id" class="form-control" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($karyawan as $item)
                        <option value="{{ $item->karyawan_id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('karyawan_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jenis_cuti">Jenis Cuti</label>
                <select name="jenis_cuti" class="form-control" required>
                    <option value="">-- Pilih Jenis Cuti --</option>
                    <option value="tahunan">Tahunan</option>
                    <option value="sakit">Sakit</option>
                    <option value="izin">Izin</option>
                </select>
                @error('jenis_cuti')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" required>
                @error('tanggal_mulai')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" required>
                @error('tanggal_selesai')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alasan">Alasan</label>
                <textarea name="alasan" class="form-control" rows="3" required></textarea>
                @error('alasan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection