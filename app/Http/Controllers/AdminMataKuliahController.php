<?php

namespace App\Http\Controllers;

use App\Models\Mata_kuliahs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMataKuliahController extends Controller
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

        $mataKuliah = Mata_kuliahs::orderBy('semester')
                                  ->orderBy('nama_mk')
                                  ->get();

        return view('admin.mata_kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.mata_kuliah.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'kode_mk'  => 'required|string|max:20|unique:mata_kuliahs,kode_mk',
            'nama_mk'  => 'required|string|max:255',
            'sks'      => 'required|integer|min:1|max:10',
            'semester' => 'required|integer|min:1|max:14',
        ]);

        Mata_kuliahs::create($validated);

        return redirect()->route('admin.mata_kuliah.index')
                         ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(Mata_kuliahs $mataKuliah)
    {
        $this->authorizeAdmin();

        return view('admin.mata_kuliah.edit', [
            'mataKuliah' => $mataKuliah,
        ]);
    }

    public function update(Request $request, Mata_kuliahs $mataKuliah)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'kode_mk'  => 'required|string|max:20|unique:mata_kuliahs,kode_mk,' . $mataKuliah->id,
            'nama_mk'  => 'required|string|max:255',
            'sks'      => 'required|integer|min:1|max:10',
            'semester' => 'required|integer|min:1|max:14',
        ]);

        $mataKuliah->update($validated);

        return redirect()->route('admin.mata_kuliah.index')
                         ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Mata_kuliahs $mataKuliah)
    {
        $this->authorizeAdmin();

        $mataKuliah->delete();

        return redirect()->route('admin.mata_kuliah.index')
                         ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
