@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('karyawan') }}" class="form-horizontal">
            @csrf

<!-- User -->
<div class="form-group row">
    <label class="col-1 control-label col-form-label">User</label>
    <div class="col-11">
        <select class="form-control select2" id="user_id" name="user_id" required>
            <option value="">- Pilih User -</option>
            @foreach($user as $u) <!-- Ubah $users menjadi $user dan $user menjadi $u -->
                <option value="{{ $u->user_id }}" {{ old('user_id') == $u->user_id ? 'selected' : '' }}>
                    {{ $u->nama }} ({{ $u->username }})
                </option>
            @endforeach
        </select>
        @error('user_id')
            <small class="form-text text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>

            <!-- NIK -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">NIK</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required>
                    @error('nik')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Nama -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Nama</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Jenis Kelamin</label>
                <div class="col-11">
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">- Pilih Jenis Kelamin -</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Alamat</label>
                <div class="col-11">
                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Email</label>
                <div class="col-11">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- No Telepon -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Telepon</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                    @error('no_telepon')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Departemen -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Departemen</label>
                <div class="col-11">
                    <select class="form-control" id="departemen_id" name="departemen_id" required>
                        <option value="">- Pilih Departemen -</option>
                        @foreach($departemen as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_departemen }}</option>
                        @endforeach
                    </select>
                    @error('departemen_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Jabatan -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Jabatan</label>
                <div class="col-11">
                    <select class="form-control" id="jabatan_id" name="jabatan_id" required>
                        <option value="">- Pilih Jabatan -</option>
                        @foreach($jabatan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
                        @endforeach
                    </select>
                    @error('jabatan_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Tanggal Masuk -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Tanggal Masuk</label>
                <div class="col-11">
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                    @error('tanggal_masuk')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-sm btn-default ml-1" href="{{ url('karyawan') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <!-- Konten form Anda yang sudah ada -->
</div>
@endsection

@push('css')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 38px;
    }
</style>
@endpush

@push('js')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih User",
            allowClear: true
        });
    });
</script>
@endpush
