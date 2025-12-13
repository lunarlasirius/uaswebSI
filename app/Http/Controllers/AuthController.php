<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // TAMPILKAN FORM LOGIN
    public function showLoginForm()
    {
        return view('auth.login'); // bikin view: resources/views/auth/login.blade.php
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        // validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::User();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } 
            elseif ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            } 
            elseif ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            }


            // kalau tidak dikenali
            Auth::logout();
            return back()->withErrors([
                'username' => 'Role pengguna tidak dikenali.',
            ]);
        }

        // kalau gagal login
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}