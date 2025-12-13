<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminFasilitasController extends Controller
{
    /* Hanya admin yang boleh akses  */
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    /* Daftar fasilitas */
    public function index()
    {
        $this->authorizeAdmin();

        $fasilitas = Fasilitas::orderBy('nama_fasilitas')->paginate(12);

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /* Form tambah fasilitas */
    public function create()
    {
        $this->authorizeAdmin();

        return view('admin.fasilitas.create');
    }

    /* Simpan fasilitas baru */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'foto'           => 'nullable|image|max:5120',
        ]);

        // Upload foto jika ada
        $pathFoto = null;
        if ($request->hasFile('foto')) {
            // hasil: "fasilitas/nama-file.jpg" di disk "public"
            $storedPath = $request->file('foto')->store('fasilitas', 'public');
            // yang disimpan ke DB: "storage/fasilitas/nama-file.jpg"
            $pathFoto = 'storage/' . $storedPath;
        }

        Fasilitas::create([
            'nama_fasilitas' => $validated['nama_fasilitas'],
            'deskripsi'      => $validated['deskripsi'] ?? '',
            'foto'           => $pathFoto,
        ]);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /* Form edit fasilitas */
    public function edit(Fasilitas $fasilita)
    {
        $this->authorizeAdmin();

        return view('admin.fasilitas.edit', [
            'fasilitas' => $fasilita,
        ]);
    }

    /* Update fasilitas */
    public function update(Request $request, Fasilitas $fasilita)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'foto'           => 'nullable|image|max:5120',
        ]);

        $data = [
            'nama_fasilitas' => $validated['nama_fasilitas'],
            'deskripsi'      => $validated['deskripsi'] ?? '',
        ];

        if ($request->hasFile('foto')) {
            if ($fasilita->foto) {
                $oldPath = str_replace('storage/', '', $fasilita->foto);
                Storage::disk('public')->delete($oldPath);
            }

            $storedPath = $request->file('foto')->store('fasilitas', 'public');
            $data['foto'] = 'storage/' . $storedPath;
        }

        $fasilita->update($data);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $this->authorizeAdmin();

        if ($fasilita->foto) {
            $oldPath = str_replace('storage/', '', $fasilita->foto);
            Storage::disk('public')->delete($oldPath);
        }

        $fasilita->delete();

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}