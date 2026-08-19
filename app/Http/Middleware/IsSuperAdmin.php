<?php

namespace App\Http\Middleware;

Class IsSuperAdmin
{
    Public function handle($request, \Closure $next)
    {
        // Jika user sudah login dan memiliki role 'super_admin', izinkan lewat
        if (auth()->check() && auth()->user()->role === 'super_admin') {
            Return $next($request);
        }

        // Jika bukan super_admin, tendang kembali ke dashboard dengan pesan peringatan
        Return redirect('/dashboard')->with('error', 'Akses Ditolak! Halaman tersebut hanya untuk Super Admin.');
    }
}
