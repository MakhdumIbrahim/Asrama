<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Asrama Diniyah') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="antialiased bg-slate-950 text-slate-200">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-slate-900/50 backdrop-blur-md border-b border-slate-800 shadow-sm">
                    <div class="max-w-7xl mx-auto py-8 px-6 lg:px-8">
                        <div class="text-2xl font-bold text-white tracking-tight">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Tambahkan SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>
            // 1. Konfigurasi Toast Notifikasi (Pojok Kanan Atas)
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#1e293b', // slate-800
                color: '#f8fafc', // slate-50
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Trigger Toast jika ada session('success') dari Controller
            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif

            // 2. Fungsi Global untuk Konfirmasi Hapus Data
            function confirmDelete(event, formElement) {
                event.preventDefault(); // Hentikan form submit otomatis
                
                Swal.fire({
                    title: 'Hapus Data Ini?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444', // red-500
                    cancelButtonColor: '#475569', // slate-600
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#0f172a', // slate-950
                    color: '#f8fafc',
                    customClass: {
                        popup: 'border border-slate-800 rounded-2xl shadow-2xl',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        formElement.submit(); // Submit form jika user klik 'Ya'
                    }
                });
            }
        </script>
    </body>
</html>