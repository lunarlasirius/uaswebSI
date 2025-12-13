@extends('layout.app')

@section('title', 'Dashboard Dosen')

@push('styles')
<style>
    .dosen-dashboard{
        --primary-brand: #007bff;
        --primary-dark: #004d9a;
        --accent-glow: #00e5ff;
        --text-dark: #212529;
        --text-muted: #6c757d;
        --bg-page: #f0f2f5;
        --bg-card: #ffffff;
        --shadow-subtle: 0 6px 15px rgba(0, 0, 0, 0.05);
        --shadow-hover: 0 10px 25px rgba(0, 0, 0, 0.10);

        background: var(--bg-page);
        padding: 50px 0;
    }

    .dosen-dashboard .page-container{
        padding-left: 15px;
        padding-right: 15px;
    }

    /* === 1. HEADER DASHBOARD === */
    .dosen-dashboard .dashboard-header{
        margin-bottom: 3.5rem;
    }
    .dosen-dashboard .dashboard-header h3{
        font-weight: 900;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 5px;
        position: relative;
    }
    .dosen-dashboard .dashboard-header h3::after{
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background-color: var(--primary-brand);
        margin-top: 8px;
        border-radius: 2px;
    }
    .dosen-dashboard .dashboard-header strong{
        color: var(--primary-brand);
        font-weight: 700;
        background-color: #e6f0ff;
        padding: 2px 8px;
        border-radius: 4px;
    }

    /* === 2. KARTU UMUM === */
    .dosen-dashboard .card{
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 1.25rem;
        box-shadow: var(--shadow-subtle);
        transition: transform .3s ease, box-shadow .3s ease;
        background-color: var(--bg-card);
        height: 100%;
    }
    .dosen-dashboard .card:hover{
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
    }

    .dosen-dashboard .card-header{
        border-bottom: 1px solid rgba(0,0,0,0.1);
        background-color: var(--bg-card) !important;
        border-radius: 1.25rem 1.25rem 0 0 !important;
    }
    .dosen-dashboard .card-header h5{
        font-weight: 800;
        color: var(--primary-dark);
        border-left: 5px solid var(--accent-glow);
        padding-left: 15px;
        margin: 0;
    }

    /* === 3. BIODATA === */
    .dosen-dashboard .biodata-label{
        color: var(--text-dark);
        font-weight: 700 !important;
        opacity: 0.85;
        font-size: 0.95rem;
    }
    .dosen-dashboard .form-control-plaintext{
        color: var(--primary-dark);
        font-weight: 600;
        font-size: 1.05rem;
        padding-top: 8px;
        padding-bottom: 8px;
        margin: 0;
    }
    .dosen-dashboard .biodata-card .row:not(:last-child){
        border-bottom: 1px dashed rgba(0,0,0,0.05);
        padding-bottom: 8px;
        padding-top: 8px;
    }

    /* === 4. FOTO & AKUN === */
    .dosen-dashboard .photo-card-title,
    .dosen-dashboard .account-card h6{
        font-weight: 800;
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
        position: relative;
        text-align:center;
    }
    .dosen-dashboard .photo-card-title::after,
    .dosen-dashboard .account-card h6::after{
        content: '';
        display: block;
        width: 30px;
        height: 2px;
        background-color: var(--primary-brand);
        margin: 5px auto 0;
        border-radius: 2px;
    }

    .dosen-dashboard .photo-card img{
        max-width: 150px !important;
        height: 150px;
        border-radius: 50% !important;
        object-fit: cover;
        border: 4px solid var(--primary-brand);
        box-shadow: 0 0 0 8px rgba(0,123,255,0.10);
        transition: all .3s ease;
    }
    .dosen-dashboard .photo-card:hover img{
        border-color: var(--accent-glow);
        transform: scale(1.03);
    }

    .dosen-dashboard .photo-placeholder{
        width: 150px !important;
        height: 150px !important;
        border-radius: 50% !important;
        background: #ffffff !important;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px dashed var(--text-muted);
    }
    .dosen-dashboard .photo-placeholder svg{
        color: var(--text-muted);
    }

    .dosen-dashboard .account-card p{
        font-size: 0.95rem;
        margin-bottom: 10px;
    }
    .dosen-dashboard .account-card strong{
        color: var(--primary-dark);
        font-weight: 700;
        min-width: 110px;
        display: inline-block;
    }

    /* === 5. LOGOUT === */
    .dosen-dashboard .btn-logout{
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
        font-weight: 700;
        border-radius: 0.75rem;
        padding: 0.6rem 1rem;
        transition: all .3s ease;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.2);
    }
    .dosen-dashboard .btn-logout:hover{
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 53, 69, 0.3);
    }

    /* === 6. ALERT === */
    .dosen-dashboard .alert-warning{
        border-left: 5px solid #ffc107;
        background-color: #fff8e1;
        color: #795548;
        font-weight: 600;
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="dosen-dashboard">
    <div class="container page-container">
        <div class="row mb-4 dashboard-header">
            <div class="col-md-12">
                <h3 class="mb-1">Dashboard Dosen</h3>
                <p class="text-muted mb-0">
                    Selamat datang, <strong>{{ $user->name }}</strong> (role: {{ ucfirst($user->role) }}).
                </p>
            </div>
        </div>

        <div class="row g-4">
            {{-- Kolom biodata utama --}}
            <div class="col-md-8">
                <div class="card shadow-sm mb-3 biodata-card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Biodata Dosen</h5>
                    </div>
                    <div class="card-body">

                        @if ($dosen)
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label biodata-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $dosen->nama ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label biodata-label">NIDN</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $dosen->nidn ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label biodata-label">Bidang Keahlian</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $dosen->bidang_keahlian ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label biodata-label">Jabatan</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $dosen->jabatan ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label biodata-label">Email</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $dosen->email ?? $user->email ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label biodata-label">No HP</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $dosen->no_hp ?? '-' }}</p>
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

            <div class="col-md-4 d-flex flex-column">

                {{-- Foto --}}
                <div class="card shadow-sm mb-4 photo-card flex-grow-0">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold photo-card-title">Foto Dosen</h6>

                        @if ($dosen && $dosen->foto)
                            @php
                                $fotoUrl = $dosen->foto;
                                if ($fotoUrl && !\Illuminate\Support\Str::startsWith($fotoUrl, ['http://', 'https://', 'storage/'])) {
                                    $fotoUrl = 'storage/' . ltrim($fotoUrl, '/');
                                }
                            @endphp
                            <img src="{{ asset($fotoUrl) }}" alt="Foto {{ $dosen->nama }}" class="img-fluid mb-2">
                        @else
                            <div class="mb-2">
                                <div class="photo-placeholder">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.827-1.613C12.55 10.567 9.882 10 8 10s-4.55 1.567-5.173 2.383c-.673.627-.825 1.367-.827 1.613h10z"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-muted mb-0">Foto belum tersedia.</p>
                        @endif
                    </div>
                </div>

                {{-- Info Akun --}}
                <div class="card shadow-sm mb-4 account-card flex-grow-1">
                    <div class="card-body">
                        <h6 class="fw-semibold text-center">Informasi Akun</h6>
                        <p class="mb-1"><strong>Username:</strong> {{ $user->username }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                        <p class="mb-0"><strong>Terdaftar sejak:</strong>
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                        </p>
                    </div>
                </div>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit" class="btn w-100 btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
