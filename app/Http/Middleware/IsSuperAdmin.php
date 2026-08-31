<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login dan memiliki role 'super_admin', izinkan lewat
        if (auth()->check() && auth()->user()->role === 'super_admin') {
            return $next($request);
        }

        // Jika sekretaris mencoba masuk ke URL super admin, tendang ke dashboard
        return redirect('/dashboard')->with('error', 'Akses Ditolak! Halaman tersebut hanya bisa diakses oleh Super Admin.');
    }
}