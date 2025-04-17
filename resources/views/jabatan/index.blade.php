@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('jabatan/create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Tambah Jabatan
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-sm" id="table_jabatan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jabatan</th>
                    <th>Nama Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
    $('#table_jabatan').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('jabatan.list') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode_jabatan' },
            { data: 'nama_jabatan' },
            { data: 'aksi', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
