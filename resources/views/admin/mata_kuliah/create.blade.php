@extends('layout.app')

@section('title', 'Tambah Mata Kuliah')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="container mt-4">
    <h3 class="mb-3">Tambah Mata Kuliah</h3>

    <form action="{{ route('admin.mata_kuliah.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Kode MK</label>
            <input type="text" name="kode_mk" class="form-control"
                   value="{{ old('kode_mk') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" class="form-control"
                   value="{{ old('nama_mk') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <input type="number" name="semester" class="form-control"
                   value="{{ old('semester') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">SKS</label>
            <input type="number" name="sks" class="form-control"
                   value="{{ old('sks') }}">
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('admin.mata_kuliah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
