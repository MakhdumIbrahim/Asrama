<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-tight">
            {{ __('Pengaturan Profil Asrama') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-sky-950/50 border border-sky-500/30 text-sky-400 rounded-2xl shadow-lg flex items-center gap-3 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.207a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">Berhasil! {{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-slate-900 p-10 rounded-[2.5rem] border border-slate-800 shadow-2xl transition-all duration-500">
                <p class="text-slate-400 text-sm mb-8 leading-relaxed">
                    Silakan ubah informasi di bawah ini untuk memperbarui konten Sejarah, Visi, dan Misi pada halaman depan website utama secara real-time.
                </p>

                <form action="{{ route('admin.profil.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Input Nama --}}
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-400 mb-3 group-focus-within:text-sky-400 transition-colors">Nama Lembaga / Asrama</label>
                        <input type="text" name="nama_asrama" 
                               value="{{ old('nama_asrama', $profil->nama_asrama ?? '') }}" 
                               class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-4 px-5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all duration-300" required>
                        @error('nama_asrama') <span class="text-rose-400 text-xs mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Input Sejarah --}}
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-400 mb-3 group-focus-within:text-sky-400 transition-colors">Sejarah Singkat</label>
                        <textarea name="sejarah_singkat" rows="6" 
                                  class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-4 px-5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all duration-300" required>{{ old('sejarah_singkat', $profil->sejarah_singkat ?? '') }}</textarea>
                        @error('sejarah_singkat') <span class="text-rose-400 text-xs mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Input Visi --}}
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-400 mb-3 group-focus-within:text-sky-400 transition-colors">Visi Asrama</label>
                        <textarea name="visi" rows="3" 
                                  class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-4 px-5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all duration-300">{{ old('visi', $profil->visi ?? '') }}</textarea>
                        @error('visi') <span class="text-rose-400 text-xs mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Input Misi --}}
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-400 mb-3 group-focus-within:text-sky-400 transition-colors">Misi Asrama</label>
                        <textarea name="misi" rows="4" 
                                  class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-4 px-5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all duration-300" placeholder="Gunakan baris baru untuk memisahkan setiap poin misi">{{ old('misi', $profil->misi ?? '') }}</textarea>
                        @error('misi') <span class="text-rose-400 text-xs mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Input Statistik Asrama -->
                    <div class="mt-6 border-t border-slate-700 pt-6">
                        <h3 class="text-lg font-bold text-white mb-4">Statistik Asrama (Untuk Halaman Depan)</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Jumlah Santri -->
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Jumlah Santri</label>
                                <input type="number" name="jumlah_santri" value="{{ old('jumlah_santri', $profil->jumlah_santri ?? 0) }}" 
                                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-sky-500">
                            </div>

                            <!-- Jumlah Kamar -->
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Jumlah Kamar</label>
                                <input type="number" name="jumlah_kamar" value="{{ old('jumlah_kamar', $profil->jumlah_kamar ?? 0) }}" 
                                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-sky-500">
                            </div>

                            <!-- Jumlah Pengurus -->
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Jumlah Pengurus</label>
                                <input type="number" name="jumlah_pengurus" value="{{ old('jumlah_pengurus', $profil->jumlah_pengurus ?? 0) }}" 
                                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-sky-500">
                            </div>

                            <!-- Jumlah Kelas Belajar -->
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Jumlah Kelas Belajar</label>
                                <input type="number" name="jumlah_kelas" value="{{ old('jumlah_kelas', $profil->jumlah_kelas ?? 0) }}" 
                                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-sky-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-800">
                        <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white font-bold px-10 py-4 rounded-2xl shadow-lg shadow-sky-900/20 transition-all duration-300 hover:scale-105 active:scale-95 text-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>