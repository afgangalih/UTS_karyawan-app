@extends('layouts.template')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Daftar Departemen</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary" href="{{ route('departemen.create') }}">
                <i class="fa fa-plus"></i> Tambah Departemen
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm" id="table_departemen">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Departemen</th>
                    <th>Nama Departemen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    $('#table_departemen').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('departemen.list') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            { data: "id", className: "text-center" },
            { data: "kode_departemen", className: "text-center" },
            { data: "nama_departemen" },
            { data: "aksi", className: "text-center", orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
