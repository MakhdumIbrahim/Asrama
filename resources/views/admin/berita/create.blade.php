<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-tight">
            {{ __('Tulis Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            {{-- Container Utama: Menggunakan Dark Glassmorphism --}}
            <div class="bg-slate-900 p-8 md:p-10 rounded-[2rem] border border-slate-800 shadow-2xl">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    @if ($errors->any())
    <div class="bg-red-600 text-white p-4 rounded-xl mb-6">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-3">Judul Berita / Kegiatan</label>
                        <input type="text" name="judul" 
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all duration-300 py-4 px-5" 
                            placeholder="Contoh: Kegiatan Sosialisasi Santri Baru" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-3">Isi Konten Berita</label>
                        <textarea name="konten" rows="8" 
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 transition-all duration-300 py-4 px-5" 
                            placeholder="Tuliskan detail berita di sini..." required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-3">Foto Sampul Kegiatan</label>
                        <input type="file" name="foto" 
                            class="w-full text-sm text-slate-400 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-950 file:text-sky-400 hover:file:bg-sky-900 transition-all cursor-pointer bg-slate-950 border border-slate-800 rounded-2xl">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG (Max 10MB)</p>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-800 pt-8">
                        <a href="{{ route('berita.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
                            Batal
                        </a>
                        <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-500 text-white font-bold px-8 py-4 rounded-2xl shadow-lg shadow-sky-900/20 transition-all duration-300 hover:scale-105 active:scale-95 text-sm">
                            Terbitkan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>