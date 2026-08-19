<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::latest()->paginate(10);
        return view('admin.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:10120',
        ]);

        $path = $request->file('foto')->store('prestasi', 'public');

        Prestasi::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'foto' => $path
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $prestasi = Prestasi::findOrFail($id);
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10120',
        ]);

        $prestasi = Prestasi::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            // Simpan foto baru
            $prestasi->foto = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->judul = $request->judul;
        $prestasi->keterangan = $request->keterangan;
        $prestasi->save();

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        // Hapus file gambar dari storage
        if ($prestasi->foto && Storage::disk('public')->exists($prestasi->foto)) {
            Storage::disk('public')->delete($prestasi->foto);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')->with('success', 'Data prestasi berhasil dihapus!');
    }
}