@extends('layouts.template')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools d-flex align-items-center">
            <a class="btn btn-sm btn-primary mt-1 w-100" href="{{ url('karyawan/create') }}">
                <i class="fa fa-plus"></i> Tambah Karyawan
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-4">
                <label for="departemen_id">Filter Departemen:</label>
                <select class="form-control" id="departemen_id" name="departemen_id">
                    <option value="">- Semua -</option>
                    @foreach($departemen as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_departemen }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Departemen</small>
            </div>
            <div class="col-md-4">
                <label for="user_id">Filter Pengguna:</label>
                <select class="form-control" id="user_id" name="user_id">
                    <option value="">- Semua -</option>
                    @foreach($user as $item)
                        <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Pengguna</small>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_karyawan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Pengguna</th> <!-- Kolom baru -->
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    $(document).ready(function() {
        var dataKaryawan = $('#table_karyawan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('karyawan.list') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: function(d) {
                    d.departemen_id = $('#departemen_id').val();
                    d.user_id = $('#user_id').val(); // Tambahkan filter user_id
                }
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "nik" },
                { data: "nama" },
                { data: "jenis_kelamin", className: "text-center" },
                { data: "nama_departemen" },
                { data: "nama_jabatan" },
                { data: "nama_user" }, // Kolom baru untuk nama pengguna
                { data: "tanggal_masuk" },
                { data: "aksi", className: "text-center", orderable: false, searchable: false }
            ]
        });

        $('#departemen_id, #user_id').on('change', function() {
            dataKaryawan.ajax.reload(); // Refresh tabel saat filter berubah
        });
    });
</script>
@endpush