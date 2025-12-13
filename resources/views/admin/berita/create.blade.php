@extends('layout.app')

@section('title', 'Tambah Berita - Admin')

@push('styles')
<style>
    .form-card{
        border: 1px solid rgba(15,23,42,.08);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 .5rem 1.5rem rgba(15,23,42,.08);
    }
    .form-card .card-header{
        background: linear-gradient(180deg, rgba(13,110,253,.10), rgba(13,110,253,.02));
        border-bottom: 1px solid rgba(15,23,42,.06);
    }
    .form-hint{ font-size: .85rem; color: #6c757d; }
    .img-preview{
        width: 100%;
        max-height: 260px;
        object-fit: cover;
        border-radius: .75rem;
        border: 1px solid rgba(15,23,42,.08);
        display: none;
        margin-top: .75rem;
    }

    .form-actions{
        display: flex;
        justify-content: flex-end;
        gap: .75rem;
        align-items: center;
        margin-top: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="fw-bold mb-1">Tambah Berita</h1>
            <div class="text-muted">Buat berita baru untuk ditampilkan di halaman publik.</div>
        </div>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    <div class="card form-card">
        <div class="card-header py-3">
            <div class="fw-semibold">Form Berita</div>
        </div>

        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-2">Validasi gagal:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="penulis_id" value="{{ auth()->id() }}">

                <div class="row g-3">
                    <div class="col-lg-7">
                        <label class="form-label fw-semibold">Judul Berita</label>
                        <input type="text"
                               name="judul"
                               id="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}"
                               required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-lg-5">
                        <label class="form-label fw-semibold">Tanggal Publish</label>
                        <input type="date"
                               name="tanggal_publish"
                               class="form-control @error('tanggal_publish') is-invalid @enderror"
                               value="{{ old('tanggal_publish', now()->toDateString()) }}">
                        @error('tanggal_publish') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-lg-7">
                        <label class="form-label fw-semibold">Slug</label>
                        <input type="text"
                               name="slug"
                               id="slug"
                               class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug') }}"
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-lg-5">
                        <label class="form-label fw-semibold">Gambar (opsional)</label>
                        <input type="file"
                               name="gambar"
                               id="gambar"
                               class="form-control @error('gambar') is-invalid @enderror"
                               accept="image/*">
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-hint mt-1">Disarankan JPG/PNG, maksimal 2MB.</div>
                        <img id="preview" class="img-preview" alt="Preview gambar">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Isi Berita</label>
                        <textarea name="isi"
                                  rows="10"
                                  class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Tulis isi berita di sini..."
                                  required>{{ old('isi') }}</textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- tombol bawah: tidak berjauhan --}}
                <div class="form-actions">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const judul = document.getElementById('judul');
    const slug  = document.getElementById('slug');

    function toSlug(text){
        return text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    if (judul && slug) {
        judul.addEventListener('input', () => {
            if (!slug.value || slug.dataset.autofill === "1") {
                slug.value = toSlug(judul.value);
                slug.dataset.autofill = "1";
            }
        });

        slug.addEventListener('input', () => {
            slug.dataset.autofill = "0";
        });
    }

    const gambar = document.getElementById('gambar');
    const preview = document.getElementById('preview');

    if (gambar && preview){
        gambar.addEventListener('change', (e) => {
            const file = e.target.files?.[0];
            if (!file) { preview.style.display = 'none'; preview.src = ''; return; }
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        });
    }
</script>
@endpush
