@extends('layout.app')

@section('title', 'Beranda - Jurusan Sistem Informasi')

@section('content')

<style>
    :root {
        --blue-dark: #0f3f6e; 
        --blue-light: #1769aa;   
        --primary-accent: #00bcd4;
        --secondary-accent: #ffc107; 
        
        --text-dark: #212529; 
        --text-light: #5a646e; 
        --bg-light: #f4f7f9;    
        --card-bg: #ffffff;
        
        --shadow-elevation: 0 8px 20px rgba(0, 0, 0, 0.1);
        --shadow-hover: 0 15px 35px rgba(0, 50, 100, 0.2);
    }

    /* === 1. HERO HEADER  === */
    .home-hero {
        position: relative;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white; 
        padding: 170px 0;
    }

    .home-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 63, 110, 0.95) 0%, rgba(23, 105, 170, 0.6) 100%);
        backdrop-filter: blur(1px); 
        z-index: 0;
    }

    .home-hero-content {
        position: relative;
        z-index: 1; 
    }

    .home-hero-title {
        font-weight: 900 !important; 
        font-size: clamp(2.8rem, 4.5vw, 4rem); 
        line-height: 1.1;
        margin-bottom: 20px !important;
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
    }

    .home-hero-title span {
        color: var(--primary-accent); 
    }

    .home-hero-subtitle {
        max-width: 700px;
        font-size: 1.2rem;
        opacity: 0.95;
        border-left: 4px solid var(--primary-accent); 
        padding-left: 15px;
    }

    /* === 2. SAMBUTAN KETUA JURUSAN === */
    .container > section:first-of-type {
        background-color: var(--card-bg);
        border-radius: 15px;
        padding: 50px;
        box-shadow: var(--shadow-elevation); 
        transition: transform 0.3s ease, box-shadow 0.4s ease;
    }
    .container > section:first-of-type:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .container > section:first-of-type img {
=        box-shadow: 0 0 0 5px var(--bg-light), 0 0 0 10px var(--primary-accent); 
        transition: all 0.4s ease;
    }
    .container > section:first-of-type:hover img {
        box-shadow: 0 0 0 5px var(--bg-light), 0 0 0 12px var(--blue-light);
    }
    
    .container > section:first-of-type h2 {
        font-weight: 800 !important;
        color: var(--blue-dark);
        position: relative;
    }
    .container > section:first-of-type h2::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background-color: var(--primary-accent);
        margin-top: 5px;
        border-radius: 2px;
    }

    .container > section:first-of-type .btn-link {
        color: var(--blue-light) !important;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .container > section:first-of-type .btn-link:hover {
        color: var(--primary-accent) !important;
        text-decoration: underline;
    }

    .container > section:first-of-type .border-start {
        border-left: 5px solid var(--blue-light) !important;
        padding-left: 20px;
        line-height: 1.7;
        color: var(--text-light);
    }
    
    /* === 3. KUMPULAN BERITA  === */
    .container > section:nth-of-type(2) {
        padding: 50px 0;
        background-color: var(--bg-light);
        margin-top: 40px;
        border-radius: 15px;
    }
    
    .container > section:nth-of-type(2) h2 {
        font-weight: 800 !important;
        color: var(--blue-dark);
        margin-bottom: 25px;
    }

    .container > section:nth-of-type(2) .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: var(--shadow-elevation);
        background: var(--card-bg);
        position: relative;
        border-bottom: 4px solid transparent; 
    }

    .container > section:nth-of-type(2) .card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
        border-bottom-color: var(--primary-accent);
    }

    .container > section:nth-of-type(2) .card-img-top {
        height: 220px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .container > section:nth-of-type(2) .card:hover .card-img-top {
        transform: scale(1.1);
    }
    
    .container > section:nth-of-type(2) .card-title {
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--blue-dark);
    }

    .container > section:nth-of-type(2) .btn-primary {
        background: var(--blue-light);
        border-color: var(--blue-light);
        transition: background 0.3s ease, transform 0.3s ease;
        font-weight: 600 !important;
    }

    .container > section:nth-of-type(2) .btn-primary:hover {
        background: var(--primary-accent);
        border-color: var(--primary-accent);
        transform: scale(1.05);
    }
    
    .container > section:nth-of-type(2) .btn-outline-primary {
        color: var(--blue-light);
        border-color: var(--blue-light);
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .container > section:nth-of-type(2) .btn-outline-primary:hover {
        background-color: var(--blue-light);
        color: white;
    }

    /* === 4. HOME FOOTER === */
    .home-footer{
        background: var(--blue-dark); 
        color: rgba(255,255,255,.92);
        padding: 60px 0 30px; 
        margin-top: 0;
    }
    .home-footer h6{
        font-weight: 900 !important;
        letter-spacing: .5px;
        margin-bottom: 1.2rem;
        color: var(--primary-accent); 
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 5px;
    }
    .home-footer a{
        color: rgba(255,255,255,.82);
        text-decoration: none;
        transition: .18s ease;
    }
    .home-footer a:hover{
        color: var(--secondary-accent); 
        text-decoration: none;
    }
    .home-footer .footer-links, .home-footer .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: .55rem;
    }
    .home-footer .footer-desc {
        color: rgba(255,255,255,.75);
        max-width: 320px;
        margin-bottom: 1.5rem;
        font-size: .95rem;
        line-height: 1.6;
    }

    .home-footer .social{
        display:flex;
        gap:.5rem;
        margin-top:.5rem;
    }
    .home-footer .social a{
        width: 30px; 
        height: 30px;
        border-radius: 999px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        background: rgba(255,255,255,.10);
        border: none;
        color: white; 
        transition: all .2s ease;
        text-decoration:none !important;
    }
    .home-footer .social a:hover{
        background: var(--primary-accent);
        color: var(--blue-dark); 
        transform: translateY(-1px);
    }
    .home-footer .icon{
        width: 16px; 
        height: 16px;
        flex: 0 0 16px;
    }

    .home-footer .contact-item{
        display:flex;
        gap:.6rem;
        align-items:flex-start;
        color: rgba(255,255,255,.82);
        font-size: .95rem;
    }
    .home-footer .contact-item .icon {
        color: var(--primary-accent);
        width: 18px; 
        height: 18px;
    }
    
    .home-footer .copyright{
        border-top: 1px solid rgba(255,255,255,.1);
        padding-top: 15px;
        margin-top: 30px;
        font-size: 0.9rem;
    }

    @media(max-width: 767.98px){
        .home-footer{ padding: 40px 0; }
        .home-footer .footer-desc{ max-width: 100%; }
    }
