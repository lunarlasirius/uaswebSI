@extends('layout.app')

@section('title', 'Tambah Dosen')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Tambah Dosen</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.dosen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username Login Dosen</label>
            <input type="text"
                   name="username"
                   id="username"
                   class="form-control @error('username') is-invalid @enderror"
                   value="{{ old('username') }}"
                   placeholder="misal: dosen1" required>
            <small class="text-muted">
                Username ini harus sudah ada di tabel users dengan role = dosen.
            </small>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dosen</label>
            <input type="text"
                   name="nama"
                   id="nama"
                   class="form-control @error('nama') is-invalid @enderror"
                   value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- NIDN --}}
        <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text"
                   name="nidn"
                   id="nidn"
                   class="form-control @error('nidn') is-invalid @enderror"
                   value="{{ old('nidn') }}" required>
            @error('nidn')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Bidang Keahlian --}}
        <div class="mb-3">
            <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
            <input type="text"
                   name="bidang_keahlian"
                   id="bidang_keahlian"
                   class="form-control @error('bidang_keahlian') is-invalid @enderror"
                   value="{{ old('bidang_keahlian') }}">
            @error('bidang_keahlian')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nomor HP --}}
        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text"
                   name="no_hp"
                   id="no_hp"
                   class="form-control @error('no_hp') is-invalid @enderror"
                   value="{{ old('no_hp') }}">
            @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Foto --}}
        <div class="mb-3">
            <label for="foto" class="form-label">Foto (opsional)</label>
            <input type="file"
                   name="foto"
                   id="foto"
                   class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
