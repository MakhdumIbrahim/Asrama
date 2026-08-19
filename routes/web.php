<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfilAsramaController;
use App\Http\Controllers\BeritaController;
use App\Models\Pengurus;
use App\Models\Berita;
use App\Http\Controllers\PrestasiController;

Route::get('/', [FrontController::class, 'index']);

Route::get('/berita/{id}', [FrontController::class, 'showBerita'])->name('berita.show');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'pengurus' => Pengurus::all(),
            'berita'   => Berita::all(),
        ]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- PERBAIKAN RUTE PRESTASI ---
    Route::prefix('admin/prestasi')->name('prestasi.')->group(function () {
        Route::get('/', [PrestasiController::class, 'index'])->name('index');
        Route::get('/create', [PrestasiController::class, 'create'])->name('create');
        Route::post('/store', [PrestasiController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PrestasiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PrestasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [PrestasiController::class, 'destroy'])->name('destroy');
    }); // <--- KURUNG TUTUP INI TADI HILANG DI KODE ANDA

    // --- PROTEKSI SUPER ADMIN ---
    Route::middleware(['super_admin'])->group(function () {
        Route::get('admin/profil-asrama/edit', [ProfilAsramaController::class, 'edit'])->name('admin.profil.edit');
        Route::put('admin/profil-asrama/update', [ProfilAsramaController::class, 'update'])->name('admin.profil.update');
        
        Route::resource('admin/pengurus', PengurusController::class)->names([
            'index' => 'admin.pengurus.index',
            'create' => 'admin.pengurus.create',
            'store' => 'admin.pengurus.store',
            'edit' => 'admin.pengurus.edit',
            'update' => 'admin.pengurus.update',
            'destroy' => 'admin.pengurus.destroy',
        ]);
    });
    
    // --- RUTE STAFF ---
    Route::resource('admin/berita', BeritaController::class)->names('berita');
});

require __DIR__.'/auth.php';