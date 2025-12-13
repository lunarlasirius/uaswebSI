@extends('layout.app')

@section('title', 'Dosen - Sistem Informasi')

@push('styles')
<style>
    .page-dosen{
        --blue-primary: #1769aa;
        --blue-dark: #0f3f6e;
        --accent-color: #00bcd4;
        --sub-text-color: #6c757d;
        --bg-color: #f8f9fa;

        --shadow-elevation: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .page-dosen .dosen-container{
        padding: 50px 15px;
        background: var(--bg-color);
    }

    /* Header */
    .page-dosen .dosen-title{
        font-weight: 900;
        font-size: 2.5rem;
        color: var(--blue-dark);
        margin-bottom: 6px;
        position: relative;
    }
    .page-dosen .dosen-title::after{
        content:'';
        display:block;
        width: 80px;
        height: 4px;
        background: var(--accent-color);
        margin: 10px auto 0;
        border-radius: 2px;
    }
    .page-dosen .dosen-subtitle{
        color: var(--sub-text-color);
        max-width: 760px;
        margin: 0 auto;
        font-size: 1.05rem;
        line-height: 1.6;
    }

    .page-dosen .dosen-card{
        border-radius: 1.25rem;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,.06);
        background: #fff;
        box-shadow: var(--shadow-elevation);
        transition: transform .35s ease, box-shadow .35s ease, border-right .35s ease;
        position: relative;
    }
    .page-dosen .dosen-card:hover{
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
        border-right: 5px solid var(--blue-primary);
    }

    .page-dosen .dosen-card .card-body{
        padding: 1.5rem 1.5rem 1.75rem;
    }

    .page-dosen .dosen-avatar{
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 999px;
        border: 4px solid rgba(23,105,170,.18);
        box-shadow: 0 10px 25px rgba(15,23,42,.12);
        background: #fff;
    }

    .page-dosen .dosen-avatar-fallback{
        width: 120px;
        height: 120px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(23,105,170,.08);
        border: 4px solid rgba(23,105,170,.18);
        color: var(--blue-dark);
        font-weight: 900;
        letter-spacing: .06em;
        box-shadow: 0 10px 25px rgba(15,23,42,.10);
    }

    .page-dosen .dosen-name{
        font-weight: 800;
        color: var(--blue-dark);
        margin-bottom: .25rem;
    }

    .page-dosen .dosen-meta{
        color: var(--sub-text-color);
        font-size: .92rem;
    }

    .page-dosen .dosen-badge{
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .35rem .75rem;
        border-radius: 999px;
        background: rgba(0,188,212,.18);
        color: #0b3a44;
        font-weight: 700;
        font-size: .8rem;
        margin-top: .65rem;
    }

    .page-dosen .dosen-section{
        margin-top: .9rem;
        text-align: left;
        background: rgba(248,249,250,.9);
        border: 1px solid rgba(15,23,42,.06);
        border-radius: .9rem;
        padding: .85rem 1rem;
    }

    .page-dosen .dosen-section strong{
        color: var(--blue-dark);
    }

    .page-dosen .dosen-email{
        word-break: break-word;
    }
</style>
@endpush

@section('content')
<div class="page-dosen">
    <div class="container dosen-container">

        <div class="text-center mb-5">
            <h1 class="dosen-title">Daftar Dosen Jurusan Sistem Informasi</h1>
            <p class="dosen-subtitle">
                Kenali dosen-dosen pengampu dan bidang keahlian di Jurusan Sistem Informasi.
            </p>
        </div>

        @if ($dosens->count())
            <div class="row g-5">
                @foreach ($dosens as $dosen)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 text-center dosen-card">
                            <div class="card-body">

                                @if ($dosen->foto)
                                    <img src="{{ asset($dosen->foto) }}"
                                         alt="{{ $dosen->nama }}"
                                         class="dosen-avatar mb-3">
                                @else
                                    <div class="dosen-avatar-fallback mb-3">
                                        {{ \Illuminate\Support\Str::substr($dosen->nama, 0, 2) }}
                                    </div>
                                @endif

                                <h5 class="dosen-name">{{ $dosen->nama }}</h5>
                                <div class="dosen-meta">NIDN: {{ $dosen->nidn }}</div>

                                <div class="dosen-badge">
                                    Bidang Keahlian
                                </div>

                                <div class="dosen-section">
                                    <div class="mb-0">
                                        {{ $dosen->bidang_keahlian }}
                                    </div>

                                    @if ($dosen->email)
                                        <hr class="my-2">
                                        <div class="dosen-meta dosen-email">
                                            <strong>Email:</strong> {{ $dosen->email }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted text-center">Data dosen belum tersedia.</p>
        @endif

    </div>
</div>
@endsection
