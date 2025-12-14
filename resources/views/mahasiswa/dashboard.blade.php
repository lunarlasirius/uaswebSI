@extends('layout.app')

@section('title', 'Dashboard Mahasiswa')

@push('styles')
<style>
    .mhs-dashboard{
        --primary-main: #007bff;
        --primary-dark: #004d9a;
        --accent-info: #00e5ff;
        --text-dark: #2c3e50;
        --text-muted: #7f8c8d;
        --bg-page: #f9fbfd;
        --bg-card: #ffffff;
        --shadow-focus: 0 8px 20px rgba(0, 0, 0, 0.10);
        --shadow-subtle: 0 4px 10px rgba(0, 0, 0, 0.05);

        background: var(--bg-page);
        padding: 50px 0;

        /* aman untuk HP dengan notch */
        padding-left: env(safe-area-inset-left);
        padding-right: env(safe-area-inset-right);
    }

    /* === 1. HEADER DASHBOARD === */
    .mhs-dashboard .dashboard-title{
        font-weight: 900;
        font-size: 2.5rem;
        color: var(--primary-dark);
        margin-bottom: 5px !important;
        position: relative;
        letter-spacing: -.02em;
    }
    .mhs-dashboard .dashboard-title::after{
        content: '';
        display: block;
        width: 70px;
        height: 4px;
        background-color: var(--primary-main);
        margin-top: 8px;
        border-radius: 2px;
    }
    .mhs-dashboard .dashboard-subtitle{
        color: var(--text-muted);
        margin-bottom: 0;
    }
    .mhs-dashboard .dashboard-subtitle strong{
        color: var(--primary-main);
        font-weight: 800;
    }

    /* === 2. KARTU RINGKASAN DATA === */
    .mhs-dashboard .info-card{
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: 1rem;
        box-shadow: var(--shadow-subtle);
        background: var(--bg-card);
        padding: 1rem;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        text-align: center;
        border-bottom: 5px solid transparent;
        height: 100%;
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
    }

    /* desktop hover */
    @media (hover:hover){
        .mhs-dashboard .info-card:hover{
            transform: translateY(-5px);
            box-shadow: var(--shadow-focus);
            border-bottom-color: var(--primary-main);
        }
    }
    /* mobile tap/active */
    .mhs-dashboard .info-card:active{
        transform: scale(.99);
        box-shadow: 0 6px 14px rgba(0,0,0,.10);
        border-bottom-color: var(--primary-main);
    }

    .mhs-dashboard .info-card h6{
        font-size: 0.85rem;
        font-weight: 800;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        line-height: 1.3;
    }
    .mhs-dashboard .info-card .value{
        font-size: 1.5rem;
        font-weight: 900;
        color: var(--primary-dark);
        word-break: break-word;
    }

    /* === 3. KARTU UTAMA === */
    .mhs-dashboard .profile-card,
    .mhs-dashboard .account-card{
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: 1.25rem;
        box-shadow: var(--shadow-focus);
        background: var(--bg-card);
        height: 100%;
        transition: transform .2s ease, box-shadow .2s ease;
        overflow: hidden;
        -webkit-tap-highlight-color: transparent;
    }

    /* Header kartu (scope aman) */
    .mhs-dashboard .profile-card .card-header,
    .mhs-dashboard .account-card .card-header{
        background-color: transparent !important;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 1.25rem 1.25rem 0 0 !important;
        padding: 1.1rem 1.25rem 1rem;
    }
    .mhs-dashboard .profile-card .card-header h5,
    .mhs-dashboard .account-card .card-header h5{
        font-weight: 900;
        color: var(--primary-dark);
        border-left: 5px solid var(--accent-info);
        padding-left: 14px;
        margin: 0;
        letter-spacing: -.01em;
    }

    .mhs-dashboard .profile-label{
        font-weight: 700;
        color: var(--text-muted);
        font-size: 0.92rem;
    }
    .mhs-dashboard .profile-value{
        color: var(--primary-dark);
        font-weight: 800;
        font-size: 1rem;
        word-break: break-word;
    }

    .mhs-dashboard .profile-card .card-body{
        padding: 1.25rem;
    }

    .mhs-dashboard .profile-card .row{
        padding-top: 6px;
        padding-bottom: 6px;
    }
    .mhs-dashboard .profile-card .row:not(:last-child){
        border-bottom: 1px dashed rgba(0, 0, 0, 0.06);
    }

    .mhs-dashboard .profile-photo-box{
        width: 100%;
        max-width: 150px;
        height: 200px;
        border-radius: 0.85rem;
        overflow: hidden;
        background: var(--bg-page);
        margin: 0 auto;
        border: 4px solid rgba(0,123,255,.85);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.10);
        position: relative;
    }
    .mhs-dashboard .profile-photo-box img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .25s ease;
        display: block;
    }

    @media (hover:hover){
        .mhs-dashboard .profile-photo-box:hover img{
            transform: scale(1.05);
        }
    }
    .mhs-dashboard .profile-photo-box:active img{
        transform: scale(1.02);
    }

    /* === 4. KARTU AKUN & LOGOUT === */
    .mhs-dashboard .account-card .card-body{
        padding: 1.25rem;
    }
    .mhs-dashboard .account-card h6{
        font-weight: 900;
        color: var(--primary-dark);
        margin-bottom: 1rem;
        letter-spacing: .06em;
    }
    .mhs-dashboard .account-card strong{
        color: var(--text-dark);
        font-weight: 800;
        margin-right: 6px;
    }
    .mhs-dashboard .account-card p{
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: .6rem;
    }

    .mhs-dashboard .logout-btn{
        background-color: #e74c3c;
        border-color: #e74c3c;
        color: white;
        font-weight: 800;
        border-radius: 0.85rem;
        padding: 0.7rem 1rem;
        transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        box-shadow: 0 8px 18px rgba(231, 76, 60, 0.25);
        touch-action: manipulation;
    }
    @media (hover:hover){
        .mhs-dashboard .logout-btn:hover{
            background-color: #c0392b;
            border-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(231, 76, 60, 0.28);
        }
    }
    .mhs-dashboard .logout-btn:active{
        transform: scale(.99);
    }

    /* === 5. RESPONSIVE (HP) === */
    @media (max-width: 767.98px){
        .mhs-dashboard{
            padding: 28px 0;
        }

        .mhs-dashboard .dashboard-title{
            font-size: 1.7rem;
        }
        .mhs-dashboard .dashboard-title::after{
            width: 56px;
            height: 3px;
        }

        .mhs-dashboard .info-card{
            padding: .95rem;
        }
        .mhs-dashboard .info-card .value{
            font-size: 1.25rem;
        }

        .mhs-dashboard .profile-card .card-body,
        .mhs-dashboard .account-card .card-body{
            padding: 1rem;
        }

        /* foto lebih besar dan proporsional di HP */
        .mhs-dashboard .profile-photo-box{
            max-width: 220px;
            height: 240px;
            border-width: 3px;
        }

        /* rapikan label/value kalau mepet */
        .mhs-dashboard .profile-label{
            margin-bottom: .15rem;
        }
    }

    /* reduce motion */
    @media (prefers-reduced-motion: reduce){
        .mhs-dashboard *{
            transition: none !important;
            scroll-behavior: auto !important;
        }
    }
