@extends('layout.app')

@section('title', 'Berita - Sistem Informasi')

@push('styles')
<style>
    .news-wrap{
        padding: 2.25rem 0 1.5rem;
    }

    /* ===== HEADER BERITA ===== */
    .news-page-title{
        text-align: center;
        margin-bottom: 2.25rem;
    }
    .news-page-title h1{
        font-weight: 900;
        letter-spacing: -0.02em;
        margin-bottom: .4rem;
    }
    .news-page-title p{
        max-width: 760px;
        margin: 0 auto;
        color: #6c757d;
        font-size: .95rem;
        line-height: 1.6;
    }
    .news-divider{
        width: 84px;
        height: 4px;
        border-radius: 999px;
        background: rgba(13,110,253,.9);
        margin: .9rem auto 0;
        box-shadow: 0 .5rem 1.2rem rgba(13,110,253,.18);
    }

    /* ===== CARD BERITA ===== */
    .news-card{
        border: 1px solid rgba(15,23,42,.08);
        border-radius: 1rem;
        overflow: hidden;
        background: #fff;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        box-shadow: 0 .35rem 1.2rem rgba(15,23,42,.08);
        height: 100%;
    }
    .news-card:hover{
        transform: translateY(-6px);
        box-shadow: 0 1rem 2.5rem rgba(15,23,42,.18);
        border-color: rgba(13,110,253,.18);
    }

    .news-cover{
        position: relative;
        height: 220px;
        overflow: hidden;
        background: #f1f3f5;
    }
    .news-cover img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .35s ease;
    }
    .news-card:hover .news-cover img{
        transform: scale(1.05);
    }

    .news-badge{
        position: absolute;
        top: .75rem;
        left: .75rem;
        padding: .28rem .65rem;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #fff;
        background: rgba(0,0,0,.55);
        backdrop-filter: blur(4px);
        box-shadow: 0 .35rem .9rem rgba(15,23,42,.22);
    }

    .news-body{
        padding: 1.05rem 1.1rem 1.15rem;
        display: flex;
        flex-direction: column;
        height: calc(100% - 220px);
    }

    .news-title{
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: .45rem;
        font-size: 1.05rem;
    }

    .news-meta{
        display: flex;
        flex-wrap: wrap;
        gap: .4rem .5rem;
        align-items: center;
        color: #6c757d;
        font-size: .82rem;
        margin-bottom: .6rem;
    }
    .news-dot{
        width: 4px;
        height: 4px;
        border-radius: 999px;
        background: rgba(108,117,125,.65);
        display: inline-block;
    }

    .news-excerpt{
        font-size: .92rem;
        line-height: 1.6;
        color: rgba(33,37,41,.88);
        margin: 0 0 1rem;
    }

    .news-btn{
        border-radius: .7rem;
        font-weight: 700;
        padding: .5rem .95rem;
        margin-top: auto;
    }

    .news-pagination .pagination{
        justify-content: center;
        margin-top: 1.25rem;
    }
    .news-pagination .page-link{
        border-radius: .65rem;
        margin: 0 .15rem;
    }

    /* ===== Responsive ===== */
    @media (max-width: 767.98px){
        .news-cover{ height: 200px; }
        .news-body{ height: calc(100% - 200px); }
    }
</style>
@endpush

@section('content')
<div class="container news-wrap">

    <div class="news-page-title">
        <h1>Berita Jurusan Sistem Informasi</h1>
        <p>
            Temukan informasi terbaru seputar kegiatan, pengumuman, dan berbagai agenda Jurusan Sistem Informasi.
        </p>
        <div class="news-divider"></div>
    </div>

    @if ($berita->count())
        <div class="row g-4">
            @foreach ($berita as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card">

                        @if ($item->gambar)
                            <div class="news-cover">
                                <img src="{{ asset($item->gambar) }}"
                                     alt="{{ $item->judul }}">
                                <span class="news-badge">Berita</span>
                            </div>
                        @else
                            <div class="news-cover d-flex align-items-center justify-content-center">
                                <span class="text-muted">Tidak ada gambar</span>
                            </div>
                        @endif

                        <div class="news-body">
                            <h5 class="news-title">{{ $item->judul }}</h5>

                            <div class="news-meta">
                                <span>📅</span>
                                <span>{{ $item->tanggal_publish ? $item->tanggal_publish->format('d M Y') : '-' }}</span>

                                @if ($item->penulis)
                                    <span class="news-dot"></span>
                                    <span> {{ $item->penulis->name }}</span>
                                @endif
                            </div>

                            <p class="news-excerpt">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 150) }}
                            </p>

                            <a href="{{ route('berita.show', $item->slug) }}"
                               class="btn btn-primary btn-sm news-btn">
                                Baca selengkapnya
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="news-pagination">
            {{ $berita->links() }}
        </div>
    @else
        <p class="text-muted text-center">Belum ada berita yang dipublikasikan.</p>
    @endif

</div>
@endsection