@extends('layout.app')

@section('title', 'Profil Jurusan - Sistem Informasi')

@section('content')
<style>
    :root {
        --blue-start: #0a4c9b; 
        --blue-end: #008cff;   
        --primary-gradient: linear-gradient(90deg, var(--blue-start), var(--blue-end));
        
        --text-color: #495057; 
        --bg-color: #f4f7f9;   
        --card-bg: #ffffff;
    }

    body {
        background-color: var(--bg-color); 
    }

    .profile-container {
        background-color: var(--card-bg); 
        padding: 40px; 
    }

    .full-width-content {
        max-width: 1200px; 
        margin: 0 auto;
        padding-left: 20px;
        padding-right: 20px;
    }
    
    /* JUDUL UTAMA  */
    .profile-header h1 {
        color: var(--blue-start);
        font-size: 2.8rem;
        font-weight: 800 !important;
        padding-bottom: 10px;
        margin-bottom: 50px !important;
        position: relative;
        text-align: center; 
    }

    .profile-header h1::after {
        content: '';
        display: block;
        width: 150px; 
        height: 4px;
        background: var(--primary-gradient); 
        margin: 10px auto 0 auto; 
    }

    .department-info {
        background: var(--primary-gradient); 
        color: white; 
        padding: 30px; 
        border-radius: 12px; 
        margin-bottom: 50px !important;
        box-shadow: 0 10px 20px rgba(0, 76, 155, 0.2); 
        transition: transform 0.3s ease;
    }
    
    .department-info:hover {
        transform: translateY(-3px);
    }

    .department-info h4 {
        color: white;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    
    .department-info small {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .department-info img {
        filter: invert(1); 
        opacity: 0.9;
    }

    .profile-section {
        margin-bottom: 50px !important;
        text-align: center; 
    }

    .profile-section h3 {
        color: var(--blue-start);
        font-size: 1.8rem;
        margin-bottom: 25px;
        font-weight: 600;
        position: relative;
    }
    
    .profile-section h3::after {
        content: '';
        display: block;
        width: 50px; 
        height: 2px;
        background-color: var(--blue-end);
        margin: 5px auto 0 auto; 
    }

    .section-content {
        text-align: left; 
        
        padding: 30px; 
        line-height: 1.8; 
        color: var(--text-color);
        font-size: 1.05rem;
        background-color: var(--card-bg);
        border-radius: 10px; 
        border-left: 5px solid var(--blue-end); 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); 
        transition: box-shadow 0.3s ease;
        max-width: 900px; 
        margin: 0 auto; 
    }

    .section-content:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
    }

    /* SAMBUTAN KETUA */
    .ketua-sambutan {
        padding: 40px;
        background-color: var(--bg-color); 
        border-radius: 15px; 
    }
    
    .ketua-sambutan h3 {
        color: var(--blue-start);
        text-align: center; 
        margin-bottom: 40px;
    }

    .ketua-card {
        padding: 20px;
        border-radius: 12px;
        background: var(--card-bg);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .ketua-card img {
        border: 4px solid var(--blue-end); 
        box-shadow: 0 0 0 4px var(--card-bg); 
    }

    .ketua-text-content {
        line-height: 1.7;
        font-size: 1.1rem;
        border-left: 5px solid var(--blue-start) !important; 
        background-color: transparent !important;
        box-shadow: none !important;
        padding-left: 25px !important;
        text-align: left !important; 
    }
</style>

<div class="container-fluid py-4 profile-container">
    <div class="row justify-content-center">
        <div class="col-12 full-width-content">
            
            <div class="profile-header">
                <h1 class="fw-bold mb-2">Profil Jurusan Sistem Informasi</h1>
            </div>

            @if ($profil)
                @php
                    $logoJurusan = $profil->logo_jurusan ?? null;
                    if ($logoJurusan && !\Illuminate\Support\Str::startsWith($logoJurusan, ['http://', 'https://', 'storage/'])) {
                        $logoJurusan = 'storage/' . ltrim($logoJurusan, '/');
                    }
                    $fotoKetua = $profil->foto_ketua ?? null;
                    if ($fotoKetua && !\Illuminate\Support\Str::startsWith($fotoKetua, ['http://', 'https://', 'storage/'])) {
                        $fotoKetua = 'storage/' . ltrim($fotoKetua, '/');
                    }
                @endphp

                {{-- Logo + Nama Jurusan --}}
                <div class="d-flex align-items-center department-info">
                    @if ($logoJurusan)
                        <img src="{{ asset($logoJurusan) }}"
                            alt="Logo Jurusan"
                            class="me-4"
                            style="height:80px; width:auto; object-fit:contain;">
                    @endif
                    <div>
                        <h4 class="mb-0">{{ $profil->nama_jurusan ?? 'Jurusan Sistem Informasi' }}</h4>
                        <small>Program Studi Sistem Informasi</small>
                    </div>
                </div>

                {{-- Visi --}}
                <section class="profile-section">
                    <h3 class="fw-semibold">Visi</h3>
                    <div class="section-content">
                        {!! nl2br(e($profil->visi ?? '')) !!}
                    </div>
                </section>

                {{-- Misi --}}
                <section class="profile-section">
                    <h3 class="fw-semibold">Misi</h3>
                    <div class="section-content">
                        {!! nl2br(e($profil->misi ?? '')) !!}
                    </div>
                </section>

                {{-- Sejarah Jurusan --}}
                <section class="profile-section">
                    <h3 class="fw-semibold">Sejarah Jurusan</h3>
                    <div class="section-content">
                        {!! nl2br(e($profil->sejarah ?? '')) !!}
                    </div>
                </section>

                {{-- Sambutan Ketua Jurusan --}}
                <section class="mb-5 ketua-sambutan">
                    <h3 class="fw-semibold">Sambutan Ketua Jurusan</h3>
                    <div class="row mt-3 align-items-start">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <div class="ketua-card">
                                @if ($fotoKetua)
                                    <img src="{{ asset($fotoKetua) }}"
                                        alt="Foto Ketua Jurusan"
                                        class="img-fluid rounded-circle mb-2"
                                        style="max-width:150px; height:150px; object-fit:cover;">
                                @else
                                    <div class="bg-light border rounded-circle d-inline-flex
                                            align-items-center justify-content-center mb-2"
                                            style="width:150px; height:150px;">
                                        <span class="fw-bold text-muted" style="font-size:0.85rem;">
                                            Foto Ketua
                                        </span>
                                    </div>
                                @endif

                                <h6 class="mt-1 mb-0 fw-bold">{{ $profil->nama_ketua ?? 'Ketua Jurusan' }}</h6>
                                <small class="text-muted">Ketua Jurusan Sistem Informasi</small>
                            </div>
                        </div>

                        <div class="col-md-9 d-flex align-items-center">
                            <div class="section-content ketua-text-content w-100">
                                {!! nl2br(e($profil->sambutan_ketua ?? '')) !!}
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <p class="text-muted">Data profil jurusan belum tersedia.</p>
            @endif

        </div>
    </div>
</div>
@endsection