</style>
@endpush

@section('content')
<div class="mhs-dashboard">
    <div class="container">

        {{-- HEADER --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <h3 class="dashboard-title mb-1">Dashboard Mahasiswa</h3>
                <p class="dashboard-subtitle">
                    Selamat datang, <strong>{{ $user->name }}</strong> (role: {{ ucfirst($user->role) }}).
                </p>
            </div>
        </div>

        <div class="row g-4 data-summary-row">
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <h6>Nomor Induk Mahasiswa</h6>
                    <div class="value">{{ $mahasiswa->npm ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="info-card">
                    <h6>Angkatan</h6>
                    <div class="value">{{ $mahasiswa->angkatan ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="info-card">
                    <h6>Dosen Pembimbing Akademik</h6>
                    <div class="value">{{ $mahasiswa->dosen_pembimbing ?? 'Belum Ditentukan' }}</div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-lg-8">
                <div class="card profile-card mb-4">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Detail Biodata</h5>
                    </div>

                    <div class="card-body">
                        @if ($mahasiswa)

                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <h6 class="fw-semibold mb-3 text-uppercase text-dark">Foto Diri</h6>
                                    @if ($mahasiswa->foto)
                                        @php
                                            $fotoUrl = $mahasiswa->foto;
                                            if ($fotoUrl && !\Illuminate\Support\Str::startsWith($fotoUrl, ['http://', 'https://', 'storage/'])) {
                                                $fotoUrl = 'storage/' . ltrim($fotoUrl, '/');
                                            }
                                        @endphp
                                        <div class="profile-photo-box mx-auto">
                                            <img src="{{ asset($fotoUrl) }}" alt="Foto {{ $mahasiswa->nama }}">
                                        </div>
                                    @else
                                        <div class="profile-photo-box d-flex align-items-center justify-content-center mx-auto">
                                            <span class="text-muted">Tidak ada foto</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-8">
                                    <h6 class="fw-semibold mb-3 text-uppercase text-dark">Informasi Pribadi</h6>

                                    <div class="row mb-3">
                                        <div class="col-sm-4 profile-label">Nama Lengkap</div>
                                        <div class="col-sm-8 profile-value">{{ $mahasiswa->nama ?? '-' }}</div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4 profile-label">NPM</div>
                                        <div class="col-sm-8 profile-value">{{ $mahasiswa->npm ?? '-' }}</div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4 profile-label">Alamat</div>
                                        <div class="col-sm-8 profile-value">{{ $mahasiswa->alamat ?? '-' }}</div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4 profile-label">Angkatan</div>
                                        <div class="col-sm-8 profile-value">{{ $mahasiswa->angkatan ?? '-' }}</div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-sm-4 profile-label">Dosen PA</div>
                                        <div class="col-sm-8 profile-value">{{ $mahasiswa->dosen_pembimbing ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="alert alert-warning mb-0">
                                Biodata Anda belum diinput oleh admin.
                                Silakan hubungi admin jurusan untuk melengkapi data.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: AKUN + LOGOUT --}}
            <div class="col-lg-4 d-flex flex-column">
                <div class="card account-card mb-4 flex-grow-1">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3 text-uppercase">Informasi Login</h6>

                        <p class="mb-2"><strong>Username:</strong> {{ $user->username }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                        <p class="mb-0">
                            <strong>Terdaftar sejak:</strong>
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                        </p>
                    </div>
                </div>

                {{-- LOGOUT --}}
                <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit" class="btn w-100 logout-btn">Logout</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
