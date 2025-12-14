@extends('layout.admin')

@section('title', 'Tambah Fasilitas')

@section('pageTitle', 'Tambah Fasilitas')
@section('pageSubtitle', 'Tambahkan data fasilitas jurusan.')
@section('breadcrumb', 'Pages/Fasilitas/Tambah')

@section('adminContent')
<div class="container-fluid px-0">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Form Tambah Fasilitas</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.fasilitas.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas"
                           class="form-control @error('nama_fasilitas') is-invalid @enderror"
                           value="{{ old('nama_fasilitas') }}" required>
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="4">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Fasilitas</label>
                    <input type="file" name="foto"
                           class="form-control @error('foto') is-invalid @enderror"
                           accept="image/*">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        Maksimal 2 MB. Format: JPG, PNG, dll.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Fasilitas
                </button>
                <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-light">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>
@endsection