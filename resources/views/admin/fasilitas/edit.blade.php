@extends('layout.admin')

@section('title', 'Edit Fasilitas')

@section('pageTitle', 'Edit Fasilitas')
@section('pageSubtitle', 'Perbarui data fasilitas jurusan.')
@section('breadcrumb', 'Pages/Fasilitas/Edit')

@section('adminContent')
<div class="container-fluid px-0">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Edit Fasilitas</h5>
            <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-sm btn-outline-secondary">
                &laquo; Kembali
            </a>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.fasilitas.update', $fasilitas->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas"
                           class="form-control @error('nama_fasilitas') is-invalid @enderror"
                           value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" required>
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              rows="4">{{ old('deskripsi', $fasilitas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Foto Fasilitas</label>

                    @if ($fasilitas->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$fasilitas->foto) }}"
                                 alt="Foto {{ $fasilitas->nama_fasilitas }}"
                                 style="max-width: 260px; border-radius: .75rem; object-fit: cover;">
                        </div>
                    @endif

                    <input type="file" name="foto"
                           class="form-control @error('foto') is-invalid @enderror"
                           accept="image/*">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        Kosongkan jika tidak ingin mengubah foto.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Fasilitas
                </button>
                <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-light">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>
@endsection