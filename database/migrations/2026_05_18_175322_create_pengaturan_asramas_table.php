<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('pengaturan_asrama', function (Blueprint $table) {
        $table->id();
        $table->string('nama_asrama');
        $table->text('sejarah_singkat');
        $table->text('visi')->nullable();
        $table->text('misi')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_asramas');
    }
};
