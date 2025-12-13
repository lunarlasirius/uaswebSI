<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dosens;
use App\Models\Users;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminDosenController extends Controller
{
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function index()
    {
        $this->authorizeAdmin();

        $dosens = Dosens::orderBy('nama')->paginate(10);
        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'nidn'            => 'required|string|max:50|unique:dosens,nidn',
            'bidang_keahlian' => 'nullable|string',
            'email'           => 'nullable|email',
            'no_hp'           => 'nullable|string|max:20',
            'foto'            => 'nullable|image|max:2048',
        ]);

       $user = Users::where('username', $request->username)
             ->where('role', 'dosen')
             ->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'Akun dosen dengan username ini belum dibuat.'
            ])->withInput();
        }


        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('dosen', 'public');
        }

        Dosens::create([
            'user_id'         => $user->id,
            'nama'            => $validated['nama'],
            'nidn'            => $validated['nidn'],
            'bidang_keahlian' => $validated['bidang_keahlian'] ?? '',
            'email'           => $validated['email'] ?? null,
            'no_hp'           => $validated['no_hp'] ?? null,
            'foto'            => $pathFoto ? 'storage/' . $pathFoto : null,
        ]);

        return redirect()->route('admin.dosen.index')
                         ->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosens $dosen)
    {
        $this->authorizeAdmin();
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosens $dosen)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'nidn'            => 'required|string|max:50|unique:dosens,nidn,' . $dosen->id,
            'bidang_keahlian' => 'nullable|string',
            'email'           => 'nullable|email',
            'no_hp'           => 'nullable|string|max:20',
            'foto'            => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('dosen', 'public');
            $dosen->foto = 'storage/' . $pathFoto;
        }

        $dosen->nama            = $validated['nama'];
        $dosen->nidn            = $validated['nidn'];
        $dosen->bidang_keahlian = $validated['bidang_keahlian'] ?? '';
        $dosen->email           = $validated['email'] ?? null;
        $dosen->save();

        return redirect()->route('admin.dosen.index')
                         ->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy(Dosens $dosen)
    {
        $this->authorizeAdmin();
        $dosen->delete();

        return redirect()->route('admin.dosen.index')
                         ->with('success', 'Dosen berhasil dihapus.');
    }
}