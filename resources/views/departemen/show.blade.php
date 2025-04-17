@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Departemen</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">ID</dt>
            <dd class="col-sm-8">{{ $departemen->id }}</dd>

            <dt class="col-sm-4">Kode Departemen</dt>
            <dd class="col-sm-8">{{ $departemen->kode_departemen }}</dd>

            <dt class="col-sm-4">Nama Departemen</dt>
            <dd class="col-sm-8">{{ $departemen->nama_departemen }}</dd>

            <dt class="col-sm-4">Dibuat Pada</dt>
            <dd class="col-sm-8">{{ $departemen->created_at }}</dd>

            <dt class="col-sm-4">Diperbarui Pada</dt>
            <dd class="col-sm-8">{{ $departemen->updated_at }}</dd>
        </dl>
        <a href="{{ route('departemen.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
