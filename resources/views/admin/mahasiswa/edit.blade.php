@extends('layout.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Edit Mahasiswa</h1>

    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary btn-sm mb-3">
        &laquo; Kembali ke daftar
    </a>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Foto Mahasiswa</label>

                    @if ($mahasiswa->foto)
                        <div class="mb-2">
                            <img src="{{ asset($mahasiswa->foto) }}" 
                                alt="Foto mahasiswa"
                                style="max-width: 120px; border-radius:8px;">
                        </div>
                    @endif

                    <input type="file" name="foto"
                        class="form-control @error('foto') is-invalid @enderror">

                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">NPM</label>
                    <input type="text" name="npm"
                           class="form-control @error('npm') is-invalid @enderror"
                           value="{{ old('npm', $mahasiswa->npm) }}" required>
                    @error('npm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $mahasiswa->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat"
                              class="form-control @error('alamat') is-invalid @enderror"
                              rows="2">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Angkatan</label>
                        <input type="number" name="angkatan"
                               class="form-control @error('angkatan') is-invalid @enderror"
                               value="{{ old('angkatan', $mahasiswa->angkatan) }}">
                        @error('angkatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp"
                               class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp', $mahasiswa->no_hp) }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Dosen Pembimbing</label>
                        <input type="text" name="dosen_pembimbing"
                               class="form-control @error('dosen_pembimbing') is-invalid @enderror"
                               value="{{ old('dosen_pembimbing', $mahasiswa->dosen_pembimbing) }}">
                        @error('dosen_pembimbing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">
                    Update Mahasiswa
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
