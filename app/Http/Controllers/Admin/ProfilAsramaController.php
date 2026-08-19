<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanAsrama;
use Illuminate\Http\Request;

class ProfilAsramaController extends Controller
{
    // Menampilkan halaman form edit profil asrama
    public function edit()
    {
        // Ambil data pertama (ID 1) yang disuntikkan lewat seeder kemarin
        $profil = PengaturanAsrama::first();
        return view('admin.profil.edit', compact('profil'));
    }

    // Menyimpan perubahan data ke database
    public function update(Request $request)
    {
        $request->validate([
            'nama_asrama' => 'required|string|max:255',
            'sejarah_singkat' => 'required|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);

        $profil = PengaturanAsrama::first();
        
        // Jika karena suatu hal datanya kosong di database, buat baru otomatis
        if (!$profil) {
            $profil = new PengaturanAsrama();
        }

        $profil->nama_asrama = $request->nama_asrama;
        $profil->sejarah_singkat = $request->sejarah_singkat;
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;
        $profil->save();

        return redirect()->route('admin.profil.edit')->with('success', 'Profil Asrama Diniyah berhasil diperbarui!');
    }
}