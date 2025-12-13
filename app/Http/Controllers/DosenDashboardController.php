<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosens; // pastikan nama modelnya sama dengan yang kamu buat

class DosenDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'dosen') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $dosen = Dosens::where('user_id', $user->id)->first();

        return view('dosen.dashboard', compact('user', 'dosen'));
    }
}
