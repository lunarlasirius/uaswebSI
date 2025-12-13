<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\DosenDashboardController;

use App\Http\Controllers\BeritaController as AdminBeritaController;

// ADMIN 
use App\Http\Controllers\AdminProfilJurusanController;
use App\Http\Controllers\AdminDosenController;
use App\Http\Controllers\AdminMataKuliahController;
use App\Http\Controllers\AdminPrestasiController;
use App\Http\Controllers\AdminFasilitasController;
use App\Http\Controllers\AdminMahasiswaController;

/* FRONTEND (*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Menu Profil
Route::prefix('profil')->group(function () {
    Route::get('/jurusan', [HomeController::class, 'profilJurusan'])->name('profil.jurusan');
    Route::get('/struktur-organisasi', [HomeController::class, 'strukturOrganisasi'])->name('profil.struktur');
    Route::get('/fasilitas', [HomeController::class, 'fasilitas'])->name('profil.fasilitas');
    Route::get('/dosen', [HomeController::class, 'dosen'])->name('profil.dosen');
});

// Menu Akademik
Route::prefix('akademik')->group(function () {
    Route::get('/mata-kuliah', [HomeController::class, 'mataKuliah'])->name('akademik.mata_kuliah');
    Route::get('/prestasi', [HomeController::class, 'prestasi'])->name('akademik.prestasi');
});

// Berita publik
Route::get('/berita', [HomeController::class, 'beritaIndex'])->name('berita.index');
Route::get('/berita/{slug}', [HomeController::class, 'beritaShow'])->name('berita.show');


/* AUTH */
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/* DASHBOARD (Setelah Login) */
Route::middleware('auth')->group(function () {

    // Dashboard role-based
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/mahasiswa', [MahasiswaDashboardController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/dosen', [DosenDashboardController::class, 'index'])->name('dosen.dashboard');

    // PROFIL JURUSAN (admin) - edit/update satu record
    Route::prefix('admin')->group(function () {

        // Profil Jurusan 
        Route::get('/profil-jurusan', [AdminProfilJurusanController::class, 'edit'])->name('admin.profil.edit');
        Route::put('/profil-jurusan', [AdminProfilJurusanController::class, 'update'])->name('admin.profil.update');

        // CRUD Berita
        Route::resource('berita', AdminBeritaController::class)->names([
            'index'   => 'admin.berita.index',
            'create'  => 'admin.berita.create',
            'store'   => 'admin.berita.store',
            'edit'    => 'admin.berita.edit',
            'update'  => 'admin.berita.update',
            'destroy' => 'admin.berita.destroy',
        ])->except(['show']);

        // DOSEN
        Route::resource('dosen', AdminDosenController::class)->names([
            'index'   => 'admin.dosen.index',
            'create'  => 'admin.dosen.create',
            'store'   => 'admin.dosen.store',
            'edit'    => 'admin.dosen.edit',
            'update'  => 'admin.dosen.update',
            'destroy' => 'admin.dosen.destroy',
        ])->except(['show']);

        // MATA KULIAH
        Route::resource('mata-kuliah', AdminMataKuliahController::class)->names([
            'index'   => 'admin.mata_kuliah.index',
            'create'  => 'admin.mata_kuliah.create',
            'store'   => 'admin.mata_kuliah.store',
            'edit'    => 'admin.mata_kuliah.edit',
            'update'  => 'admin.mata_kuliah.update',
            'destroy' => 'admin.mata_kuliah.destroy',
        ])->except(['show']);

        // PRESTASI 
        Route::resource('prestasi', AdminPrestasiController::class)->names([
            'index'   => 'admin.prestasi.index',
            'create'  => 'admin.prestasi.create',
            'store'   => 'admin.prestasi.store',
            'edit'    => 'admin.prestasi.edit',
            'update'  => 'admin.prestasi.update',
            'destroy' => 'admin.prestasi.destroy',
        ])->except(['show']);

        // FASILITAS
        Route::resource('fasilitas', AdminFasilitasController::class)->names([
            'index'   => 'admin.fasilitas.index',
            'create'  => 'admin.fasilitas.create',
            'store'   => 'admin.fasilitas.store',
            'edit'    => 'admin.fasilitas.edit',
            'update'  => 'admin.fasilitas.update',
            'destroy' => 'admin.fasilitas.destroy',
        ])->except(['show']);

        // MAHASISWA
        Route::resource('mahasiswa', AdminMahasiswaController::class)->names([
            'index'   => 'admin.mahasiswa.index',
            'create'  => 'admin.mahasiswa.create',
            'store'   => 'admin.mahasiswa.store',
            'edit'    => 'admin.mahasiswa.edit',
            'update'  => 'admin.mahasiswa.update',
            'destroy' => 'admin.mahasiswa.destroy',
        ])->except(['show']);

        Route::get('/berita/{id}/delete', [AdminBeritaController::class, 'deletePage'])->name('admin.berita.delete');
    });
});
