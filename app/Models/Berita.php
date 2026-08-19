<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class Berita extends Model
{
    Protected $table = 'berita';
    Protected $fillable = ['judul', 'slug', 'konten', 'foto', 'user_id'];

    // Relasi: Berita ini ditulis oleh siapa?
    Public function user()
    {
        Return $this->belongsTo(User::class);
    }
}