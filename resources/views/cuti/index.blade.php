@extends('layouts.template')

@push('css')
<style>
    .btn-sm {
        margin-right: 5px; /* Jarak antar tombol */
    }
</style>
@endpush

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
        <div class="card-tools">
            <a class="btn btn-sm btn-primary" href="{{ url('cuti/create') }}">
                <i class="fa fa-plus"></i> Tambah Pengajuan Cuti
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-sm" id="table_cuti">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"></div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $('#table_cuti').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('cuti.list') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                { data: 'nama_karyawan' },
                { data: 'jenis_cuti' },
                { data: 'tanggal_mulai' },
                { data: 'tanggal_selesai' },
                { data: 'alasan' },
                { data: 'status' },
                { data: 'aksi', orderable: false, searchable: false, className: 'text-center' },
            ]
        });
    });
</script>
@endpush