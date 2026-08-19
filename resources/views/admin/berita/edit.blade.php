<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-slate-900 p-8 rounded-[2rem] border border-slate-800 shadow-2xl">
                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Judul Berita</label>
                        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" 
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-3 px-4 focus:ring-sky-500 focus:border-sky-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Isi Konten</label>
                        <textarea name="konten" rows="8" 
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-3 px-4 focus:ring-sky-500 focus:border-sky-500" required>{{ old('konten', $berita->konten) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Foto (Biarkan kosong jika tidak ganti)</label>
                        <!-- Tambahkan accept="..." agar saat memilih file, format dibatasi otomatis -->
                        <input type="file" name="foto" accept="image/png, image/jpeg, image/jpg" class="w-full text-slate-400 file:bg-sky-900 file:text-sky-300 file:rounded-full file:border-0 file:px-4 file:py-2">
                        
                        <!-- Tampilkan pesan error jika foto kebesaran/salah format -->
                        @error('foto')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                        @if($berita->foto)
                            <div class="mt-4">
                                <p class="text-xs text-slate-500 mb-2">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $berita->foto) }}" class="w-40 rounded-lg shadow-lg">
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-800">
                        <a href="{{ route('berita.index') }}" class="px-6 py-3 rounded-2xl text-slate-400 hover:text-white transition">Batal</a>
                        <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white px-8 py-3 rounded-2xl font-bold shadow-lg shadow-sky-900/20 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>