<?php

namespace App\Http\Controllers;

use App\Models\Profil_jurusans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProfilJurusanController extends Controller
{
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function edit()
    {
        $this->authorizeAdmin();

        $profil = Profil_jurusans::first();

        if (!$profil) {
            $profil = new Profil_jurusans();
        }

        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nama_ketua'      => 'nullable|string|max:255',
            'visi'            => 'nullable|string',
            'misi'            => 'nullable|string',
            'sejarah'         => 'nullable|string',
            'sambutan_ketua'  => 'nullable|string',
            'foto_ketua'      => 'nullable|image|max:5120', 
        ]);

        $profil = Profil_jurusans::first();

        if (!$profil) {
            $profil = new Profil_jurusans();
        }

        $profil->nama_ketua     = $validated['nama_ketua'] ?? $profil->nama_ketua;
        $profil->visi           = $validated['visi'] ?? $profil->visi;
        $profil->misi           = $validated['misi'] ?? $profil->misi;
        $profil->sejarah        = $validated['sejarah'] ?? $profil->sejarah;
        $profil->sambutan_ketua = $validated['sambutan_ketua'] ?? $profil->sambutan_ketua;

        if ($request->hasFile('foto_ketua')) {
            if ($profil->foto_ketua) {
                $oldPath = ltrim($profil->foto_ketua, '/');   
                $oldPath = str_replace('storage/', '', $oldPath); 
                Storage::disk('public')->delete($oldPath);
            }

            $storedPath = $request->file('foto_ketua')->store('profil', 'public'); 
            $profil->foto_ketua = $storedPath; 
        }

        $profil->save();

        return redirect()
            ->route('admin.profil.edit')
            ->with('success', 'Profil jurusan berhasil diperbarui.');
    }
}