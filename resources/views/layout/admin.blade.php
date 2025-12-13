@extends('layout.app')

@section('title', trim($__env->yieldContent('title', 'Dashboard Admin')))

@section('content')
    <style>
        .admin-layout {
            display: block;
            min-height: 100vh;
            background-color: #f5f6fa;
        }

        .admin-sidebar {
            width: 240px;
            background: linear-gradient(180deg, #0d6efd, #0044a3);
            color: #fff;
            padding: 1.25rem 1rem;

            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
        }


        .admin-sidebar-brand {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .admin-sidebar-brand-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .15);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            font-weight: 700;
        }

        .admin-nav-section-title {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            opacity: .7;
            margin-bottom: .35rem;
            margin-top: 1rem;
        }

        .admin-nav {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .admin-nav-item {
            margin-bottom: .15rem;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: .55rem;
            padding: .45rem .7rem;
            border-radius: .5rem;
            font-size: .85rem;
            color: #e2e6ea;
            text-decoration: none;
            transition: background .15s, color .15s, transform .05s;
            white-space: nowrap;
        }

        .admin-nav-link span.icon-bullet {
            width: .45rem;
            height: .45rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, .4);
        }

        .admin-nav-link:hover {
            background: rgba(255, 255, 255, .14);
            color: #ffffff;
            transform: translateX(2px);
        }

        .admin-nav-link.is-active {
            background: rgba(255, 255, 255, .22);
            color: #ffffff;
            font-weight: 600;
        }

        .admin-main {
            flex: 1;
            padding: 1.75rem 1.75rem;
            margin-left: 240px;
        }


        .admin-main-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .admin-main-title {
            margin: 0;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .admin-main-subtitle {
            margin: 0;
            font-size: .9rem;
            color: #6c757d;
        }

        .admin-breadcrumb {
            font-size: .8rem;
            color: #a0a4aa;
        }

        .admin-card-grid .card {
            border: none;
            border-radius: 1rem;
            transition: transform .12s ease, box-shadow .12s ease;
        }

        .admin-card-grid .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.5rem rgba(15, 23, 42, 0.12);
        }

        @media (max-width: 991.98px) {
            .admin-layout {
                display: block;
                background-color: #f5f6fa;
            }


            .admin-sidebar {
                position: static;
                width: 100%;
                height: auto;
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 1.25rem;
                overflow-x: auto;
            }

            .admin-sidebar-brand {
                margin-bottom: 0;
            }

            .admin-sidebar nav {
                display: flex;
                gap: .25rem;
            }

            .admin-nav-section-title {
                display: none;
            }

            .admin-main {
                padding: 1.25rem 1rem 2rem;
            }
        }
    </style>

    <div class="admin-layout">
        {{-- SIDEBAR KIRI --}}
        <aside class="admin-sidebar">
            <div>
                <div class="admin-sidebar-brand">
                    <div class="admin-sidebar-brand-circle">SI</div>
                    <span>Sistem Informasi</span>
                </div>

                <nav>
                    <div class="admin-nav-section-title">Menu</div>
                    <ul class="admin-nav">
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.profil.edit') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.profil.*') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Profil Jurusan</span>
                            </a>
                        </li>
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.dosen.index') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.dosen.*') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Data Dosen</span>
                            </a>
                        </li>
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.mata_kuliah.index') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.mata_kuliah.*') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Mata Kuliah</span>
                            </a>
                        </li>
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.prestasi.index') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.prestasi.*') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Prestasi</span>
                            </a>
                        </li>
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.fasilitas.index') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.fasilitas.*') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Fasilitas</span>
                            </a>
                        </li>
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.berita.index') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.berita.*') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Berita</span>
                            </a>
                        </li>
                        <li class="admin-nav-item">
                            <a href="{{ route('admin.mahasiswa.index') }}"
                                class="admin-nav-link {{ request()->routeIs('admin.mahasiswa.*') ? 'is-active' : '' }}">
                                <span class="icon-bullet"></span>
                                <span>Mahasiswa</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        {{-- KONTEN KANAN --}}
        <main class="admin-main">

            {{-- header + logout --}}
            <div class="admin-main-header">
                <div>
                    <h1 class="admin-main-title">@yield('pageTitle', 'Dashboard Admin')</h1>
                    <p class="admin-main-subtitle">
                        @yield('pageSubtitle', 'Kelola seluruh data jurusan Sistem Informasi dari satu tempat.')
                    </p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="admin-breadcrumb d-none d-md-block">
                        {!! trim($__env->yieldContent('breadcrumb', 'Pages/Dashboard')) !!}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <div class="admin-card-grid">
                @yield('adminContent')
            </div>
        </main>
    </div>
@endsection
