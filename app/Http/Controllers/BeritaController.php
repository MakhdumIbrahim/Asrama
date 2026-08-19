<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

Class BeritaController extends Controller
{
    Public function index()
    {
        $berita = Berita::latest()->paginate(10);
        Return view('admin.berita.index', compact('berita'));
    }

    Public function create()
    {
        Return view('admin.berita.create');
    }

    public function edit($id)
    {
        // Mencari data berita berdasarkan ID
        $berita = Berita::findOrFail($id);

        // Mengembalikan view edit (pastikan file view-nya ada di resources/views/admin/berita/edit.blade.php atau sesuaikan lokasinya)
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, $id)
    {
        // 1. Cari berita berdasarkan ID
        $berita = Berita::findOrFail($id);
        
        // 2. Validasi input (Samakan max ukuran foto dengan fungsi store: 10120)
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10120',
        ]);

        // 3. Siapkan data yang akan diupdate
        $data = [
            'judul' => $request->judul,
            'konten' => $request->konten,
        ];

        // 4. Jika ada foto baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto) {
                Storage::disk('public')->delete($berita->foto);
            }
            // Simpan foto baru (Samakan nama folder dengan fungsi store: 'foto-berita')
            $data['foto'] = $request->file('foto')->store('foto-berita', 'public');
        }

        // 5. Update database
        $berita->update($data);

        // 6. Redirect dengan pesan sukses
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }
    Public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10120',
        ]);

        $fotoPath = null;
        If ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto-berita', 'public');
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul) . '-' . rand(100, 999), // SEO Friendly Slug
            'konten' => $request->konten,
            'foto' => $fotoPath,
            'user_id' => auth()->id(),
        ]);

        Return redirect()->route('berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    Public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        If ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }
        $berita->delete();

        Return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}