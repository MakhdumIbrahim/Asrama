<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asrama Diniyah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #020617; }
        .glass-card { 
            background: rgba(15, 23, 42, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(56, 189, 248, 0.1);
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .glass-card:hover { border-color: rgba(56, 189, 248, 0.3); transform: translateY(-5px); box-shadow: 0 20px 40px -15px rgba(2, 132, 199, 0.15); }
        .hero-gradient { background: radial-gradient(circle at top, #0c4a6e 0%, #020617 70%); }

        /* Animasi berdenyut untuk tombol WhatsApp */
        @keyframes pulse-whatsapp {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
        .wa-float {
            animation: pulse-whatsapp 2s infinite;
        }
    </style>
</head>
<body class="text-slate-300 antialiased selection:bg-sky-500 selection:text-white">

    <div class="fixed top-6 right-6 z-50">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="text-[10px] font-bold text-white bg-slate-800/60 backdrop-blur-xl hover:bg-sky-900/60 px-6 py-2 rounded-full border border-slate-700 transition-all hover:scale-105 uppercase tracking-widest shadow-2xl">Dashboard Admin</a>
            @else
                <a href="{{ route('login') }}" class="text-[10px] font-bold text-white bg-sky-600 hover:bg-sky-500 px-6 py-2 rounded-full shadow-lg shadow-sky-950/50 transition-all hover:scale-105 uppercase tracking-widest">Login</a>
            @endauth
        @endif
    </div>

    <header class="relative min-h-[55vh] flex items-center justify-center hero-gradient text-white overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
        <div class="container mx-auto px-6 text-center z-10 animate__animated animate__fadeIn">
            <div class="w-20 h-20 bg-sky-500/10 backdrop-blur-xl rounded-3xl mx-auto mb-8 flex items-center justify-center border border-sky-500/20 shadow-2xl shadow-sky-900/20">
                <img src="{{ asset('storage/logo/logo_asrama.jpg-removebg-preview.png') }}" alt="Logo Asrama" class="h-30 w-auto object-contain" />
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tighter mb-4 uppercase drop-shadow-lg">
                {{ $profil->nama_asrama ?? 'ASRAMA DINIYAH' }}
            </h1>
            <p class="text-[12px] text-sky-200/60 font-medium max-w-sm mx-auto leading-relaxed bg-white/5 px-6 py-2 rounded-full backdrop-blur-sm border border-white/5 uppercase tracking-[0.2em]">
                Pondok Pesantren Nurul Jadid
            </p>
        </div>
    </header>

    <section class="py-20 container mx-auto px-6">
        <div class="glass-card rounded-[2.5rem] shadow-2xl p-10 md:p-16 mb-12">
            <h2 class="text-lg font-bold text-white mb-8 uppercase tracking-[0.3em] text-center opacity-80">Sejarah</h2>
            <p class="text-[13px] text-slate-400 leading-loose text-justify max-w-2xl mx-auto font-light">
                {{ $profil->sejarah_singkat ?? 'Data sejarah asrama belum tersedia.' }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="glass-card p-10 rounded-[2.5rem]">
                <h3 class="text-xs font-bold text-white mb-6 flex items-center gap-3 uppercase tracking-[0.2em]">🎯 Visi</h3>
                <p class="text-[13px] text-slate-400 leading-relaxed italic font-light">"{{ $profil->visi ?? 'Belum ada data visi.' }}"</p>
            </div>
            <div class="glass-card p-10 rounded-[2.5rem]">
                <h3 class="text-xs font-bold text-white mb-6 flex items-center gap-3 uppercase tracking-[0.2em]">🚀 Misi</h3>
                <ul class="text-[13px] text-slate-400 space-y-3 font-light">
                    @foreach(explode("\n", str_replace("\r", "", $profil->misi ?? '')) as $poinMisi)
                        @if(trim($poinMisi))
                            <li class="flex items-start"><span class="text-sky-500 mr-3 mt-0.5">✦</span> {{ trim($poinMisi) }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-900/20 border-y border-slate-900">
        <div class="container mx-auto px-6">
            <h2 class="text-lg font-bold text-white mb-16 uppercase tracking-[0.3em] text-center opacity-80">Pengurus Asrama</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($pengurus as $p)
                <div class="bg-slate-950/40 rounded-[2.5rem] p-8 text-center border border-slate-800 transition-all hover:border-sky-900/50 hover:bg-slate-900/60 group">
                    <div class="w-24 h-24 rounded-full mx-auto mb-6 overflow-hidden border border-slate-800 shadow-xl group-hover:scale-105 transition-all">
                        @if($p->foto)
                            <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-800 flex items-center justify-center text-sky-500 font-bold">{{ substr($p->nama_lengkap, 0, 1) }}</div>
                        @endif
                    </div>
                    <h3 class="text-[13px] font-bold text-white mb-1">{{ $p->nama_lengkap }}</h3>
                    <p class="text-sky-500 font-medium text-[10px] uppercase tracking-widest mb-6 opacity-90">{{ $p->jabatan }}</p>
                    <a href="https://wa.me/{{ $p->kontak }}" class="inline-block bg-slate-800 text-[10px] text-sky-300 px-6 py-2 rounded-full font-bold hover:bg-sky-950 hover:text-white transition uppercase tracking-widest">Kontak</a>
                </div>
                @empty
                <p class="col-span-3 text-center text-slate-700 text-xs uppercase tracking-widest">Data belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-20 container mx-auto px-6">
        <h2 class="text-lg font-bold text-white mb-16 uppercase tracking-[0.3em] text-center opacity-80">Berita</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($berita as $b)
            <!-- Mengubah div menjadi a (link) dan menambahkan efek hover grup -->
            <a href="{{ route('berita.show', $b->id) }}" class="block glass-card rounded-[2.5rem] overflow-hidden hover:scale-105 transition-all duration-300 group cursor-pointer">
                @if($b->foto)
                    <img src="{{ asset('storage/' . $b->foto) }}" class="w-full h-48 object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                @endif
                <div class="p-8">
                    <!-- Efek warna judul berubah saat card di-hover -->
                    <h3 class="font-bold text-[13px] text-white mb-3 group-hover:text-sky-400 transition-colors">{{ $b->judul }}</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed line-clamp-3 font-light">{{ $b->konten }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    
    <section class="py-20 container mx-auto px-6">
    <h2 class="text-lg font-bold text-white mb-16 uppercase tracking-[0.3em] text-center opacity-80">Prestasi Santri</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($prestasi as $item)
        <div class="glass-card rounded-[2rem] overflow-hidden hover:border-sky-500/50 transition-all duration-300">
            <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-40 object-cover opacity-80">
            
            <div class="p-6 text-center">
                <h3 class="text-[11px] font-bold text-white mb-1 uppercase tracking-widest">{{ $item->judul }}</h3>
                <p class="text-[9px] text-sky-400 font-semibold uppercase tracking-wider leading-tight">{{ $item->keterangan }}</p>
            </div>
        </div>
        @endforeach
    </div>
    </section>
    </div>
    </section>

    <footer class="py-12 text-center text-[10px] text-slate-700 uppercase tracking-[0.3em] border-t border-slate-900">
        &copy; {{ date('Y') }} {{ $profil->nama_asrama ?? 'Asrama Diniyah' }}
    </footer>

    <a href="https://wa.me/6287816297784?text=Assalamualaikum,%20saya%20ingin%20bertanya%20mengenai%20Asrama%20Diniyah." 
   target="_blank"
   class="fixed bottom-8 right-8 z-[100] bg-green-500 text-white p-4 rounded-full shadow-2xl hover:bg-green-600 transition-all duration-300 hover:scale-110 wa-float">
    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.031 2.008c-5.466 0-9.897 4.434-9.897 9.9 0 1.748.455 3.454 1.32 4.954L1.933 22l5.286-1.385a9.854 9.854 0 004.812 1.258h.004c5.462 0 9.895-4.434 9.895-9.9 0-2.648-1.03-5.137-2.902-7.009A9.851 9.851 0 0012.031 2.008zm0 16.634c-1.472 0-2.915-.395-4.177-1.144l-.3-.178-3.1.813.829-3.023-.195-.31c-.822-1.309-1.255-2.825-1.255-4.385 0-4.542 3.696-8.238 8.243-8.238 2.202 0 4.271.859 5.827 2.416A8.196 8.196 0 0120.274 11.9c0 4.543-3.697 8.239-8.243 8.239v-.001zm4.516-6.177c-.248-.124-1.467-.723-1.694-.806-.226-.082-.392-.124-.556.124-.165.248-.639.806-.783.97-.145.165-.289.186-.537.062-.248-.124-1.047-.386-1.996-1.23-.738-.656-1.236-1.467-1.38-1.715-.145-.248-.016-.381.108-.505.111-.111.248-.289.372-.433.124-.145.165-.248.248-.413.082-.165.041-.31-.021-.433-.062-.124-.556-1.341-.762-1.838-.202-.483-.406-.418-.556-.425-.144-.007-.31-.007-.475-.007-.165 0-.433.062-.66.31-.227.248-.867.846-.867 2.064s.887 2.395 1.011 2.56c.124.165 1.747 2.668 4.234 3.74.592.254 1.054.406 1.413.52.595.189 1.137.162 1.564.098.477-.07 1.467-.599 1.673-1.177.206-.578.206-1.074.145-1.177-.062-.103-.227-.165-.475-.289z"/>
    </svg>
    </a>
</body>
</html>