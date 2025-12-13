<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beritas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $berita = Beritas::with('penulis')
                    ->orderBy('tanggal_publish', 'desc')
                    ->paginate(10);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'judul'           => 'required|string|max:200',
            'tanggal_publish' => 'nullable|date',
            'gambar'          => 'nullable|image|max:5048',
            'isi'             => 'required|string',
        ]);

        $slug = Str::slug($validated['judul']);
        if (Beritas::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $pathGambar = null;
        if ($request->hasFile('gambar')) {
            $pathGambar = $request->file('gambar')->store('berita', 'public');
        }

        Beritas::create([
            'judul'           => $validated['judul'],
            'slug'            => $slug,
            'gambar'          => $pathGambar ? 'storage/' . $pathGambar : null,
            'tanggal_publish' => $validated['tanggal_publish'],
            'isi'             => $validated['isi'],
            'penulis_id'      => Auth::id(),
        ]);

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Beritas $beritum)
    {
        $this->authorizeAdmin();

        return view('admin.berita.edit', [
            'berita' => $beritum
        ]);
    }

    public function update(Request $request, Beritas $beritum)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'judul'           => 'required|string|max:200',
            'tanggal_publish' => 'nullable|date',
            'gambar'          => 'nullable|image|max:5048',
            'isi'             => 'required|string',
        ]);

        $slug = $beritum->slug;
        if ($validated['judul'] !== $beritum->judul) {
            $slug = Str::slug($validated['judul']);
            if (Beritas::where('slug', $slug)->where('id', '!=', $beritum->id)->exists()) {
                $slug .= '-' . time();
            }
        }

        if ($request->hasFile('gambar')) {
            $pathGambar = $request->file('gambar')->store('berita', 'public');
            $beritum->gambar = 'storage/' . $pathGambar;
        }

        $beritum->judul           = $validated['judul'];
        $beritum->slug            = $slug;
        $beritum->tanggal_publish = $validated['tanggal_publish'];
        $beritum->isi             = $validated['isi'];
        $beritum->penulis_id      = Auth::id();
        $beritum->save();

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Beritas $beritum)
    {
        $this->authorizeAdmin();

        $beritum->delete();

        return redirect()->route('admin.berita.index')
                         ->with('success', 'Berita berhasil dihapus.');
    }

    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}