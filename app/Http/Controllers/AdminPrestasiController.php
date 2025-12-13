<?php

namespace App\Http\Controllers;

use App\Models\prestasis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPrestasiController extends Controller
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

        $prestasi = prestasis::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'foto'      => 'nullable|image|max:15048',
            'tanggal'   => 'nullable|date',
            'kategori'  => 'nullable|string|max:100',
            'tingkat'   => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('prestasi', 'public');
        }

        prestasis::create([
            'judul'     => $validated['judul'],
            'foto'      => $pathFoto ? 'storage/' . $pathFoto : null,
            'tanggal'   => $validated['tanggal'] ?? null,
            'kategori'  => $validated['kategori'] ?? null,
            'tingkat'   => $validated['tingkat'] ?? null,
            'deskripsi' => $validated['deskripsi'] ?? '',
        ]);

        return redirect()->route('admin.prestasi.index')
                         ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(prestasis $prestasi)
    {
        $this->authorizeAdmin();
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, prestasis $prestasi)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'foto'      => 'nullable|image|max:15048',
            'tanggal'   => 'nullable|date',
            'kategori'  => 'nullable|string|max:100',
            'tingkat'   => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('prestasi', 'public');
            $prestasi->foto = 'storage/' . $pathFoto;
        }

        $prestasi->judul     = $validated['judul'];
        $prestasi->tanggal   = $validated['tanggal'] ?? null;
        $prestasi->kategori  = $validated['kategori'] ?? null;
        $prestasi->tingkat   = $validated['tingkat'] ?? null;
        $prestasi->deskripsi = $validated['deskripsi'] ?? '';
        $prestasi->save();

        return redirect()->route('admin.prestasi.index')
                         ->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(prestasis $prestasi)
    {
        $this->authorizeAdmin();
        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')
                         ->with('success', 'Prestasi berhasil dihapus.');
    }
}
