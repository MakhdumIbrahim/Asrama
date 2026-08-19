<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi'; // Pastikan nama tabel di DB sama persis
    protected $fillable = ['judul', 'keterangan', 'foto'];
}
