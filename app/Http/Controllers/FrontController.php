<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAsrama;
use App\Models\Pengurus;
use App\Models\Berita;
use App\Models\Prestasi;

class FrontController extends Controller
{
    public function index()
    {
        $profil = PengaturanAsrama::first();
        $pengurus = Pengurus::all();
        $berita = Berita::latest()->take(3)->get();
        $prestasi = \App\Models\Prestasi::all();

        // Masukkan $prestasi ke dalam compact
        return view('welcome', compact('profil', 'pengurus', 'berita', 'prestasi'));
    }

    public function showBerita($id)
    {
        // Mencari berita berdasarkan ID. Jika tidak ada, akan error 404 otomatis.
        $berita = Berita::findOrFail($id);
        $profil = PengaturanAsrama::first(); 
        
        return view('berita-detail', compact('berita', 'profil'));
    }
}