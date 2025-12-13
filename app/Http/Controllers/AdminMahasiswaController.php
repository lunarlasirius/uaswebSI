<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswas;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminMahasiswaController extends Controller
{
    // list semua mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswas::orderBy('npm', 'asc')->paginate(20);
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    // tampilkan form tambah
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    // menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'npm'               => 'required|string|max:30|unique:mahasiswas,npm',
            'nama'              => 'required|string|max:100',
            'alamat'            => 'nullable|string',
            'angkatan'          => 'nullable|integer',
            'dosen_pembimbing'  => 'nullable|string|max:100',
            'no_hp'             => 'nullable|string|max:20',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // buat user akun untuk login mahasiswa
        $user = Users::create([
            'username' => strtolower($data['npm']),
            'email'    => strtolower($data['npm']).'@gmail.com',
            'password' => Hash::make('mahasiswa123'),
            'name'     => $data['nama'],
            'role'     => 'mahasiswa',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('mahasiswa', $filename, 'public');
            $data['foto'] = 'storage/' . $path;
        }

        $data['user_id'] = $user->id;
        Mahasiswas::create($data);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // tampilkan form edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswas::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    // update data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswas::findOrFail($id);

        $data = $request->validate([
            'npm'               => ['required','string','max:20',Rule::unique('mahasiswas', 'npm')->ignore($mahasiswa->id),],
            'nama'              => 'required|string|max:100',
            'alamat'            => 'nullable|string',
            'angkatan'          => 'nullable|integer',
            'dosen_pembimbing'  => 'nullable|string|max:100',
            'no_hp'             => 'nullable|string|max:20',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto && file_exists(public_path($mahasiswa->foto))) {
                @unlink(public_path($mahasiswa->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('mahasiswa', $filename, 'public');
            $data['foto'] = 'storage/' . $path;
        }
        
        $mahasiswa->user->update([
            'username' => strtolower($data['npm']),
            'name'     => $data['nama'],
        ]);

        $mahasiswa->update($data);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // hapus
    public function destroy($id)
    {
        $mahasiswa = Mahasiswas::findOrFail($id);

        $mahasiswa->user->delete();

        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
