<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanAsrama extends Model
{
    protected $table = 'pengaturan_asrama';
    
    protected $fillable = [
        'nama_asrama', 
        'sejarah_singkat', 
        'visi', 
        'misi',
        'jumlah_santri',
        'jumlah_kamar',
        'jumlah_pengurus',
        'jumlah_kelas'
    ];
}