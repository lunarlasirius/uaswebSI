@extends('layout.admin')

@section('title', 'Profil Jurusan')

@section('pageTitle', 'Profil Jurusan')
@section('pageSubtitle', 'Perbarui visi, misi, sejarah, sambutan, dan foto ketua jurusan.')
@section('breadcrumb', 'Pages/Profil Jurusan')

@section('adminContent')
<div class="container-fluid px-0">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Profil Jurusan</h5>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.profil.update') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Ketua --}}
                <div class="mb-3">
                    <label class="form-label">Nama Ketua Jurusan</label>
                    <input type="text"
                           name="nama_ketua"
                           class="form-control @error('nama_ketua') is-invalid @enderror"
                           value="{{ old('nama_ketua', $profil->nama_ketua ?? '') }}">
                    @error('nama_ketua')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Foto Ketua --}}
                <div class="mb-3">
                    <label class="form-label d-block">Foto Ketua Jurusan</label>

                    @if (!empty($profil->foto_ketua))
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . ltrim($profil->foto_ketua, '/')) }}"
                                 alt="Foto Ketua Jurusan"
                                 style="max-width: 160px; height: 160px; border-radius: 50%; object-fit: cover;">
                        </div>
                    @endif

                    <input type="file"
                           name="foto_ketua"
                           class="form-control @error('foto_ketua') is-invalid @enderror"
                           accept="image/*">
                    @error('foto_ketua')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengubah foto. Maksimal 5 MB.
                    </small>
                </div>

                {{-- Visi --}}
                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea name="visi"
                              rows="3"
                              class="form-control @error('visi') is-invalid @enderror">{{ old('visi', $profil->visi ?? '') }}</textarea>
                    @error('visi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Misi --}}
                <div class="mb-3">
                    <label class="form-label">Misi</label>
                    <textarea name="misi"
                              rows="4"
                              class="form-control @error('misi') is-invalid @enderror">{{ old('misi', $profil->misi ?? '') }}</textarea>
                    @error('misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sejarah --}}
                <div class="mb-3">
                    <label class="form-label">Sejarah</label>
                    <textarea name="sejarah"
                              rows="4"
                              class="form-control @error('sejarah') is-invalid @enderror">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
                    @error('sejarah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sambutan Ketua --}}
                <div class="mb-3">
                    <label class="form-label">Sambutan Ketua Jurusan</label>
                    <textarea name="sambutan_ketua"
                              rows="5"
                              class="form-control @error('sambutan_ketua') is-invalid @enderror">{{ old('sambutan_ketua', $profil->sambutan_ketua ?? '') }}</textarea>
                    @error('sambutan_ketua')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection