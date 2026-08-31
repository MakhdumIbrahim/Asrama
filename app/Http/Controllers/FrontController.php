<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAsrama;
use App\Models\Pengurus;
use App\Models\Berita;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Fasilitas; // 1. Impor Model Fasilitas

class FrontController extends Controller
{
    public function index()
    {
        $profil = PengaturanAsrama::first();
        $pengurus = Pengurus::all();
        $berita = Berita::latest()->take(3)->get();
        $prestasi = Prestasi::all();
        $galeri = Galeri::latest()->get();
        
        $fasilitas = Fasilitas::all(); // 2. Ambil data Fasilitas

        // 3. Masukkan 'fasilitas' ke dalam compact
        return view('welcome', compact('profil', 'pengurus', 'berita', 'prestasi', 'galeri', 'fasilitas'));
    }

    public function showBerita($id)
    {
        $berita = Berita::findOrFail($id);
        $profil = PengaturanAsrama::first(); 
        
        return view('berita-detail', compact('berita', 'profil'));
    }
}