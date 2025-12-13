<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswas;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'mahasiswa') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $mahasiswa = Mahasiswas::where('user_id', $user->id)->first();

        return view('mahasiswa.dashboard', compact('user', 'mahasiswa'));
    }
}