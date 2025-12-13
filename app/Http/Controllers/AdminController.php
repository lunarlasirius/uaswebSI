<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswas;
use App\Models\Dosens;
use App\Models\Beritas;
use App\Models\Mata_kuliahs;
use App\Models\prestasis;
use App\Models\Fasilitas;

class AdminController extends Controller
{
    public function index()
    {
    
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $jumlahMahasiswa = Mahasiswas::count();
        $jumlahDosen     = Dosens::count();
        $jumlahBerita    = Beritas::count();
        $jumlahMataKuliah = mata_kuliahs::count();
        $jumlahPrestasi  = prestasis::count();
        $jumlahFasilitas = Fasilitas::count();

        return view('admin.dashboard', compact(
            'jumlahMahasiswa',
            'jumlahDosen',
            'jumlahBerita',
            'jumlahMataKuliah',
            'jumlahPrestasi',
            'jumlahFasilitas'
        ));
    }
}