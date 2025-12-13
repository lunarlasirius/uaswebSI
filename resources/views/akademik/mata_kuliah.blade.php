@extends('layout.app')

@section('title', 'Daftar Mata Kuliah - Sistem Informasi')

@section('content')
<style>
    .mk-page-title {
        font-weight: 700;
        font-size: 1.9rem;
    }

    .mk-page-subtitle {
        max-width: 720px;
        font-size: .95rem;
        color: #6c757d;
    }

    .semester-nav {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-bottom: 1.5rem;
    }

    .semester-chip {
        border-radius: 999px;
        padding: .35rem .9rem;
        font-size: .85rem;
        border: 1px solid #dee2e6;
        background: #f8f9ff;
        cursor: pointer;
        transition: background .15s, color .15s, transform .05s, box-shadow .15s;
    }

    .semester-chip:hover {
        background: #0d6efd;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 .35rem 1rem rgba(13,110,253,.18);
        text-decoration: none;
    }

    .semester-card {
        border-radius: 1rem;
        overflow: hidden;
        border: none;
        box-shadow: 0 .35rem 1rem rgba(15,23,42,.06);
        margin-bottom: 1.75rem;
        background-color: #ffffff;
    }

    .semester-card-header {
        background: linear-gradient(135deg, #0d6efd, #0047b3);
        color: #ffffff;
        padding: .85rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .semester-card-header h2 {
        font-size: 1.05rem;
        margin: 0;
        font-weight: 600;
    }

    .semester-badge {
        font-size: .75rem;
        padding: .15rem .55rem;
        border-radius: 999px;
        background: rgba(255,255,255,.18);
        border: 1px solid rgba(255,255,255,.35);
    }

    .semester-table {
        margin-bottom: 0;
        font-size: .9rem;
    }

    .semester-table thead {
        background-color: #f8fafc;
    }

    .semester-table thead th {
        border-bottom-width: 0;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        font-size: .75rem;
    }

    .semester-table tbody tr:hover {
        background-color: #f5f9ff;
    }

    .mk-kode-cell {
        white-space: nowrap;
        font-weight: 600;
    }

    .mk-sks-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.25rem;
        padding: .15rem .5rem;
        border-radius: 999px;
        background: #e7f1ff;
        color: #0b5ed7;
        font-size: .8rem;
        font-weight: 600;
    }

    @media (max-width: 575.98px) {
        .mk-page-title {
            font-size: 1.5rem;
        }
        .semester-card-header h2 {
            font-size: .98rem;
        }
    }
</style>

<div class="container py-4">
    <h1 class="mk-page-title mb-2">Daftar Mata Kuliah Jurusan Sistem Informasi</h1>
    <p class="mk-page-subtitle mb-3">
        Berikut adalah daftar mata kuliah Program Studi Sistem Informasi yang dikelompokkan
        berdasarkan semester 1 sampai dengan semester 8.
    </p>

    @if ($mataKuliah->count())

        @php
            $bySemester = $mataKuliah->groupBy('semester');
        @endphp

        <div class="semester-nav">
            @for ($s = 1; $s <= 8; $s++)
                @if (isset($bySemester[$s]))
                    <a href="#semester-{{ $s }}" class="semester-chip">
                        Semester {{ $s }}
                    </a>
                @endif
            @endfor
        </div>

        {{-- Section per semester --}}
        @for ($s = 1; $s <= 8; $s++)
            @if (isset($bySemester[$s]))
                <section id="semester-{{ $s }}">
                    <div class="card semester-card">
                        <div class="semester-card-header">
                            <h2>Semester {{ $s }}</h2>
                            <span class="semester-badge">
                                {{ $bySemester[$s]->count() }} mata kuliah
                            </span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle semester-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%;">Kode MK</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th class="text-center" style="width: 10%;">SKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bySemester[$s] as $mk)
                                            <tr>
                                                <td class="mk-kode-cell">{{ $mk->kode_mk }}</td>
                                                <td>{{ $mk->nama_mk }}</td>
                                                <td class="text-center">
                                                    <span class="mk-sks-pill">
                                                        {{ $mk->sks }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endfor

    @else
        <p class="text-muted mt-3">Daftar mata kuliah belum tersedia.</p>
    @endif
</div>
@endsection