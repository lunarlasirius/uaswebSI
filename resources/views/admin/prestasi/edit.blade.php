@extends('layout.app')

@section('title', 'Edit Prestasi')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Edit Prestasi</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.prestasi.update', $prestasi->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Nama Prestasi</label>
            <input type="text"
                name="judul"
                id="judul"
                class="form-control @error('judul') is-invalid @enderror"
                value="{{ old('judul', $prestasi->judul) }}">
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Prestasi (opsional)</label>
            <input type="file"
                name="foto"
                id="foto"
                class="form-control @error('foto') is-invalid @enderror"
                accept="image/*">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if (!empty($prestasi->foto))
                <small class="text-muted d-block mt-2">Foto sekarang:</small>
                <img src="{{ asset($prestasi->foto) }}" class="img-thumbnail mt-1" style="max-width:180px;">
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Tingkat</label>
            <input type="text" name="tingkat"
                class="form-control @error('tingkat') is-invalid @enderror"
                value="{{ old('tingkat', $prestasi->tingkat) }}">
            @error('tingkat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun</label>
            <input type="number" name="tahun"
                class="form-control @error('tahun') is-invalid @enderror"
                value="{{ old('tahun', $prestasi->tahun) }}">
            @error('tahun')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" rows="4"
                    class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $prestasi->keterangan) }}</textarea>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