</style>

{{-- HERO HEADER --}}
<section class="home-hero"
    style="background-image: url('{{ asset('img/jurusan.jpg') }}')">

    <div class="container home-hero-content">
        <div class="row">
            <div class="col-md-7">
                <h1 class="home-hero-title mb-3">
                    Selamat Datang di Website Jurusan
                    <span class="text-primary fw-bold">Sistem Informasi</span>
                </h1>

                <p class="home-hero-subtitle mb-0">
                    Website resmi Jurusan Sistem Informasi Universitas Musamus Merauke yang menyajikan informasi profil,
                    akademik, dosen, prestasi, dan berita terkini untuk mahasiswa, dosen,
                    dan masyarakat.
                </p>
            </div>
        </div>
    </div>

</section>

{{-- KONTEN UTAMA --}}
<div class="container py-5">

    {{-- Sambutan Ketua Jurusan --}}
    @if ($profil)
        <section class="mb-5">
            <div class="row align-items-center flex-md-row-reverse g-4">

                {{-- FOTO KETUA --}}
                <div class="col-md-4 text-center">
                    @if ($profil->foto_ketua)
                        @php
                            $fotoKetua = $profil->foto_ketua ?? null;
                            if ($fotoKetua && !\Illuminate\Support\Str::startsWith($fotoKetua, ['http://', 'https://', 'storage/'])) {
                                $fotoKetua = 'storage/' . ltrim($fotoKetua, '/');
                            }
                        @endphp
                        <img src="{{ asset($fotoKetua) }}"
                            alt="Foto Ketua Jurusan"
                            class="img-fluid rounded-circle"
                            style="max-width: 180px; height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-light border rounded-circle d-inline-flex
                                     align-items-center justify-content-center"
                             style="width: 180px; height: 180px;">
                            <span class="fw-bold text-muted">Foto Ketua</span>
                        </div>
                    @endif

                    <h5 class="mt-3 mb-0">{{ $profil->nama_ketua ?? 'Nama Ketua Belum Diatur' }}</h5>
                    <small class="text-muted">Ketua Jurusan Sistem Informasi</small>
                </div>

                {{-- SAMBUTAN --}}
                <div class="col-md-8">
                    <h2 class="fw-semibold mb-2">Sambutan Ketua Jurusan</h2>
                    <a href="{{ route('profil.jurusan') }}" class="btn btn-link ps-0 mb-3">
                        Baca selengkapnya tentang jurusan &raquo;
                    </a>

                    <div class="border-start ps-3" style="border-color:#0d6efd !important;">
                        {!! nl2br(e(Str::limit($profil->sambutan_ketua, 700))) !!}
                    </div>
                </div>

            </div>
        </section>
    @endif




    {{-- KUMPULAN BERITA --}}
    <section class="mb-5">
        <div class="text-center mb-4">
            <h2 class="fw-semibold mb-2">Kumpulan Berita</h2>
            <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-primary">
                Lihat semua berita
            </a>
        </div>

        @if ($beritaTerbaru->count())
            <div class="row g-4">
                @foreach ($beritaTerbaru as $item)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="overflow-hidden">
                                @php
                                    $gambarUrl = $item->gambar;
                                    if ($gambarUrl && !\Illuminate\Support\Str::startsWith($gambarUrl, ['http://', 'https://', 'storage/'])) {
                                        $gambarUrl = 'storage/' . ltrim($gambarUrl, '/');
                                    }
                                @endphp
                                @if ($item->gambar)
                                    <img src="{{ asset($gambarUrl) }}"
                                        class="card-img-top"
                                        alt="{{ $item->judul }}">
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($item->judul, 70) }}</h5>
                                <small class="text-muted mb-2">
                                    {{ $item->tanggal_publish ? $item->tanggal_publish->format('d M Y') : '' }}
                                </small>
                                <p class="card-text">
                                    {{ Str::limit(strip_tags($item->isi), 120) }}
                                </p>
                                <a href="{{ route('berita.show', $item->slug) }}"
                                   class="mt-auto btn btn-sm btn-primary">
                                    Baca selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted text-center">Belum ada berita yang dipublikasikan.</p>
        @endif
    </section>

