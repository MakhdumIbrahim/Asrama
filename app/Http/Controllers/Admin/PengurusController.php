<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    // 1. Menampilkan daftar pengurus di halaman admin
    public function index()
    {
        $pengurus = Pengurus::latest()->paginate(10);
        return view('admin.pengurus.index', compact('pengurus'));
    }

    // 2. Menampilkan form tambah pengurus
    public function create()
    {
        return view('admin.pengurus.create');
    }

    // 3. Menyimpan data pengurus baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        Pengurus::create($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit data (Menggunakan ID Manual agar aman)
    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    // 5. Memperbarui data pengurus
    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kontak' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada sebelum ganti yang baru
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-pengurus', 'public');
        }

        $pengurus->update($data);

        return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil diperbarui!');
    }

    // 6. Menghapus data pengurus beserta filenya
    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        
        $pengurus->delete();

        return redirect()->route('admin.pengurus.index')->with('success', 'Data pengurus berhasil dihapus!');
    }
}