<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_asrama ?? 'Asrama Diniyah' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-bg: #020617;
            --color-primary: #0ea5e9;
            --color-primary-light: #38bdf8;
            --color-secondary: #0284c7;
            --glass-bg: linear-gradient(145deg, rgba(30, 41, 59, 0.45), rgba(15, 23, 42, 0.7));
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            --radius-lg: 2.5rem;
            --radius-md: 2rem;
            --radius-sm: 1.5rem;
            --transition-smooth: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
            overflow-x: hidden; 
            max-width: 100vw;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--color-bg);
            background-image: 
                radial-gradient(at 0% 0%, rgba(2, 132, 199, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(56, 189, 248, 0.04) 0px, transparent 70%);
            background-attachment: fixed;
            position: relative;
            overflow-x: hidden;
            max-width: 100%;
            color: #cbd5e1;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 15% 25%, rgba(14, 165, 233, 0.06) 0%, transparent 30%),
                radial-gradient(circle at 85% 75%, rgba(2, 132, 199, 0.05) 0%, transparent 35%),
                radial-gradient(circle at 50% 90%, rgba(56, 189, 248, 0.03) 0%, transparent 25%);
            animation: backgroundOrbs 25s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes backgroundOrbs {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(1.5%, -1.5%) scale(1.03); }
            100% { transform: translate(-1%, 1%) scale(1.01); }
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        .container, nav, footer, section {
            position: relative;
            z-index: 1;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #0ea5e9; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #0284c7; }

        .hide-scroll::-webkit-scrollbar {
            display: none;
        }
        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, #0ea5e9, #38bdf8, #0ea5e9);
            background-size: 200% auto;
            animation: progressGlow 2s linear infinite;
            z-index: 200;
            transition: width 0.1s linear;
            box-shadow: 0 0 20px rgba(14,165,233,0.6);
        }

        @keyframes progressGlow {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        .glass-card { 
            background: var(--glass-bg);
            backdrop-filter: blur(20px); 
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow), inset 0 1px 0 rgba(255,255,255,0.05);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-md);
        }
        
        .glass-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 40%;
            height: 200%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent);
            transform: rotate(25deg);
            transition: 0.8s;
            opacity: 0;
            pointer-events: none;
            z-index: 2;
        }
        .glass-card:hover::before {
            left: 120%;
            opacity: 1;
        }
        
        .glass-card:hover { 
            border-color: rgba(56, 189, 248, 0.3); 
            transform: translateY(-6px); 
            box-shadow: 0 20px 50px -12px rgba(2, 132, 199, 0.25), 
                        0 0 0 1px rgba(56, 189, 248, 0.1),
                        inset 0 1px 0 rgba(255,255,255,0.1);
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.6) 0%, rgba(15, 23, 42, 0.8) 100%);
        }

        .hero-gradient { 
            background: radial-gradient(circle at 50% 0%, rgba(12, 74, 110, 0.5) 0%, #020617 60%); 
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .hero-logo-glow {
            box-shadow: 0 0 40px rgba(14,165,233,0.3), 0 0 80px rgba(56,189,248,0.2);
            animation: logoGlow 3s ease-in-out infinite alternate;
        }
        @keyframes logoGlow {
            0% { box-shadow: 0 0 30px rgba(14,165,233,0.2); }
            100% { box-shadow: 0 0 70px rgba(56,189,248,0.5); }
        }

        .hero-title-gradient {
            background: linear-gradient(120deg, #ffffff, #bae6fd, #7dd3fc, #ffffff);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientText 8s linear infinite, textPulse 4s ease-in-out infinite alternate;
        }
        @keyframes gradientText {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes textPulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.02); }
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: radial-gradient(circle, rgba(255,255,255,0.6), rgba(56,189,248,0.3));
            border-radius: 50%;
            animation: floatParticle linear infinite;
            pointer-events: none;
            z-index: 1;
        }
        @keyframes floatParticle {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-200px) translateX(50px); opacity: 0; }
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.9s ease, transform 0.9s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.9s ease;
        }
        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.9s ease;
        }
        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
        .delay-3 { transition-delay: 0.3s; }

        .btn-shine {
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 40%;
            height: 200%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: rotate(25deg);
            transition: 0.6s;
            z-index: -1;
        }
        .btn-shine:hover::after {
            left: 120%;
        }

        .tilt-card {
            transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            transform-style: preserve-3d;
            will-change: transform;
        }
        .tilt-card:hover {
            transform: perspective(1000px) rotateX(2deg) rotateY(2deg) scale(1.03);
            box-shadow: 0 25px 50px -12px rgba(2, 132, 199, 0.3);
        }

        nav {
            transition: all 0.4s ease;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        nav.scrolled {
            background: rgba(2, 6, 23, 0.9) !important;
            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5);
            border-bottom-color: rgba(14,165,233,0.2) !important;
        }
        .nav-link {
            position: relative;
            transition: color 0.3s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-primary-light));
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        .nav-link:hover {
            color: #38bdf8 !important;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        .stat-icon {
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .glass-card:hover .stat-icon {
            transform: scale(1.2) rotate(5deg);
        }

        @keyframes pulse-whatsapp {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.6); }
            70% { box-shadow: 0 0 0 25px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }
        .wa-float {
            animation: pulse-whatsapp 2s infinite;
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .wa-float:hover {
            transform: translateY(-4px) rotate(5deg) scale(1.05);
        }

        .modal-backdrop {
            transition: opacity 0.3s ease;
        }
        .modal-content {
            transition: transform 0.4s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.3s ease;
            transform: translateY(30px) scale(0.95);
            will-change: transform, opacity;
        }
        .modal-content.active {
            transform: translateY(0) scale(1);
        }

        .map-container {
            position: relative;
        }
        .map-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent 30%, rgba(2,6,23,0.7) 100%);
            pointer-events: none;
            z-index: 2;
            border-radius: 2rem;
        }
        .map-container iframe {
            filter: grayscale(0.5) contrast(1.1) brightness(0.9);
            transition: filter 0.7s ease;
        }
        .map-container:hover iframe {
            filter: grayscale(0) contrast(1) brightness(1);
        }
    </style>
