<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengurus; // Import Model Pengurus

class PengurusSeeder extends Seeder
{
    public function run(): void
    {
        // Data contoh Pengurus Asrama Diniyah
        Pengurus::create([
            'nama_lengkap' => 'Ustadz KH. Ahmad Fauzi, M.Pd.',
            'jabatan' => 'Kepala Pengasuh Asrama',
            'foto' => null, // Kita set null dulu, nanti diganti lewat dashboard
            'kontak' => '6281234567890', // Format nomor WA diawali 62
            'deskripsi_singkat' => 'Bertanggung jawab atas seluruh kebijakan pembinaan spiritual dan kedisiplinan santri.'
        ]);

        Pengurus::create([
            'nama_lengkap' => 'Ustadz Muhammad Ridho, S.Ag.',
            'jabatan' => 'Mudir Diniyah (Kurikulum)',
            'foto' => null,
            'kontak' => '6289876543210',
            'deskripsi_singkat' => 'Mengatur jalannya kurikulum kajian kitab kuning dan jadwal madrasah diniyah malam.'
        ]);

        Pengurus::create([
            'nama_lengkap' => 'Ustazah Siti Aminah, S.Pd.',
            'jabatan' => 'Bendahara & Kesantrian Putri',
            'foto' => null,
            'kontak' => '6285555555555',
            'deskripsi_singkat' => 'Mengelola administrasi keuangan asrama serta pembimbing utama organisasi santri putri.'
        ]);
    }
}