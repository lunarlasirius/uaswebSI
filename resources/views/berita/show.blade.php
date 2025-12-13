@extends('layout.app')

@section('title', $berita->judul . ' - Berita')

@section('content')
@push('styles')
<style>
    .back-link {
        font-weight: 600;
        text-decoration: none;
        color: #0d6efd;
    }
    .back-link:hover {
        text-decoration: underline;
    }

    /* ===== JUDUL BERITA ===== */
    .news-title {
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.02em;
    }

    /* ===== META INFO ===== */
    .news-meta {
        font-size: .85rem;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: .75rem;
        margin-bottom: 1.5rem;
    }

    /* ===== GAMBAR UTAMA ===== */
    .news-image-wrapper {
        margin-bottom: 2rem;
    }
    .news-image-wrapper img {
        border-radius: 1rem;
        box-shadow: 0 1rem 2.5rem rgba(15,23,42,.2);
    }

    /* ===== ISI ARTIKEL ===== */
    .news-content {
        font-size: 1rem;
        line-height: 1.85;
        color: #1f2937;
    }

    .news-content p {
        margin-bottom: 1.2rem;
    }

    .news-content h2,
    .news-content h3,
    .news-content h4 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .news-content ul,
    .news-content ol {
        padding-left: 1.2rem;
        margin-bottom: 1.2rem;
    }

    .news-content blockquote {
        border-left: 4px solid #0d6efd;
        padding-left: 1rem;
        color: #374151;
        font-style: italic;
        background: #f8fafc;
        padding: 1rem 1.2rem;
        border-radius: .5rem;
        margin: 1.5rem 0;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 767.98px) {
        .news-title {
            font-size: 1.6rem;
        }
    }
</style>
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <a href="{{ route('berita.index') }}" class="btn btn-link ps-0 mb-3 back-link">
                &laquo; Kembali ke daftar berita
            </a>

            <h1 class="news-title mb-2">{{ $berita->judul }}</h1>

            <div class="news-meta">
                {{ $berita->tanggal_publish ? $berita->tanggal_publish->format('d M Y') : '' }}
                @if ($berita->penulis)
                    • Oleh {{ $berita->penulis->name }}
                @endif
            </div>

            @if ($berita->gambar)
                <div class="mb-4 text-center">
                    <img src="{{ asset($berita->gambar) }}" 
                         alt="{{ $berita->judul }}" 
                         class="img-fluid rounded"
                         style="max-height: 400px; object-fit: cover;">
                </div>
            @endif

            <article class="news-content mb-5">
                {!! $berita->isi !!}
            </article>

        </div>
    </div>
</div>
@endsection