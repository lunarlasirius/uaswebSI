@extends('layout.app')

@section('title', 'Fasilitas - Sistem Informasi')

@push('styles')
<style>
    .page-fasilitas {
        --blue-primary: #1769aa;
        --blue-dark: #0f3f6e;
        --accent-color: #00bcd4;
        --text-color: #343a40;
        --sub-text-color: #6c757d;
        --bg-color: #f8f9fa;
        --card-bg: #ffffff;

        --shadow-elevation: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .page-fasilitas .fasilitas-container {
        padding: 50px 15px;
        background-color: var(--bg-color);
    }

    /* === HEADER === */
    .page-fasilitas .facilities-title {
        font-weight: 900;
        font-size: 2.5rem;
        color: var(--blue-dark);
        margin-bottom: 5px;
        position: relative;
    }

    .page-fasilitas .facilities-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background-color: var(--accent-color);
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .page-fasilitas .facilities-subtitle {
        color: var(--sub-text-color);
        max-width: 700px;
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 0 auto;
    }

    /* === CARD === */
    .page-fasilitas .facility-card {
        border-radius: 1.25rem;
        overflow: hidden;
        transition: all .35s ease;
        box-shadow: var(--shadow-elevation);
        background: var(--card-bg);
        border: 1px solid rgba(0,0,0,.05);
    }

    .page-fasilitas .facility-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
        border-right: 5px solid var(--blue-primary);
    }

    .page-fasilitas .facility-img {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform .6s ease;
    }

    .page-fasilitas .facility-card:hover .facility-img {
        transform: scale(1.1);
    }

    .page-fasilitas .facility-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: .4rem .9rem;
        border-radius: 999px;
        font-size: .75rem;
        font-weight: 700;
        background: var(--accent-color);
        color: #000;
        letter-spacing: .08em;
        box-shadow: 0 2px 8px rgba(0,0,0,.2);
    }

    .page-fasilitas .card-title {
        font-weight: 800;
        color: var(--blue-dark);
    }

    .page-fasilitas .card-text {
        color: var(--sub-text-color);
        line-height: 1.6;
    }
</style>
@endpush

@section('content')
<div class="page-fasilitas">
    <div class="container fasilitas-container">

        <div class="mb-5 text-center">
            <h1 class="facilities-title mb-2">Fasilitas Jurusan Sistem Informasi</h1>
            <p class="facilities-subtitle">
                Beberapa fasilitas penunjang kegiatan akademik dan administrasi
                Jurusan Sistem Informasi.
            </p>
        </div>

        @if ($fasilitas->count())
            <div class="row g-5">
                @foreach ($fasilitas as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 facility-card">

                            @if ($item->foto)
                                @php
                                    $fotoUrl = $item->foto;
                                    if ($fotoUrl && !\Illuminate\Support\Str::startsWith($fotoUrl, ['http://', 'https://', 'storage/'])) {
                                        $fotoUrl = 'storage/' . ltrim($fotoUrl, '/');
                                    }
                                @endphp
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ asset($fotoUrl) }}"
                                         class="facility-img"
                                         alt="{{ $item->nama_fasilitas }}">
                                    <span class="facility-badge">Fasilitas</span>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_fasilitas }}</h5>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted text-center">Belum ada fasilitas yang terdaftar.</p>
        @endif

    </div>
</div>
@endsection
