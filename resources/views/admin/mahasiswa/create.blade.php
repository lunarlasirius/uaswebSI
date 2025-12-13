@extends('layout.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Tambah Mahasiswa</h1>

    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary btn-sm mb-3">
        &laquo; Kembali ke daftar
    </a>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Foto Mahasiswa</label>
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
                           value="{{ old('npm') }}" required>
                    @error('npm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat"
                              class="form-control @error('alamat') is-invalid @enderror"
                              rows="2">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Angkatan</label>
                        <input type="number" name="angkatan"
                               class="form-control @error('angkatan') is-invalid @enderror"
                               value="{{ old('angkatan') }}">
                        @error('angkatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">No HP</label>
                        <input type="text" name="no_hp"
                               class="form-control @error('no_hp') is-invalid @enderror"
                               value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Dosen Pembimbing</label>
                        <input type="text" name="dosen_pembimbing"
                               class="form-control @error('dosen_pembimbing') is-invalid @enderror"
                               value="{{ old('dosen_pembimbing') }}">
                        @error('dosen_pembimbing')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>

                <p class="text-muted">
                    *Saat data disimpan, sistem otomatis membuat akun login untuk mahasiswa:
                    <br>Username = NPM, Password awal = <code>mahasiswa123</code>
                </p>

                <button type="submit" class="btn btn-primary">
                    Simpan Mahasiswa
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
