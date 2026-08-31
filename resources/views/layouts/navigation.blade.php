<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-slate-950/90 backdrop-blur-xl border-b border-slate-800/70 shadow-xl shadow-black/40 w-full transition-all duration-300">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-18">
            
            <!-- Kiri: Brand Logo & Navigasi Utama -->
            <div class="flex items-center gap-4 lg:gap-7">
                <!-- Logo Aplikasi -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 shrink-0 group">
                    <div class="w-9 sm:w-10 h-9 sm:h-10 rounded-xl bg-slate-900/90 border border-slate-800/80 p-1.5 flex items-center justify-center shadow-md shadow-sky-500/10 group-hover:shadow-sky-500/30 group-hover:border-sky-500/40 transition-all duration-300 group-hover:scale-105 overflow-hidden">
                        <img src="{{ asset('storage/logo/logo_asrama.jpg-removebg-preview.png') }}" 
                            alt="Logo Asrama" 
                            class="w-full h-full object-contain filter drop-shadow">
                    </div>
                    <span class="text-lg sm:text-xl font-black tracking-tight text-white group-hover:text-slate-100 transition-colors">
                        Admin<span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-indigo-400">DNY</span>
                    </span>
                </a>

                <!-- Menu Desktop (Ukuran Font Lebih Jelas & Presisi) -->
                <div class="hidden lg:flex items-center gap-1">
                    @php 
                        $role = auth()->user()->role;
                        $links = [
                            ['route' => 'dashboard', 'label' => 'Dashboard', 'show' => true],
                            ['route' => 'berita.index', 'label' => 'Berita', 'show' => true],
                            ['route' => 'prestasi.index', 'label' => 'Prestasi', 'show' => true],
                            ['route' => 'admin.galeri.index', 'label' => 'Galeri', 'show' => true],
                            ['route' => 'admin.fasilitas.index', 'label' => 'Fasilitas', 'show' => $role === 'super_admin'],
                            ['route' => 'admin.pengurus.index', 'label' => 'Pengurus', 'show' => $role === 'super_admin'],
                            ['route' => 'admin.profil.edit', 'label' => 'Profil Asrama', 'show' => $role === 'super_admin'],
                            ['route' => 'admin.users.index', 'label' => 'Kelola Akun', 'show' => $role === 'super_admin']
                        ];

                        $userName = auth()->user()->name;
                        $pengurus = \App\Models\Pengurus::where('nama_lengkap', $userName)->first();
                        
                        $avatarUrl = ($pengurus && $pengurus->foto) 
                            ? asset('storage/' . $pengurus->foto) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0f172a&color=38bdf8&bold=true';
                    @endphp

                    @foreach($links as $link)
                        @if($link['show'])
                        @php $isActive = request()->routeIs($link['route'] . '*'); @endphp
                        <a href="{{ route($link['route']) }}" 
                           class="px-3 py-2 rounded-xl text-[13.5px] font-semibold whitespace-nowrap transition-all duration-200 flex items-center gap-2 {{ $isActive ? 'bg-sky-500/15 text-sky-400 border border-sky-500/30 shadow-[0_0_15px_rgba(56,189,248,0.2)] font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800/60 border border-transparent' }}">
                            @if($isActive)
                                <span class="w-1.5 h-1.5 rounded-full bg-sky-400 shadow-[0_0_8px_#38bdf8]"></span>
                            @endif
                            {{ __($link['label']) }}
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Kanan: Tombol Website & Profile Card -->
            <div class="flex items-center gap-3 shrink-0">
                <!-- Tombol Website (Ditingkatkan & Buka di Tab Sama) -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-emerald-400 hover:text-emerald-300 font-semibold text-xs sm:text-[13px] bg-emerald-500/10 hover:bg-emerald-500/20 px-3.5 py-2 rounded-xl border border-emerald-500/30 hover:border-emerald-500/50 shadow-[0_0_12px_rgba(16,185,129,0.12)] hover:shadow-[0_0_18px_rgba(16,185,129,0.25)] transition-all duration-200 shrink-0 group active:scale-95">
                    <svg class="w-4 h-4 text-emerald-400 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span class="hidden sm:inline">Website</span>
                </a>

                <!-- Profil Card Desktop -->
                <div class="hidden sm:flex items-center">
                    <x-dropdown align="right" width="52">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2.5 p-1 pl-1.5 pr-3 rounded-xl bg-slate-900/90 border border-slate-800 hover:border-sky-500/40 hover:bg-slate-800/80 transition-all duration-200 group shadow-sm">
                                <div class="relative shrink-0">
                                    <img src="{{ $avatarUrl }}" alt="{{ Auth::user()->name }}" class="w-7 sm:w-8 h-7 sm:h-8 rounded-lg object-cover ring-1 ring-slate-700 group-hover:ring-sky-400/60 transition-all">
                                    <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-slate-950 rounded-full"></span>
                                </div>
                                <span class="text-[13px] font-semibold text-slate-200 group-hover:text-white truncate max-w-[110px] transition-colors">
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </span>
                                <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-sky-400 transition-all duration-200 group-hover:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-slate-900/95 backdrop-blur-2xl border border-slate-800/90 rounded-2xl overflow-hidden shadow-2xl p-1.5 space-y-1">
                                <div class="px-3.5 py-2.5 bg-slate-950/70 rounded-xl border border-slate-800/80 mb-1">
                                    <p class="text-[13px] font-bold text-white truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-[10.5px] text-sky-400 font-bold truncate uppercase tracking-wider mt-0.5">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                                </div>

                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3.5 py-2 text-[13px] font-medium text-slate-300 hover:text-white hover:bg-slate-800/80 rounded-xl transition-colors group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-sky-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil Saya
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 text-[13px] font-medium text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 rounded-xl transition-colors group">
                                        <svg class="w-4 h-4 text-rose-400/80 group-hover:text-rose-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Tombol Mobile Hamburger -->
                <button @click="open = ! open" class="lg:hidden p-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/80 border border-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Dropdown Navigasi Mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-slate-950/95 backdrop-blur-2xl border-b border-slate-800/90 shadow-2xl">
        <div class="p-3.5 space-y-1.5">
            @foreach($links as $link)
                @if($link['show'])
                @php $isActive = request()->routeIs($link['route'] . '*'); @endphp
                <a href="{{ route($link['route']) }}" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-[13.5px] font-semibold transition-all {{ $isActive ? 'bg-sky-500/15 text-sky-400 border border-sky-500/30' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                    @if($isActive)
                        <span class="w-2 h-2 rounded-full bg-sky-400 shadow-[0_0_6px_#38bdf8]"></span>
                    @endif
                    {{ __($link['label']) }}
                </a>
                @endif
            @endforeach

            <!-- Link Website Tambahan di Menu Mobile -->
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-[13.5px] font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                Lihat Website Utama
            </a>

            <div class="pt-3.5 mt-2 border-t border-slate-800/80 flex justify-between items-center px-2">
                <span class="text-[13px] font-semibold text-slate-300">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[13px] font-semibold text-rose-400 hover:text-rose-300">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>