</head>
<body class="text-slate-300 antialiased selection:bg-sky-500 selection:text-white" x-data="{ openModal: false, activeFasilitas: {} }">

    <!-- Scroll Progress Bar -->
    <div id="scroll-progress"></div>

    <!-- Sticky Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-slate-950/70 backdrop-blur-2xl border-b border-white/5 transition-all w-full">
        <div class="container mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-white to-sky-300 text-xs sm:text-base tracking-widest uppercase transition-all">
                    {{ $profil->nama_asrama ?? 'ASRAMA DINIYAH' }}
                </span>
            </div>
            
            <div class="hidden lg:flex items-center gap-8 text-[11px] font-semibold uppercase tracking-[0.15em] text-slate-400">
                <a href="#sejarah" class="nav-link hover:text-sky-400 transition-colors">Sejarah</a>
                <a href="#pengurus" class="nav-link hover:text-sky-400 transition-colors">Pengurus</a>
                <a href="#fasilitas" class="nav-link hover:text-sky-400 transition-colors">Fasilitas</a> 
                <a href="#berita" class="nav-link hover:text-sky-400 transition-colors">Berita</a>
                <a href="#prestasi" class="nav-link hover:text-sky-400 transition-colors">Prestasi</a>
                <a href="#galeri" class="nav-link hover:text-sky-400 transition-colors">Galeri</a>
                <a href="#lokasi" class="nav-link hover:text-sky-400 transition-colors">Lokasi</a>
            </div>

            <div class="flex items-center gap-4">
                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-[10px] sm:text-xs font-bold text-sky-100 bg-sky-900/40 hover:bg-sky-600 px-4 py-2 sm:px-6 sm:py-2.5 rounded-full border border-sky-500/30 transition-all hover:scale-105 uppercase tracking-widest shadow-[0_0_15px_rgba(14,165,233,0.3)] btn-shine">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-[10px] sm:text-xs font-bold text-white bg-gradient-to-r from-sky-600 to-sky-400 hover:from-sky-500 hover:to-sky-300 px-4 py-2 sm:px-6 sm:py-2.5 rounded-full shadow-[0_0_20px_rgba(14,165,233,0.4)] transition-all hover:scale-105 uppercase tracking-widest btn-shine">Login</a>
                        @endauth
                    @endif
                </div>

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-slate-300 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-collapse x-cloak class="lg:hidden bg-slate-900/95 border-t border-slate-800 backdrop-blur-xl">
            <div class="flex flex-col px-4 py-4 space-y-4 text-xs font-semibold uppercase tracking-widest text-slate-400">
                <a @click="mobileMenuOpen = false" href="#sejarah" class="hover:text-sky-400 transition-colors">Sejarah</a>
                <a @click="mobileMenuOpen = false" href="#pengurus" class="hover:text-sky-400 transition-colors">Pengurus</a>
                <a @click="mobileMenuOpen = false" href="#fasilitas" class="hover:text-sky-400 transition-colors">Fasilitas</a> 
                <a @click="mobileMenuOpen = false" href="#berita" class="hover:text-sky-400 transition-colors">Berita</a>
                <a @click="mobileMenuOpen = false" href="#prestasi" class="hover:text-sky-400 transition-colors">Prestasi</a>
                <a @click="mobileMenuOpen = false" href="#galeri" class="hover:text-sky-400 transition-colors">Galeri</a>
                <a @click="mobileMenuOpen = false" href="#lokasi" class="hover:text-sky-400 transition-colors">Lokasi</a>
            </div>
        </div>
    </nav>

    <!-- Header / Hero Section -->
    <header class="relative min-h-[60vh] md:min-h-[70vh] pt-28 pb-16 flex items-center justify-center hero-gradient text-white overflow-hidden">
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[300px] sm:w-[500px] h-[300px] sm:h-[500px] bg-sky-500/10 rounded-full blur-[100px] sm:blur-[120px] animate-pulse"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.02]"></div>
        
        <div class="container mx-auto px-4 sm:px-6 text-center z-10 animate__animated animate__fadeInUp">
            <div class="w-24 h-24 sm:w-32 sm:h-32 bg-white/5 backdrop-blur-2xl rounded-3xl mx-auto mb-6 sm:mb-8 flex items-center justify-center border border-white/10 hero-logo-glow animate-float p-4 sm:p-5">
                <img src="{{ asset('storage/logo/logo_asrama.jpg-removebg-preview.png') }}" alt="Logo Asrama" class="w-full h-full object-contain drop-shadow-xl" />
            </div>
            
            <h1 class="text-2xl sm:text-4xl md:text-6xl lg:text-7xl font-black tracking-tighter mb-4 sm:mb-6 uppercase hero-title-gradient drop-shadow-2xl leading-tight">
                {{ $profil->nama_asrama ?? 'ASRAMA DINIYAH' }}
            </h1>
            
            <p class="inline-block text-[10px] sm:text-xs md:text-sm text-sky-100 font-semibold px-4 sm:px-8 py-2.5 sm:py-3 rounded-full backdrop-blur-md bg-white/5 border border-white/10 uppercase tracking-[0.15em] sm:tracking-[0.25em] shadow-xl max-w-[90%] sm:max-w-none">
                Pondok Pesantren Nurul Jadid
            </p>
        </div>
    </header>

    <!-- Sejarah -->
    <section id="sejarah" class="py-12 md:py-24 container mx-auto px-4 sm:px-6">
        <div class="glass-card rounded-[1.5rem] sm:rounded-[2.5rem] p-6 sm:p-10 md:p-16 mb-8 sm:mb-12 relative overflow-hidden reveal">
            <div class="absolute top-0 right-0 w-64 h-64 bg-sky-500/5 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-sky-500/5 rounded-full blur-[80px]"></div>
            
            <h2 class="text-xs sm:text-sm font-bold text-sky-400 mb-6 sm:mb-8 uppercase tracking-[0.2em] sm:tracking-[0.3em] text-center flex flex-col items-center gap-3">
                <span>Sejarah Asrama</span>
                <div class="w-12 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
            </h2>
            <p class="text-xs sm:text-sm md:text-base text-slate-300 leading-relaxed sm:leading-loose text-center max-w-4xl mx-auto font-light">
                {{ $profil->sejarah_singkat ?? 'Data sejarah asrama belum tersedia.' }}
            </p>
        </div>

        <div id="visi-misi" class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            <div class="glass-card p-6 sm:p-10 md:p-12 rounded-[1.5rem] sm:rounded-[2.5rem] relative overflow-hidden group reveal-left">
                <div class="absolute -left-10 -top-10 w-32 h-32 bg-sky-600/10 rounded-full blur-3xl group-hover:bg-sky-500/20 transition-colors duration-500"></div>
                <h3 class="text-xs font-bold text-sky-400 mb-4 sm:mb-6 flex items-center gap-3 uppercase tracking-[0.2em]">
                    <span class="p-2 bg-sky-500/10 rounded-lg shadow-lg">🎯</span> Visi
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed italic font-light text-justify">"{{ $profil->visi ?? 'Belum ada data visi.' }}"</p>
            </div>
            
            <div class="glass-card p-6 sm:p-10 md:p-12 rounded-[1.5rem] sm:rounded-[2.5rem] relative overflow-hidden group reveal-right">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-sky-600/10 rounded-full blur-3xl group-hover:bg-sky-500/20 transition-colors duration-500"></div>
                <h3 class="text-xs font-bold text-sky-400 mb-4 sm:mb-6 flex items-center gap-3 uppercase tracking-[0.2em]">
                    <span class="p-2 bg-sky-500/10 rounded-lg shadow-lg">🚀</span> Misi
                </h3>
                <ul class="text-xs sm:text-sm text-slate-300 space-y-3 sm:space-y-4 font-light">
                    @foreach(explode("\n", str_replace("\r", "", $profil->misi ?? '')) as $poinMisi)
                        @if(trim($poinMisi))
                            <li class="flex items-start">
                                <span class="text-sky-500 mr-3 mt-0.5 sm:mt-1 text-base sm:text-lg leading-none">&bull;</span> 
                                <span>{{ trim($poinMisi) }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Statistik Asrama -->
    <section class="py-12 md:py-24 container mx-auto px-4 sm:px-6" x-data="statAnimation()">
        <div class="text-center mb-10 sm:mb-16 flex flex-col items-center reveal">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight uppercase text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-3 sm:mb-4">
                Statistik Asrama
            </h2>
            <div class="w-24 sm:w-32 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 lg:gap-8">
            <div class="glass-card rounded-[1.5rem] sm:rounded-[2rem] p-4 sm:p-8 text-center relative overflow-hidden group reveal tilt-card">
                <div class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-sky-500/20 to-sky-900/40 rounded-2xl mx-auto flex items-center justify-center text-sky-400 text-lg sm:text-2xl mb-3 sm:mb-6 border border-white/5 shadow-lg stat-icon">👨‍🎓</div>
                <h3 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white mb-1 sm:mb-3 tracking-tighter" x-text="currentSantri">
                    {{ $profil->jumlah_santri ?? 0 }}
                </h3>
                <p class="text-[8px] sm:text-[10px] font-bold text-sky-400/80 uppercase tracking-[0.2em]">Jumlah Santri</p>
            </div>

            <div class="glass-card rounded-[1.5rem] sm:rounded-[2rem] p-4 sm:p-8 text-center relative overflow-hidden group reveal tilt-card delay-1">
                <div class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-sky-500/20 to-sky-900/40 rounded-2xl mx-auto flex items-center justify-center text-sky-400 text-lg sm:text-2xl mb-3 sm:mb-6 border border-white/5 shadow-lg stat-icon">🛏️</div>
                <h3 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white mb-1 sm:mb-3 tracking-tighter" x-text="currentKamar">
                    {{ $profil->jumlah_kamar ?? 0 }}
                </h3>
                <p class="text-[8px] sm:text-[10px] font-bold text-sky-400/80 uppercase tracking-[0.2em]">Jumlah Kamar</p>
            </div>

            <div class="glass-card rounded-[1.5rem] sm:rounded-[2rem] p-4 sm:p-8 text-center relative overflow-hidden group reveal tilt-card delay-2">
                <div class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-sky-500/20 to-sky-900/40 rounded-2xl mx-auto flex items-center justify-center text-sky-400 text-lg sm:text-2xl mb-3 sm:mb-6 border border-white/5 shadow-lg stat-icon">👥</div>
                <h3 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white mb-1 sm:mb-3 tracking-tighter" x-text="currentPengurus">
                    {{ $profil->jumlah_pengurus ?? 0 }}
                </h3>
                <p class="text-[8px] sm:text-[10px] font-bold text-sky-400/80 uppercase tracking-[0.2em]">Pengurus</p>
            </div>

            <div class="glass-card rounded-[1.5rem] sm:rounded-[2rem] p-4 sm:p-8 text-center relative overflow-hidden group reveal tilt-card delay-3">
                <div class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-sky-500/20 to-sky-900/40 rounded-2xl mx-auto flex items-center justify-center text-sky-400 text-lg sm:text-2xl mb-3 sm:mb-6 border border-white/5 shadow-lg stat-icon">🏫</div>
                <h3 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white mb-1 sm:mb-3 tracking-tighter" x-text="currentKelas">
                    {{ $profil->jumlah_kelas ?? 0 }}
                </h3>
                <p class="text-[8px] sm:text-[10px] font-bold text-sky-400/80 uppercase tracking-[0.2em]">Kelas KBM</p>
            </div>
        </div>
    </section>

    <!-- Pengurus (Ditambahkan padding pt-6 px-2 agar card tidak terpotong atasnya saat digeser/hover) -->
    <section id="pengurus" class="py-12 md:py-24 bg-slate-900/30 border-y border-white/5 relative">
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="text-center mb-10 sm:mb-16 flex flex-col items-center reveal">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight uppercase text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-3 sm:mb-4">
                    Struktur Pengurus
                </h2>
                <div class="w-24 sm:w-32 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
            </div>
            
            <div class="flex items-start md:grid md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-8 overflow-x-auto hide-scroll pt-6 pb-6 px-2 snap-x snap-mandatory">
                @forelse($pengurus as $p)
                <div class="flex-none w-[75vw] sm:w-[300px] md:w-auto snap-start glass-card rounded-[1.5rem] sm:rounded-[2rem] p-6 sm:p-8 text-center group tilt-card reveal">
                    <div class="relative w-24 h-24 sm:w-28 sm:h-28 mx-auto mb-6">
                        <div class="absolute inset-0 bg-sky-500 rounded-full blur-md opacity-20 group-hover:opacity-50 transition-opacity duration-500"></div>
                        <div class="w-full h-full rounded-full overflow-hidden border-2 border-slate-700 group-hover:border-sky-500 transition-all duration-500 relative z-10 bg-slate-900">
                            @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-2xl sm:text-3xl text-sky-500 font-black">{{ substr($p->nama_lengkap, 0, 1) }}</div>
                            @endif
                        </div>
                    </div>
                    <h3 class="text-xs sm:text-sm font-bold text-white mb-2 line-clamp-1 group-hover:text-sky-300 transition-colors">{{ $p->nama_lengkap }}</h3>
                    <p class="text-sky-400 font-medium text-[10px] uppercase tracking-widest mb-6 bg-sky-500/10 inline-block px-3 py-1 rounded-full">{{ $p->jabatan }}</p>
                    <a href="https://wa.me/{{ $p->kontak }}" target="_blank" class="block w-full bg-white/5 border border-white/10 text-[10px] text-slate-300 py-2.5 sm:py-3 rounded-xl font-bold hover:bg-sky-600 hover:text-white hover:border-sky-500 transition-all uppercase tracking-widest shadow-lg btn-shine">Hubungi</a>
                </div>
                @empty
                <p class="col-span-full w-full text-center text-slate-500 text-xs uppercase tracking-widest">Data pengurus belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Fasilitas -->
    <section id="fasilitas" class="py-12 md:py-24">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-10 sm:mb-16 flex flex-col items-center reveal">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight uppercase text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-3 sm:mb-4">
                    Fasilitas Asrama
                </h2>
                <div class="w-24 sm:w-32 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
            </div>

            <div class="flex items-start md:grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8 overflow-x-auto hide-scroll pt-6 pb-6 px-2 snap-x snap-mandatory">
                @forelse($fasilitas as $f)
                <div class="flex-none w-[85vw] sm:w-[350px] md:w-auto snap-start glass-card rounded-[1.5rem] sm:rounded-[2rem] overflow-hidden flex flex-col group reveal">
                    <div class="relative h-48 sm:h-60 overflow-hidden bg-slate-950">
                        @if($f->foto)
                            <img src="{{ asset('storage/' . $f->foto) }}" alt="{{ $f->nama_fasilitas }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-600 text-xs sm:text-sm bg-slate-900/50">Tidak Ada Foto</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    </div>

                    <div class="p-6 sm:p-8 flex flex-col flex-grow -mt-6 sm:-mt-8 relative z-10">
                        <h3 class="text-lg sm:text-xl font-bold text-white mb-2 sm:mb-3 group-hover:text-sky-400 transition-colors">
                            {{ $f->nama_fasilitas }}
                        </h3>
                        <p class="text-slate-400 text-xs sm:text-sm line-clamp-2 mb-6 sm:mb-8 flex-grow font-light">
                            {{ $f->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                        </p>

                        <button @click="openModal = true; activeFasilitas = { nama: '{{ addslashes($f->nama_fasilitas) }}', keterangan: `{{ addslashes($f->keterangan ?? 'Tidak ada keterangan tambahan.') }}`, foto: '{{ $f->foto ? asset('storage/' . $f->foto) : '' }}' }" 
                            class="w-full bg-white/5 hover:bg-sky-600 text-slate-300 hover:text-white py-3 px-4 rounded-xl text-[10px] sm:text-[11px] uppercase tracking-widest font-bold transition-all duration-300 border border-white/10 hover:border-sky-500 flex items-center justify-center gap-2 btn-shine">
                            <span>Lihat Detail</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-full w-full text-center py-12 text-slate-500 italic">Belum ada data fasilitas.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Berita -->
    <section id="berita" class="py-12 md:py-24 bg-slate-900/30 border-y border-white/5 relative">
        <div class="container mx-auto px-4 sm:px-6">
            <h2 class="text-xs sm:text-sm font-bold text-sky-400 mb-8 sm:mb-12 uppercase tracking-[0.2em] sm:tracking-[0.3em] text-center flex flex-col items-center gap-3 reveal">
                <span>Berita & Informasi</span>
                <div class="w-12 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
            </h2>

            <div class="flex items-start md:grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8 overflow-x-auto hide-scroll pt-6 pb-6 px-2 snap-x snap-mandatory">
                @forelse($berita as $b)
                <a href="{{ route('berita.show', $b->id) }}" class="flex-none w-[85vw] sm:w-[350px] md:w-auto snap-start block glass-card rounded-[1.5rem] sm:rounded-[2rem] overflow-hidden group cursor-pointer flex flex-col reveal">
                    <div class="relative h-48 sm:h-56 overflow-hidden">
                        @if($b->foto)
                            <img src="{{ asset('storage/' . $b->foto) }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500">
                        @else
                            <div class="w-full h-full bg-slate-900 flex items-center justify-center text-xs text-slate-600">Tidak ada gambar</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-6 sm:p-8 flex-grow flex flex-col">
                        <h3 class="font-bold text-sm sm:text-base text-white mb-3 group-hover:text-sky-400 transition-colors leading-snug">{{ $b->judul }}</h3>
                        <p class="text-xs text-slate-400 leading-relaxed line-clamp-3 font-light mb-6">{{ $b->konten }}</p>
                        <div class="mt-auto flex items-center text-[10px] text-sky-500 font-bold uppercase tracking-widest gap-2 group-hover:translate-x-2 transition-transform">
                            Baca Selengkapnya <span>&rarr;</span>
                        </div>
                    </div>
                </a>
                @empty
                <p class="col-span-full w-full text-center text-slate-500 text-xs uppercase tracking-widest">Belum ada berita dipublikasikan.</p>
                @endforelse
            </div>
        </div>
    </section>
    
    <!-- Prestasi & Galeri Wrapper -->
    <div class="relative">
        <!-- Prestasi -->
        <section id="prestasi" class="py-12 md:py-24 container mx-auto px-4 sm:px-6">
            <h2 class="text-xs sm:text-sm font-bold text-sky-400 mb-8 sm:mb-12 uppercase tracking-[0.2em] sm:tracking-[0.3em] text-center flex flex-col items-center gap-3 reveal">
                <span>Prestasi Santri</span>
                <div class="w-12 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
            </h2>
            
            <div class="flex items-start md:grid sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 overflow-x-auto hide-scroll pt-6 pb-6 px-2 snap-x snap-mandatory">
                @forelse($prestasi as $item)
                <div class="flex-none w-[75vw] sm:w-[250px] md:w-auto snap-start glass-card rounded-[1.5rem] sm:rounded-[2rem] overflow-hidden group reveal">
                    <div class="relative h-40 sm:h-48 overflow-hidden bg-slate-950">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[10px] text-slate-600">No Image</div>
                        @endif
                    </div>
                    <div class="p-5 sm:p-6 text-center bg-gradient-to-b from-slate-900/50 to-transparent border-t border-white/5 relative z-10 -mt-2 rounded-t-3xl backdrop-blur-xl">
                        <h3 class="text-xs font-bold text-white mb-2 uppercase tracking-wide leading-snug group-hover:text-sky-300 transition-colors">{{ $item->judul }}</h3>
                        <p class="text-[10px] text-sky-400 font-medium tracking-wider">{{ $item->keterangan ?? '' }}</p>
                    </div>
                </div>
                @empty
                <p class="col-span-full w-full text-center text-slate-500 text-xs uppercase tracking-widest">Belum ada data prestasi.</p>
                @endforelse
            </div>
        </section>

        <!-- Galeri -->
        <section id="galeri" class="py-12 md:py-24 bg-slate-900/30 border-y border-white/5">
            <div class="container mx-auto px-4 sm:px-6">
                <h2 class="text-xs sm:text-sm font-bold text-sky-400 mb-8 sm:mb-12 uppercase tracking-[0.2em] sm:tracking-[0.3em] text-center flex flex-col items-center gap-3 reveal">
                    <span>Galeri Asrama</span>
                    <div class="w-12 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
                </h2>
                
                <div class="flex items-start md:grid md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 overflow-x-auto hide-scroll pt-6 pb-6 px-2 snap-x snap-mandatory">
                    @forelse($galeri ?? [] as $g)
                    <div class="flex-none w-[75vw] sm:w-[250px] md:w-auto snap-start glass-card rounded-[1.5rem] md:rounded-[2rem] overflow-hidden group cursor-pointer relative h-48 md:h-64 reveal">
                        <img src="{{ asset('storage/' . $g->foto) }}" alt="{{ $g->judul ?? 'Galeri' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-70 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4 sm:p-6">
                            <p class="text-[10px] md:text-xs font-bold text-white tracking-widest uppercase translate-y-4 group-hover:translate-y-0 transition-transform">{{ $g->judul ?? 'Kegiatan Asrama' }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="col-span-full w-full text-center text-slate-500 text-xs uppercase tracking-widest py-8">Belum ada foto galeri.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <!-- Lokasi -->
    <section id="lokasi" class="py-12 md:py-24 container mx-auto px-4 sm:px-6">
        <div class="text-center mb-10 sm:mb-16 flex flex-col items-center reveal">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight uppercase text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 mb-3 sm:mb-4">
                Lokasi Asrama
            </h2>
            <div class="w-24 sm:w-32 h-1 bg-gradient-to-r from-transparent via-sky-500 to-transparent rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 items-stretch">
            <div class="glass-card p-6 sm:p-10 rounded-[1.5rem] sm:rounded-[2.5rem] flex flex-col justify-between reveal-left">
                <div>
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-sky-500/20 to-sky-900/40 border border-white/5 flex items-center justify-center text-sky-400 mb-6 sm:mb-8 shadow-lg stat-icon">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    
                    <h3 class="text-xs font-bold text-sky-400 mb-2 sm:mb-3 uppercase tracking-[0.15em]">Alamat Lengkap</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-light mb-6 sm:mb-8">
                        {{ $profil->alamat ?? 'Pondok Pesantren Nurul Jadid, Karanganyar, Paiton, Probolinggo, Jawa Timur 67291' }}
                    </p>
                    
                    <h3 class="text-xs font-bold text-sky-400 mb-2 sm:mb-3 uppercase tracking-[0.15em]">Layanan Sekretariat</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-light">
                        Sabtu - Kamis: 08.00 - 16.00 WIB
                    </p>
                </div>

                <div class="mt-8 sm:mt-10 pt-6 sm:pt-8 border-t border-white/5">
                    <a href="https://maps.app.goo.gl/WfC5izGpy15zSVq5A" target="_blank" class="inline-flex items-center justify-center w-full bg-sky-600 hover:bg-sky-500 text-white py-3.5 sm:py-4 rounded-2xl transition-all shadow-[0_0_20px_rgba(14,165,233,0.3)] hover:shadow-[0_0_30px_rgba(14,165,233,0.5)] text-[10px] sm:text-[11px] font-bold uppercase tracking-widest gap-3 btn-shine">
                        Buka Google Maps 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2 glass-card p-3 rounded-[1.5rem] sm:rounded-[2.5rem] overflow-hidden min-h-[300px] sm:min-h-[400px] reveal-right map-container">
                <iframe 
                    class="w-full h-full rounded-[1.2rem] sm:rounded-[2rem] transition-all duration-700"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d394.6915844048981!2d113.49480021030666!3d-7.711317901503016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd703f664c5ee59%3A0x93ca669cb90bfaea!2sWilayah%20D%20(Asrama%20MANJ)%20PP.%20Nurul%20Jadid!5e1!3m2!1sid!2sid!4v1787196255854!5m2!1sid!2sid" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 sm:py-12 text-center border-t border-white/5 relative bg-slate-950/50 px-4">
        <p class="text-[9px] sm:text-[10px] text-slate-500 uppercase tracking-[0.2em] sm:tracking-[0.3em] font-medium">
            &copy; {{ date('Y') }} <span class="text-sky-500/80">{{ $profil->nama_asrama ?? 'Asrama Diniyah' }}</span>. All Rights Reserved.
        </p>
    </footer>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/6287816297784?text=Assalamualaikum,%20saya%20ingin%20bertanya%20mengenai%20Asrama%20Diniyah." 
       target="_blank"
       class="fixed bottom-6 right-6 sm:bottom-8 sm:right-8 z-[100] bg-gradient-to-r from-emerald-500 to-green-500 text-white p-3.5 sm:p-4 rounded-full shadow-[0_10px_30px_rgba(34,197,94,0.4)] hover:shadow-[0_10px_40px_rgba(34,197,94,0.6)] transition-all duration-300 hover:-translate-y-2 wa-float flex items-center justify-center"
       aria-label="Hubungi via WhatsApp">
        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.031 2.008c-5.466 0-9.897 4.434-9.897 9.9 0 1.748.455 3.454 1.32 4.954L1.933 22l5.286-1.385a9.854 9.854 0 004.812 1.258h.004c5.462 0 9.895-4.434 9.895-9.9 0-2.648-1.03-5.137-2.902-7.009A9.851 9.851 0 0012.031 2.008zm0 16.634c-1.472 0-2.915-.395-4.177-1.144l-.3-.178-3.1.813.829-3.023-.195-.31c-.822-1.309-1.255-2.825-1.255-4.385 0-4.542 3.696-8.238 8.243-8.238 2.202 0 4.271.859 5.827 2.416A8.196 8.196 0 0120.274 11.9c0 4.543-3.697 8.239-8.243 8.239v-.001zm4.516-6.177c-.248-.124-1.467-.723-1.694-.806-.226-.082-.392-.124-.556.124-.165.248-.639.806-.783.97-.145.165-.289.186-.537.062-.248-.124-1.047-.386-1.996-1.23-.738-.656-1.236-1.467-1.38-1.715-.145-.248-.016-.381.108-.505.111-.111.248-.289.372-.433.124-.145.165-.248.248-.413.082-.165.041-.31-.021-.433-.062-.124-.556-1.341-.762-1.838-.202-.483-.406-.418-.556-.425-.144-.007-.31-.007-.475-.007-.165 0-.433.062-.66.31-.227.248-.867.846-.867 2.064s.887 2.395 1.011 2.56c.124.165 1.747 2.668 4.234 3.74.592.254 1.054.406 1.413.52.595.189 1.137.162 1.564.098.477-.07 1.467-.599 1.673-1.177.206-.578.206-1.074.145-1.177-.062-.103-.227-.165-.475-.289z"/>
        </svg>
    </a>

    <!-- MODAL POP-UP DETAIL FASILITAS (Diletakkan di Root/Body dengan z-[9999] agar bebas dari stacking context section) -->
    <div x-show="openModal" style="display: none;"
        class="fixed inset-0 z-[9999] overflow-y-auto bg-slate-950/90 backdrop-blur-xl flex items-center justify-center p-4 modal-backdrop"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        
        <div @click.away="openModal = false" 
            x-show="openModal"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-8 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-8 scale-95"
            class="bg-slate-900 border border-white/10 rounded-[2rem] max-w-2xl w-full max-h-[85vh] flex flex-col overflow-y-auto shadow-2xl relative modal-content my-auto hide-scroll">
            
            <button @click="openModal = false" class="absolute top-4 right-4 z-20 bg-black/50 hover:bg-rose-600 backdrop-blur-sm border border-white/10 text-white p-2.5 rounded-full transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <template x-if="activeFasilitas.foto">
                <div class="w-full h-64 sm:h-80 bg-slate-950 overflow-hidden relative flex-shrink-0">
                    <img :src="activeFasilitas.foto" :alt="activeFasilitas.nama" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
                </div>
            </template>

            <div class="p-6 sm:p-10 relative z-10 -mt-6 sm:-mt-12 flex-grow">
                <h3 class="text-xl sm:text-3xl font-black text-white mb-3 sm:mb-4 drop-shadow-lg" x-text="activeFasilitas.nama"></h3>
                <div class="w-16 h-1 bg-gradient-to-r from-sky-500 to-transparent rounded-full mb-4 sm:mb-6"></div>
                <p class="text-slate-300 text-xs sm:text-base leading-relaxed whitespace-pre-line font-light" x-text="activeFasilitas.keterangan"></p>
                
                <div class="mt-8 sm:mt-10 pt-4 sm:pt-6 border-t border-white/5 text-right">
                    <button @click="openModal = false" class="bg-white/5 hover:bg-white/10 text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-xl text-[10px] sm:text-xs uppercase tracking-widest font-bold border border-white/10 transition-colors btn-shine">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Animasi Statistik -->
    <script>
    function statAnimation() {
        const targetSantri = {{ $profil->jumlah_santri ?? 40 }};
        const targetKamar = {{ $profil->jumlah_kamar ?? 6 }};
        const targetPengurus = {{ $profil->jumlah_pengurus ?? 10 }};
        const targetKelas = {{ $profil->jumlah_kelas ?? 5 }};

        return {
            currentSantri: 0,
            currentKamar: 0,
            currentPengurus: 0,
            currentKelas: 0,
            
            init() {
                this.startLoopingAnimation();
            },

            startLoopingAnimation() {
                setInterval(() => {
                    this.animateValue('currentSantri', 0, targetSantri, 2500);
                    this.animateValue('currentKamar', 0, targetKamar, 2500);
                    this.animateValue('currentPengurus', 0, targetPengurus, 2500);
                    this.animateValue('currentKelas', 0, targetKelas, 2500);
                }, 8000); 

                this.animateValue('currentSantri', 0, targetSantri, 2500);
                this.animateValue('currentKamar', 0, targetKamar, 2500);
                this.animateValue('currentPengurus', 0, targetPengurus, 2500);
                this.animateValue('currentKelas', 0, targetKelas, 2500);
            },

            animateValue(property, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const easeProgress = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                    this[property] = Math.floor(easeProgress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('scroll', () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            document.getElementById('scroll-progress').style.width = scrollPercent + '%';
            
            const navbar = document.getElementById('navbar');
            if (scrollTop > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -80px 0px'
        });
        
        revealElements.forEach(el => observer.observe(el));

        document.querySelectorAll('.tilt-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 15;
                const rotateY = (centerX - x) / 15;
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.03)`;
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale(1)';
            });
        });

        const hero = document.querySelector('header');
        if (hero) {
            hero.querySelectorAll('.particle').forEach(p => p.remove());
            for (let i = 0; i < 25; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 12 + 6) + 's';
                particle.style.animationDelay = Math.random() * 5 + 's';
                particle.style.width = particle.style.height = Math.random() * 5 + 2 + 'px';
                particle.style.opacity = Math.random() * 0.5 + 0.2;
                hero.appendChild(particle);
            }
        }
    });
    </script>
</body>
</html>