<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white tracking-tight">
                {{ __('Tambah Fasilitas Baru') }}
            </h2>
            <a href="{{ route('admin.fasilitas.index') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2 text-sm font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            
            <div class="bg-slate-900 shadow-2xl rounded-3xl border border-slate-800 p-8">
                <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="nama_fasilitas" class="block mb-2 text-sm font-medium text-slate-300">Nama Fasilitas <span class="text-rose-500">*</span></label>
                        <input type="text" id="nama_fasilitas" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" class="bg-slate-950 border border-slate-800 text-white text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-3 transition-colors duration-200" placeholder="Contoh: Lapangan Futsal" required>
                        @error('nama_fasilitas')
                            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="keterangan" class="block mb-2 text-sm font-medium text-slate-300">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="4" class="bg-slate-950 border border-slate-800 text-white text-sm rounded-xl focus:ring-sky-500 focus:border-sky-500 block w-full p-3 transition-colors duration-200" placeholder="Deskripsikan fasilitas ini...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="foto" class="block mb-2 text-sm font-medium text-slate-300">Foto Fasilitas</label>
                        <input class="block w-full text-sm text-slate-400 border border-slate-800 rounded-xl cursor-pointer bg-slate-950 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700 transition-colors" id="foto" name="foto" type="file" accept="image/*">
                        <p class="mt-2 text-xs text-slate-500">PNG, JPG, atau JPEG (Maks. 2MB).</p>
                        @error('foto')
                            <p class="mt-2 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-800 pt-6">
                        <a href="{{ route('admin.fasilitas.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-300 bg-slate-800 hover:bg-slate-700 transition-colors duration-200 border border-slate-700">
                            Batal
                        </a>
                        <button type="submit" class="bg-sky-600 hover:bg-sky-500 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-sky-900/20 text-sm font-semibold transition-all duration-300 hover:scale-105 border border-sky-500/50">
                            Simpan Fasilitas
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>