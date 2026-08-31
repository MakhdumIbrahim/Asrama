<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Asrama Diniyah') }}</title>

        <!-- Fonts & Scripts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { 
                font-family: 'Inter', sans-serif; 
                background-color: #020617; 
                background-image: 
                    radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.15) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.1) 0px, transparent 50%);
                background-attachment: fixed;
            }
            .glass-card { 
                background: linear-gradient(145deg, rgba(30, 41, 59, 0.4) 0%, rgba(15, 23, 42, 0.6) 100%);
                backdrop-filter: blur(16px); 
                -webkit-backdrop-filter: blur(16px);
            }
        </style>
    </head>
    <body class="text-slate-300 antialiased selection:bg-sky-500 selection:text-white min-h-screen flex flex-col justify-center items-center p-4 overflow-x-hidden w-full max-w-full">
        
        <!-- Bagian <a href="/"><x-application-logo /></a> bawaan Breeze di sini sudah dihapus -->
        
        <div class="w-full">
            {{ $slot }}
        </div>

    </body>
</html>