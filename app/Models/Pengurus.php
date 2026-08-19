<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    // Tambahkan baris ini untuk mengunci nama tabel ke bahasa Indonesia
    protected $table = 'pengurus';

    // Jika kamu ingin field apa saja yang boleh diisi nantinya (Mass Assignment)
    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'foto',
        'kontak',
    ];
}