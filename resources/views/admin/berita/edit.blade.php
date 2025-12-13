@extends('layout.app')

@section('title', 'Edit Berita - Admin')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Edit Berita</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.berita.update', $berita->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Berita</label>
                    <input type="text" 
                           name="judul" 
                           class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $berita->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Publish</label>
                    <input type="date" 
                           name="tanggal_publish" 
                           class="form-control @error('tanggal_publish') is-invalid @enderror"
                           value="{{ old('tanggal_publish', optional($berita->tanggal_publish)->format('Y-m-d')) }}">
                    @error('tanggal_publish')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if ($berita->gambar)
                    <div class="mb-3">
                        <label class="form-label d-block">Gambar Saat Ini</label>
                        <img src="{{ asset($berita->gambar) }}" 
                             alt="{{ $berita->judul }}" 
                             class="img-fluid mb-2"
                             style="max-height: 200px; object-fit: cover;">
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Ganti Gambar (opsional)</label>
                    <input type="file" 
                           name="gambar" 
                           class="form-control @error('gambar') is-invalid @enderror"
                           accept="image/*">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Berita</label>
                    <textarea name="isi" rows="8"
                              class="form-control @error('isi') is-invalid @enderror"
                              required>{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update Berita
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