</div>

{{-- FOOTER KHUSUS HOME --}}
<section class="home-footer">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-4">
                <h6>Sistem Informasi</h6>
                <p class="footer-desc">Jl. Kamizaun, Mopah Lama, Rimba Jaya, Kec. Merauke, Kabupaten Merauke, Papua Selatan 99611</p>

                <div class="social">
                    {{-- Facebook --}}
                    <a href="#" aria-label="Facebook">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22 12a10 10 0 1 0-11.5 9.9v-7H8v-3h2.5V9.5A3.5 3.5 0 0 1 14.2 6h2.3v3h-2.3c-.7 0-.9.3-.9.9V12H16l-.5 3h-2.2v7A10 10 0 0 0 22 12z"/>
                        </svg>
                    </a>

                    {{-- Instagram --}}
                    <a href="#" aria-label="Instagram">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm10 2H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3zm-5 4a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm6.2-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/>
                        </svg>
                    </a>

                    {{-- YouTube --}}
                    <a href="#" aria-label="YouTube">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21.6 7.2a3 3 0 0 0-2.1-2.1C17.8 4.6 12 4.6 12 4.6s-5.8 0-7.5.5A3 3 0 0 0 2.4 7.2 31 31 0 0 0 2 12a31 31 0 0 0 .4 4.8 3 3 0 0 0 2.1 2.1c1.7.5 7.5.5 7.5.5s5.8 0 7.5-.5a3 3 0 0 0 2.1-2.1A31 31 0 0 0 22 12a31 31 0 0 0-.4-4.8zM10 15.2V8.8L16 12l-6 3.2z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <h6>Tautan Cepat</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('profil.jurusan') }}">Profil Jurusan</a></li>
                    <li><a href="{{ route('profil.dosen') }}">Dosen</a></li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h6>Kontak Kami</h6>
                <ul class="footer-contact">
                    <li class="contact-item">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2a7 7 0 0 1 7 7c0 5-7 13-7 13S5 14 5 9a7 7 0 0 1 7-7zm0 9.5A2.5 2.5 0 1 0 12 6.5a2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                        <span>Papua Selatan Indonesia</span>
                    </li>
                    <li class="contact-item">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.6 10.8a15.6 15.6 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.2c1.1.4 2.3.6 3.6.6a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.4 21 3 13.6 3 4a1 1 0 0 1 1-1h3.6a1 1 0 0 1 1 1c0 1.3.2 2.5.6 3.6a1 1 0 0 1-.2 1L6.6 10.8z"/>
                        </svg>
                        <span>08123456789</span>
                    </li>
                    <li class="contact-item">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z"/>
                        </svg>
                        <span>Sisteminformasi@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection