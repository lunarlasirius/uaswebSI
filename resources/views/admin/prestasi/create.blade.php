@extends('layout.app')

@section('title', 'Tambah Prestasi')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Tambah Prestasi</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Nama Prestasi</label>
            <input type="text"
                   name="judul"
                   id="judul"
                   class="form-control @error('judul') is-invalid @enderror"
                   value="{{ old('judul') }}"
                   required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Prestasi (opsional)</label>
            <input type="file"
                   id="foto"
                   name="foto"
                   class="form-control @error('foto') is-invalid @enderror"
                   accept="image/*">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tingkat" class="form-label">Tingkat (Misal: Nasional, Internasional)</label>
            <input type="text"
                   name="tingkat"
                   id="tingkat"
                   class="form-control @error('tingkat') is-invalid @enderror"
                   value="{{ old('tingkat') }}">
            @error('tingkat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number"
                   name="tahun"
                   id="tahun"
                   class="form-control @error('tahun') is-invalid @enderror"
                   value="{{ old('tahun') }}"
                   min="1900"
                   max="2100">
            @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan / Deskripsi Singkat</label>
            <textarea name="keterangan"
                      id="keterangan"
                      rows="4"
                      class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
