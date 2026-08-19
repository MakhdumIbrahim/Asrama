<x-app-layout>
    {{-- Menggunakan slot header dengan styling yang lebih bersih --}}
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-100 tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Main Hero Card dengan Gradients yang lebih soft --}}
            <div class="relative bg-gradient-to-br from-slate-900 to-sky-950 rounded-[2.5rem] p-8 md:p-12 border border-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] overflow-hidden">
                
                {{-- Decorative Glows --}}
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-sky-500/10 rounded-full blur-[120px]"></div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sky-900/30 border border-sky-800/50 text-sky-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-sky-400 animate-pulse"></span>
                        Administrator Access
                    </div>
                    
                    <h3 class="text-4xl md:text-5xl font-extrabold text-white mb-4 leading-tight">
                        Ahlan wa Sahlan, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-400">
                            {{ Auth::user()->name }}! 👋
                        </span>
                    </h3>
                    
                    <p class="text-slate-400 text-lg max-w-xl leading-relaxed font-light">
                        Pusat Kendali Asrama Diniyah. Pantau dan kelola data operasional website Anda dengan presisi tinggi.
                    </p>
                </div>
            </div>

            {{-- Stats Grid dengan spacing yang lebih presisi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                @php 
                    $stats = [
                        ['label' => 'Total Pengurus', 'value' => $pengurus->count() ?? 0, 'color' => 'text-white'],
                        ['label' => 'Total Berita', 'value' => $berita->count() ?? 0, 'color' => 'text-white'],
                        ['label' => 'Status Website', 'value' => 'Online', 'color' => 'text-emerald-400']
                    ];
                @endphp

                @foreach($stats as $stat)
                <div class="bg-slate-900/50 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-800 transition-all duration-300 hover:border-sky-800/50 hover:bg-slate-900 group">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-3">{{ $stat['label'] }}</p>
                    <p class="text-5xl font-black {{ $stat['color'] }} group-hover:scale-105 transition-transform origin-left duration-300">
                        {{ $stat['value'] }}
                    </p>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>