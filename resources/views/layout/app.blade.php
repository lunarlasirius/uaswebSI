<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Jurusan Sistem Informasi')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">

    <style>
        :root {
            --si-primary: #0d6efd;
            --si-dark: #0f172a;
            --si-muted: #64748b;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f5f7fb;
        }

        /* ===== NAVBAR MODERN ===== */
        .navbar-custom {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
        }

        .navbar-brand-logo {
            height: 40px;
            width: auto;
        }

        .navbar-brand {
            font-size: 0.98rem;
            color: var(--si-dark) !important;
        }

        .navbar-brand span {
            line-height: 1.2;
        }

        .nav-link {
            position: relative;
            font-weight: 500;
            font-size: 0.93rem;
            color: #334155 !important;
            padding: 0.45rem 0.9rem;
            transition: color 0.15s ease, transform 0.12s ease;
        }

        /* underline animasi */
        .nav-link::after {
            content: "";
            position: absolute;
            left: 0.9rem;
            right: 0.9rem;
            bottom: 0.15rem;
            height: 2px;
            border-radius: 999px;
            background: var(--si-primary);
            transform-origin: center;
            transform: scaleX(0);
            opacity: 0;
            transition: transform 0.18s ease-out, opacity 0.18s ease-out;
        }

        .nav-link:hover {
            color: var(--si-primary) !important;
            transform: translateY(-1px);
        }

        .nav-link:hover::after {
            transform: scaleX(1);
            opacity: 1;
        }

        .nav-link.active {
            color: var(--si-primary) !important;
            font-weight: 600;
        }

        .nav-link.active::after {
            transform: scaleX(1);
            opacity: 1;
        }

        /* Dropdown style */
        .dropdown-menu {
            border-radius: 0.75rem;
            border: 1px solid rgba(148, 163, 184, 0.35);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.15);
            padding: 0.4rem;
            font-size: 0.9rem;
        }

        .dropdown-item {
            border-radius: 0.5rem;
            padding: 0.45rem 0.75rem;
            color: #0f172a;
        }

        .dropdown-item:hover {
            background: rgba(13, 110, 253, 0.06);
            color: var(--si-primary);
        }

        /* Login button */
        .btn-login-pill {
            border-radius: 999px;
            padding-inline: 1.2rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Toggler */
        .navbar-custom .navbar-toggler {
            border-color: rgba(148, 163, 184, 0.7);
        }

        .navbar-custom .navbar-toggler-icon {
            filter: invert(35%);
        }

        /* ===== MAIN & FOOTER ===== */
        main {
            min-height: calc(100vh - 120px);
        }

        footer {
            background-color: #f8fafc;
            padding: 1rem 0;
            border-top: 1px solid #e5e7eb;
            font-size: 0.85rem;
            color: var(--si-muted);
        }
    </style>

    @stack('styles')
</head>
<body>

    @php
        // Sembunyikan navbar di semua halaman admin / mahasiswa / dosen
        $hideNavbar = request()->routeIs('admin.*')
            || request()->routeIs('mahasiswa.*')
            || request()->routeIs('dosen.*');
    @endphp

    {{-- NAVBAR --}}
    @if (! $hideNavbar)
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            {{-- Logo + Nama Jurusan --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('img/logo unmus.png') }}" alt="Logo Universitas" class="navbar-brand-logo me-2">
                <span class="fw-bold">
                    Sistem Informasi Universitas Musamus
                </span>
            </a>

            {{-- Toggler --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu Navbar --}}
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                    {{-- Home --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    {{-- Profil --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle
                                  {{ request()->routeIs('profil.*') ? 'active' : '' }}"
                           href="#" id="profilDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.jurusan') }}">
                                    Profil Jurusan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.struktur') }}">
                                    Susunan Organisasi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.fasilitas') }}">
                                    Fasilitas
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profil.dosen') }}">
                                    Dosen
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Akademik --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle
                                  {{ request()->routeIs('akademik.*') ? 'active' : '' }}"
                           href="#" id="akademikDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Akademik
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="akademikDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('akademik.mata_kuliah') }}">
                                    Daftar Mata Kuliah
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('akademik.prestasi') }}">
                                    Prestasi
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Berita --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}"
                           href="{{ route('berita.index') }}">
                            Berita
                        </a>
                    </li>
                </ul>

                {{-- Login  --}}
                <ul class="navbar-nav ms-lg-0 mb-2 mb-lg-0">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}"
                               class="btn btn-outline-primary btn-sm ms-lg-3 btn-login-pill">
                                Login
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold" href="#"
                               id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <span class="text-muted">({{ Auth::user()->role }})</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if (Auth::user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Dashboard Admin
                                        </a>
                                    </li>
                                @elseif (Auth::user()->role === 'mahasiswa')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('mahasiswa.dashboard') }}">
                                            Profil Mahasiswa
                                        </a>
                                    </li>
                                @elseif (Auth::user()->role === 'dosen')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dosen.dashboard') }}">
                                            Profil Dosen
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>
    @endif

    {{-- KONTEN HALAMAN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container text-center">
            <small>
                &copy; {{ date('Y') }} Jurusan Sistem Informasi - Universitas Musamus Merauke.
                All rights reserved.
            </small>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    @stack('scripts')
</body>
</html>
