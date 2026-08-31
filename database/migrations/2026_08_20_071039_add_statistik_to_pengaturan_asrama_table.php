<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan_asrama', function (Blueprint $table) {
            $table->integer('jumlah_santri')->default(0)->after('misi');
            $table->integer('jumlah_kamar')->default(0)->after('jumlah_santri');
            $table->integer('jumlah_pengurus')->default(0)->after('jumlah_kamar');
            $table->integer('jumlah_kelas')->default(0)->after('jumlah_pengurus');
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_asrama', function (Blueprint $table) {
            $table->dropColumn(['jumlah_santri', 'jumlah_kamar', 'jumlah_pengurus', 'jumlah_kelas']);
        });
    }
};