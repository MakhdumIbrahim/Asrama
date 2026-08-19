<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
   {
       Schema::create('pengurus', function (Blueprint $table) {
           $table->id();
           $table->string('nama_lengkap');
           $table->string('jabatan');
           $table->string('foto')->nullable(); // Untuk path gambar
           $table->string('kontak')->nullable(); // Nomor WA/Email
           $table->text('deskripsi_singkat')->nullable();
           $table->timestamps();
       });
   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penguruses');
    }
};
