@extends('layout.app')

@section('title', 'Struktur Organisasi - Sistem Informasi')

@push('styles')
<style>
    .org-wrap{
        --blue-primary: #1769aa;
        --blue-dark: #0f3f6e;
        --accent-color: #00bcd4;
        --sub-text-color: #6c757d;
        --bg-color: #f8f9fa;

        --shadow-elevation: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.15);

        padding: 2.75rem 0 1.25rem;
    }

    /* Header */
    .org-title{
        font-weight: 900;
        font-size: 2.5rem;
        color: var(--blue-dark);
        letter-spacing: .2px;
        margin-bottom: 6px;
        position: relative;
    }
    .org-title::after{
        content:'';
        display:block;
        width: 80px;
        height: 4px;
        background: var(--accent-color);
        margin: 10px auto 0;
        border-radius: 2px;
    }

    .org-subtitle{
        color: var(--sub-text-color);
        max-width: 760px;
        margin: 0 auto;
        font-size: 1.05rem;
        line-height: 1.6;
    }

    /* Card */
    .org-card{
        border: 1px solid rgba(0,0,0,.06);
        border-radius: 1.25rem;
        padding: 1.25rem;
        background: #fff;
        box-shadow: var(--shadow-elevation);
        transition: transform .35s ease, box-shadow .35s ease, border-right .35s ease;
        position: relative;
    }
    .org-card:hover{
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
        border-right: 5px solid var(--blue-primary);
    }

    /* Image */
    .org-image{
        max-width: 920px;
        width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
        cursor: zoom-in;
        object-fit: contain;
        border-radius: .9rem;
        border: 1px solid rgba(15,23,42,.08);
        background: #fff;
    }

    .org-hint{
        font-size: .95rem;
        color: var(--sub-text-color);
    }

    .org-modal-img{
        width: 100%;
        height: auto;
        border-radius: .75rem;
        border: 1px solid rgba(15,23,42,.08);
        background: #fff;
    }
    .modal-content{
        border-radius: 1rem !important;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,.25);
    }
    .modal-header{
        background: linear-gradient(180deg, rgba(23,105,170,.12), rgba(23,105,170,.03));
        border-bottom: 1px solid rgba(15,23,42,.08);
    }

    /* Responsive */
    @media (max-width: 768px){
        .org-title{ font-size: 2rem; }
        .org-card{ padding: 1rem; }
        .org-image{ border-radius: .75rem; }
    }
</style>
@endpush

@section('content')
<div class="container org-wrap">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h1 class="org-title mb-2">Struktur Organisasi Jurusan Sistem Informasi</h1>
        <p class="org-subtitle">
            Berikut adalah struktur organisasi Jurusan Sistem Informasi. Klik gambar untuk memperbesar.
        </p>
    </div>

    {{-- GAMBAR --}}
    <div class="org-card mb-3">
        <img
            src="{{ asset('img/Susunan Organisasi.png') }}"
            alt="Struktur Organisasi Jurusan Sistem Informasi"
            class="org-image"
            data-bs-toggle="modal"
            data-bs-target="#orgModal">
    </div>

    <p class="text-center org-hint">
        Tips: gunakan gambar resolusi tinggi agar saat zoom tetap jelas.
    </p>

</div>

<div class="modal fade" id="orgModal" tabindex="-1" aria-labelledby="orgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem; overflow:hidden;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="orgModalLabel">Struktur Organisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img
                    src="{{ asset('img/Susunan Organisasi.png') }}"
                    alt="Struktur Organisasi Jurusan Sistem Informasi"
                    class="org-modal-img">
            </div>
        </div>
    </div>
</div>
@endsection
