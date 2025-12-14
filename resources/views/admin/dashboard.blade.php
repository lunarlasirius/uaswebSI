@extends('layout.admin')

@section('title', 'Dashboard Admin')

@section('pageTitle', 'Dashboard Admin')
@section('pageSubtitle', 'Kelola seluruh data jurusan Sistem Informasi dari satu tempat.')
@section('breadcrumb', 'Pages /Dashboard')

@push('styles')
<style>
    .dashboard-wrapper {
        background-color: #f8f9fa; 
    }
    .card {
        border-radius: 1rem;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    
    /* KPI Cards Styling */
    .kpi-card .card-body {
        padding: 1.25rem;
    }
    .kpi-card .h5 {
        font-size: 1.75rem;
    }
    .kpi-card i {
        font-size: 2.5rem;
    }
    
    .nav-card a {
        color: inherit;
        text-decoration: none;
    }
    .nav-card .card-title {
        color: #007bff; 
        font-weight: 700;
    }
    .nav-card .card-text {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .list-group-item {
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding-left: 0;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }
</style>
@endpush

@section('adminContent')
<div class="container-fluid px-0 dashboard-wrapper">
    
    {{-- STATISTIK UTAMA --}}
    <div class="row g-3 mb-4">
        
        {{-- Total Dosen Card --}}
        <div class="col-lg-3 col-md-6 col-sm-6 kpi-card">
            <div class="card bg-primary text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase fw-bold mb-1 opacity-75">Total Dosen</div>
                            <div class="h5 mb-0 fw-bold">
                                {{ $totalDosen ?? '13' }} 
                            </div>
                        </div>
                        <i class="fas fa-chalkboard-teacher opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Total Mahasiswa Card --}}
        <div class="col-lg-3 col-md-6 col-sm-6 kpi-card">
            <div class="card bg-success text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase fw-bold mb-1 opacity-75">Total Mahasiswa</div>
                            <div class="h5 mb-0 fw-bold">
                                {{ $totalMahasiswa ?? '870' }}
                            </div>
                        </div>
                        <i class="fas fa-user-graduate opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Berita Terbaru Card --}}
        <div class="col-lg-3 col-md-6 col-sm-6 kpi-card">
            <div class="card bg-warning text-dark shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase fw-bold mb-1 opacity-75">Berita Dipublikasi</div>
                            <div class="h5 mb-0 fw-bold">
                                {{ $countBeritaPublished ?? '3' }}
                            </div>
                        </div>
                        <i class="fas fa-newspaper opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Total Pengguna Akun Card --}}
        <div class="col-lg-3 col-md-6 col-sm-6 kpi-card">
            <div class="card bg-info text-white shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase fw-bold mb-1 opacity-75">Total Pengguna Akun</div>
                            <div class="h5 mb-0 fw-bold">
                                {{ $totalUsers ?? '100' }}
                            </div>
                        </div>
                        <i class="fas fa-users-cog opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    {{-- LOG AKTIVITAS / PEMBERITAHUAN --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-history me-2"></i> Aktivitas Terbaru Sistem</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Admin **Nurul** telah mengedit Profil Jurusan. <span class="float-end text-muted small">5 menit lalu</span></li>
                        <li class="list-group-item">Admin **Rika** menambahkan data Dosen baru (NIDN: 1210117701). <span class="float-end text-muted small">1 jam lalu</span></li>
                        <li class="list-group-item">Sistem: 5 Mahasiswa baru telah didaftarkan. <span class="float-end text-muted small">Kemarin</span></li>
                        <li class="list-group-item">Admin **Audya** memperbarui data Mata Kuliah. <span class="float-end text-muted small">2 hari lalu</span></li>
                    </ul>
                    <a href="#" class="btn btn-sm btn-outline-primary mt-3 w-100">Lihat Semua Log</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold text-warning"><i class="fas fa-exclamation-triangle me-2"></i> Pemberitahuan Konten</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Berita yang masih berstatus draft:</p>
                    <div class="list-group">
                        <a href="{{ route('admin.berita.index') }}" class="list-group-item list-group-item-action list-group-item-warning py-2 small">Draft: Berita Jadwal Sempro bulan November 2025</a>
                        <a href="{{ route('admin.berita.index') }}" class="list-group-item list-group-item-action list-group-item-warning py-2 small">Draft: Jadwal Kuliah Semester Baru 20252</a>
                        <a href="{{ route('admin.berita.index') }}" class="list-group-item list-group-item-action list-group-item-warning py-2 small">Draft: Pengumuman Beasiswa KIP-K</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- KARTU NAVIGASI UTAMA  --}}
    <div class="row g-3">

        {{-- PROFIL JURUSAN --}}
        <div class="col-md-4 nav-card">
            <a href="{{ route('admin.profil.edit') }}">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-university me-2"></i> Profil Jurusan</h5>
                        <p class="card-text text-muted">Edit visi, misi, sejarah, dan sambutan ketua jurusan.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- DOSEN --}}
        <div class="col-md-4 nav-card">
            <a href="{{ route('admin.dosen.index') }}">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-users me-2"></i> Dosen</h5>
                        <p class="card-text text-muted">Kelola daftar dosen, NIDN, dan bidang keahlian.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- MATA KULIAH --}}
        <div class="col-md-4 nav-card">
            <a href="{{ route('admin.mata_kuliah.index') }}">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-book me-2"></i> Mata Kuliah</h5>
                        <p class="card-text text-muted">Kelola daftar mata kuliah dan SKS.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- MAHASISWA --}}
        <div class="col-md-4 nav-card">
            <a href="{{ route('admin.mahasiswa.index') }}">
                <div class="card shadow-sm h-100 mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-graduation-cap me-2"></i> Mahasiswa</h5>
                        <p class="card-text text-muted">Kelola data biodata mahasiswa.</p>
                    </div>
                </div>
            </a>
        </div>
        
        {{-- PRESTASI --}}
        <div class="col-md-4 nav-card">
            <a href="{{ route('admin.prestasi.index') }}">
                <div class="card shadow-sm h-100 mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-trophy me-2"></i> Prestasi</h5>
                        <p class="card-text text-muted">Kelola prestasi mahasiswa/dosen jurusan.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- FASILITAS --}}
        <div class="col-md-4 nav-card">
            <a href="{{ route('admin.fasilitas.index') }}">
                <div class="card shadow-sm h-100 mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-flask me-2"></i> Fasilitas</h5>
                        <p class="card-text text-muted">Kelola data laboratorium dan ruang jurusan.</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- BERITA --}}
        <div class="col-md-4 nav-card">
            <a href="{{ route('admin.berita.index') }}">
                <div class="card shadow-sm h-100 mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-bullhorn me-2"></i> Berita</h5>
                        <p class="card-text text-muted">Kelola berita yang tampil di halaman utama.</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection