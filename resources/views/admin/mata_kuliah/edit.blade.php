@extends('layout.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Mata Kuliah</h3>

    <form action="{{ route('admin.mata_kuliah.update', $mataKuliah->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Kode MK</label>
            <input type="text" name="kode_mk" class="form-control"
                   value="{{ old('kode_mk', $mataKuliah->kode_mk) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" class="form-control"
                   value="{{ old('nama_mk', $mataKuliah->nama_mk) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Semester</label>
            <input type="number" name="semester" class="form-control"
                   value="{{ old('semester', $mataKuliah->semester) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">SKS</label>
            <input type="number" name="sks" class="form-control"
                   value="{{ old('sks', $mataKuliah->sks) }}">
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('admin.mata_kuliah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
