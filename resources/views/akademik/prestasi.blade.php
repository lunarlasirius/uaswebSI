@extends('layout.app')

@section('title', 'Prestasi - Sistem Informasi')

@push('styles')
<style>
    .prestasi-wrap{
        --blue-primary: #1769aa;
        --blue-dark: #0f3f6e;
        --accent-color: #00bcd4;
        --sub-text-color: #6c757d;
        --shadow-elevation: 0 10px 30px rgba(0,0,0,.08);
        --shadow-hover: 0 15px 40px rgba(0,0,0,.15);

        padding: 2.75rem 0 1.5rem;
    }

    /* ===== Header (center) ===== */
    .prestasi-title{
        font-weight: 900;
        font-size: 2.5rem;
        color: var(--blue-dark);
        letter-spacing: .2px;
        text-align: center;
        margin-bottom: .35rem;
        position: relative;
    }
    .prestasi-title::after{
        content:'';
        display:block;
        width: 80px;
        height: 4px;
        background: var(--accent-color);
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .prestasi-subtitle{
        text-align: center;
        color: var(--sub-text-color);
        max-width: 720px;
        margin: 0 auto 1.8rem;
        font-size: 1.05rem;
        line-height: 1.6;
    }

    /* ===== Card ===== */
    .prestasi-card{
        border: 1px solid rgba(0,0,0,.06);
        border-radius: 1.25rem;
        overflow: hidden;
        background: #fff;
        box-shadow: var(--shadow-elevation);
        transition: transform .35s ease, box-shadow .35s ease, border-right .35s ease;
        position: relative;
    }
    .prestasi-card:hover{
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
        border-right: 5px solid var(--blue-primary);
    }

    .prestasi-cover{
        position: relative;
        height: 190px;
        overflow: hidden;
        background: #f1f3f5;
    }
    .prestasi-cover img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .6s cubic-bezier(.25,.46,.45,.94);
    }
    .prestasi-card:hover .prestasi-cover img{
        transform: scale(1.08);
    }

    .prestasi-cover::before{
        content: "Prestasi";
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        letter-spacing: .08em;
        color: rgba(15,63,110,.18);
        text-transform: uppercase;
        font-size: 1.05rem;
    }
    .prestasi-cover.has-img::before{ content: ""; }

    .prestasi-badge{
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: .35rem .85rem;
        border-radius: 999px;
        font-size: .75rem;
        font-weight: 800;
        background: var(--accent-color);
        color: #0b2239;
        box-shadow: 0 6px 18px rgba(0,0,0,.18);
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    /* ===== Body ===== */
    .prestasi-body{
        padding: 1.15rem 1.2rem 1.25rem;
    }

    .prestasi-meta{
        display: flex;
        align-items: center;
        gap: .55rem;
        color: var(--sub-text-color);
        font-size: .85rem;
        margin-bottom: .55rem;
    }
    .prestasi-meta .dot{
        width: 4px; height: 4px; border-radius: 999px;
        background: rgba(108,117,125,.65);
        display: inline-block;
    }

    .prestasi-item-title{
        font-weight: 900;
        letter-spacing: -.01em;
        margin-bottom: .45rem;
        line-height: 1.25;
        color: #111827;
    }

    .prestasi-tagline{
        font-weight: 900;
        color: var(--blue-primary);
        text-transform: uppercase;
        letter-spacing: .08em;
        font-size: .78rem;
        margin-bottom: .55rem;
    }

    .prestasi-desc{
        color: rgba(33,37,41,.85);
        font-size: .95rem;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 768px){
        .prestasi-title{ font-size: 2rem; }
        .prestasi-cover{ height: 210px; }
    }
</style>
@endpush

@section('content')
<div class="container prestasi-wrap">
    <h1 class="prestasi-title">Daftar Prestasi</h1>
    <p class="prestasi-subtitle">
        Jejak langkah keberhasilan Mahasiswa kami di berbagai bidang.
    </p>

    @if ($prestasi->count())
        <div class="row g-4">
            @foreach ($prestasi as $item)
                <div class="col-md-4">
                    <div class="prestasi-card h-100">

                        <div class="prestasi-cover {{ $item->foto ? 'has-img' : '' }}">
                            @if ($item->foto)
                                <img src="{{ asset($item->foto) }}" alt="{{ $item->judul }}">
                            @endif

                            <span class="prestasi-badge">
                                {{ $item->kategori ? ucfirst($item->kategori) : ($item->tingkat ?? 'Prestasi') }}
                            </span>
                        </div>

                        <div class="prestasi-body">
                            <div class="prestasi-meta">
                                <span>📅</span>
                                <span>{{ $item->tanggal ? $item->tanggal->format('d F Y') : '-' }}</span>
                            </div>

                            <h5 class="prestasi-item-title">{{ $item->judul }}</h5>

                            <div class="prestasi-tagline">
                                {{ $item->tingkat ? $item->tingkat : ($item->kategori ? ucfirst($item->kategori) : 'Jurusan Sistem Informasi') }}
                            </div>

                            <p class="prestasi-desc">
                                {{ \Illuminate\Support\Str::limit($item->deskripsi, 130) }}
                            </p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted text-center">Belum ada data prestasi yang tercatat.</p>
    @endif
</div>
@endsection