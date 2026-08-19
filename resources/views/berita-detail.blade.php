<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Asrama Diniyah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #020617; }
    </style>
</head>
<body class="text-slate-300 antialiased selection:bg-sky-500 selection:text-white">

    <!-- Tombol Kembali -->
    <div class="container mx-auto px-6 py-10 max-w-4xl">
        <a href="{{ url('/') }}" class="inline-flex items-center text-[11px] font-bold text-slate-400 hover:text-sky-400 transition-colors uppercase tracking-[0.2em] bg-slate-900/50 px-5 py-2.5 rounded-full border border-slate-800 hover:border-sky-900">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>
    </div>

    <!-- Area Konten Utama -->
    <article class="container mx-auto px-6 max-w-3xl pb-24">
        <!-- Header Berita -->
        <header class="mb-12">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight tracking-tight drop-shadow-md">
                {{ $berita->judul }}
            </h1>
            <div class="flex items-center text-[11px] text-sky-500 font-semibold uppercase tracking-[0.2em]">
                <span>Diterbitkan pada {{ $berita->created_at->format('d M Y') }}</span>
            </div>
        </header>

        <!-- Gambar Utama -->
        @if($berita->foto)
            <div class="mb-14 rounded-[2rem] overflow-hidden border border-slate-800 shadow-2xl shadow-sky-900/10">
                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-auto object-cover max-h-[500px]">
            </div>
        @endif

        <!-- Teks Berita -->
        <div class="text-[15px] md:text-base text-slate-300 leading-loose font-light space-y-6 text-justify">
            {{-- Menggunakan nl2br dan e() untuk mengubah enter (newline) dari database menjadi tag <br> yang aman --}}
            {!! nl2br(e($berita->konten)) !!}
        </div>
    </article>

    <!-- Footer Simple -->
    <footer class="py-12 text-center text-[10px] text-slate-600 uppercase tracking-[0.3em] border-t border-slate-900/50">
        &copy; {{ date('Y') }} {{ $profil->nama_asrama ?? 'Asrama Diniyah' }}
    </footer>

</body>
</html>