<x-app-layout>
    <div class="py-12 bg-slate-950 min-h-screen text-slate-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Alert Notifikasi -->
            @if(session('success'))
                <div class="p-4 bg-sky-950/50 border border-sky-500/30 text-sky-400 rounded-2xl text-xs font-semibold tracking-wide uppercase">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Form Upload Foto -->
                <div class="lg:col-span-1">
                    <div class="bg-slate-900/60 backdrop-blur-xl p-8 rounded-[2rem] border border-slate-800 shadow-2xl">
                        <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <span>📸</span> Tambah Galeri
                        </h2>

                        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">Judul / Keterangan (Opsional)</label>
                                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Kegiatan Pengajian Mingguan" 
                                       class="w-full bg-slate-950/50 border border-slate-800 rounded-xl px-4 py-3 text-xs text-white placeholder-slate-600 focus:outline-none focus:border-sky-500 transition">
                                @error('judul') <span class="text-red-400 text-[10px] mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">File Foto</label>
                                <input type="file" name="foto" accept="image/*" required
                                       class="w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:uppercase file:tracking-widest file:bg-sky-600/20 file:text-sky-400 hover:file:bg-sky-600 hover:file:text-white transition cursor-pointer">
                                @error('foto') <span class="text-red-400 text-[10px] mt-1">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="w-full bg-sky-600 hover:bg-sky-500 text-white font-bold py-3 rounded-xl text-[10px] uppercase tracking-widest transition shadow-lg shadow-sky-950/50">
                                Unggah Foto
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Daftar Foto Galeri -->
                <div class="lg:col-span-2">
                    <div class="bg-slate-900/60 backdrop-blur-xl p-8 rounded-[2rem] border border-slate-800 shadow-2xl">
                        <h2 class="text-xs font-bold text-white uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <span>🖼️</span> Daftar Foto Galeri
                        </h2>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            @forelse($galeri as $g)
                                <div class="group relative rounded-2xl overflow-hidden border border-slate-800 bg-slate-950 aspect-square">
                                    <img src="{{ asset('storage/' . $g->foto) }}" alt="{{ $g->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100">
                                    
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 p-4 flex flex-col justify-between">
                                        <div class="text-right">
                                            <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500/80 hover:bg-red-600 text-white p-2 rounded-xl text-[10px] transition backdrop-blur-sm">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-white truncate uppercase tracking-wider">{{ $g->judul ?? 'Tanpa Judul' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-full py-12 text-center text-slate-600 text-xs uppercase tracking-widest">
                                    Belum ada foto yang diunggah.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>