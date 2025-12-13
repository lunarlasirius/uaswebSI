<?php

namespace App\Http\Controllers;

use App\Models\Profil_jurusans;
use App\Models\Struktur_organisasis;
use App\Models\Fasilitas;
use App\Models\Dosens;
use App\Models\mata_kuliahs;
use App\Models\prestasis;
use App\Models\Beritas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // HALAMAN HOME
    public function index()
    {
        $profil = Profil_jurusans::first(); // visi, misi, sambutan
        $beritaTerbaru = Beritas::orderBy('tanggal_publish', 'desc')
                            ->limit(6)
                            ->get();

        return view('home', compact('profil', 'beritaTerbaru'));
    }

    // PROFIL JURUSAN
    public function profilJurusan()
    {
        $profil = Profil_jurusans::first();

        return view('profil.jurusan', compact('profil'));
    }

    // SUSUNAN ORGANISASI
    public function strukturOrganisasi()
    {
        $struktur = Struktur_organisasis::orderBy('urutan', 'asc')->get();

        return view('profil.struktur_organisasi', compact('struktur'));
    }

    // FASILITAS
    public function fasilitas()
    {
        $fasilitas = Fasilitas::orderBy('nama_fasilitas')->get();

        return view('profil.fasilitas', compact('fasilitas'));
    }

    // DAFTAR DOSEN
    public function dosen()
    {
        $dosens = Dosens::orderBy('nama')->get();

        return view('profil.dosen', compact('dosens'));
    }

    // AKADEMIK → MATA KULIAH
    public function mataKuliah()
    {
        $mataKuliah = mata_kuliahs::orderBy('semester')->orderBy('nama_mk')->get();

        return view('akademik.mata_kuliah', compact('mataKuliah'));
    }

    // AKADEMIK → PRESTASI
    public function prestasi()
    {
        $prestasi = prestasis::orderBy('tanggal', 'desc')->get();

        return view('akademik.prestasi', compact('prestasi'));
    }

    // BERITA → INDEX
    public function beritaIndex()
    {
        $berita = Beritas::orderBy('tanggal_publish', 'desc')->paginate(10);

        return view('berita.index', compact('berita'));
    }

    // BERITA → DETAIL
    public function beritaShow($slug)
    {
        $berita = Beritas::where('slug', $slug)->firstOrFail();

        return view('berita.show', compact('berita'));
    }
}