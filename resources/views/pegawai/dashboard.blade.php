@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            Selamat datang, {{ $karyawan->nama ?? 'User' }}!
        </div>
    </div>
@endsection
