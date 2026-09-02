<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\ProfilAsramaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\UserController; // <-- TAMBAHAN UNTUK KELOLA AKUN
use App\Models\Pengurus;
use App\Models\Berita;

// ==========================================
// RUTE PUBLIK (Pengunjung Umum)
// ==========================================
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/berita/{id}', [FrontController::class, 'showBerita'])->name('berita.show');
Route::get('/up', function () {
    return response('OK', 200);
});

// ==========================================
// RUTE TERAUTENTIKASI (Hanya yang sudah Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard bisa diakses berdua (Super Admin & Sekretaris)
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'pengurus' => Pengurus::all(),
            'berita'   => Berita::all(),
        ]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // AREA KELOLA ADMIN & STAFF (Prefix: /admin)
    // ==========================================
    Route::prefix('admin')->group(function () {

        // ------------------------------------------
        // BISA DIAKSES SUPER ADMIN & SEKRETARIS
        // ------------------------------------------
        Route::resource('berita', BeritaController::class)->names('berita');
        
        Route::prefix('prestasi')->name('prestasi.')->group(function () {
            Route::get('/', [PrestasiController::class, 'index'])->name('index');
            Route::get('/create', [PrestasiController::class, 'create'])->name('create');
            Route::post('/store', [PrestasiController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PrestasiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PrestasiController::class, 'update'])->name('update');
            Route::delete('/{id}', [PrestasiController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('galeri')->name('admin.galeri.')->group(function () {
            Route::get('/', [GaleriController::class, 'index'])->name('index');
            Route::post('/', [GaleriController::class, 'store'])->name('store');
            Route::delete('/{galeri}', [GaleriController::class, 'destroy'])->name('destroy');
        });

        // ------------------------------------------
        // KHUSUS SUPER ADMIN SAJA
        // ------------------------------------------
        Route::middleware(['super_admin'])->group(function () {
            
            // 1. Kelola Fasilitas
            Route::resource('fasilitas', FasilitasController::class)->names([
                'index'   => 'admin.fasilitas.index',
                'create'  => 'admin.fasilitas.create',
                'store'   => 'admin.fasilitas.store',
                'edit'    => 'admin.fasilitas.edit',
                'update'  => 'admin.fasilitas.update',
                'destroy' => 'admin.fasilitas.destroy',
            ]);

            // 2. Kelola Pengurus
            Route::resource('pengurus', PengurusController::class)->names([
                'index'   => 'admin.pengurus.index',
                'create'  => 'admin.pengurus.create',
                'store'   => 'admin.pengurus.store',
                'edit'    => 'admin.pengurus.edit',
                'update'  => 'admin.pengurus.update',
                'destroy' => 'admin.pengurus.destroy',
            ]);

            // 3. Kelola Profil Asrama
            Route::get('/profil-asrama/edit', [ProfilAsramaController::class, 'edit'])->name('admin.profil.edit');
            Route::put('/profil-asrama/update', [ProfilAsramaController::class, 'update'])->name('admin.profil.update');

            // 4. KELOLA AKUN USER (Baru)
            Route::resource('users', UserController::class)->names('admin.users');
        });
    });
});

require __DIR__.'/auth.php';