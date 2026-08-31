<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengaturanAsrama; // 1. WAJIB IMPORT MODEL INI DI SINI

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder pengurus
        $this->call([
            PengurusSeeder::class,
        ]);

        // 2. Sekarang ini akan terbaca sebagai Model, bukan Seeder lagi
        PengaturanAsrama::create([
            'nama_asrama' => 'Asrama Diniyah',
            'sejarah_singkat' => 'Asrama Diniyah didirikan sebagai bagian integral dari upaya pondok pesantren untuk memberikan pembinaan intensif bagi para santri. Sejak awal berdirinya, lembaga ini berfokus pada integrasi pendidikan agama formal ("diniyah") dan penguatan karakter kemandirian santri dalam kehidupan sehari-hari.',
            'visi' => 'Mencetak generasi santri yang bertafaqquh fiddin, berakhlakul karimah, dan adaptif terhadap kemajuan teknologi.',
            'misi' => 'Menyelenggarakan kajian kitab kuning secara terstruktur, menegakkan kedisiplinan ibadah, dan membekali santri dengan kecakapan hidup modern.'
        ]);

        $this->call(UserSeeder::class);
    }
}