<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-white tracking-tight">
            {{ __('Edit Data Pengurus') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            {{-- Card Utama dengan Glassmorphism --}}
            <div class="bg-slate-900 p-10 rounded-[2.5rem] border border-slate-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] transition-all duration-500 hover:shadow-sky-900/10">
                
                <form action="{{ route('admin.pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Nama Lengkap --}}
                    <div class="group">
                        <label class="block text-sm font-semibold text-slate-400 mb-3 group-focus-within:text-sky-400 transition-colors">Nama Lengkap beserta Gelar</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pengurus->nama_lengkap) }}" required 
                            class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-4 px-5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all duration-300 placeholder-slate-600">
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Jabatan --}}
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-400 mb-3 group-focus-within:text-sky-400 transition-colors">Jabatan di Asrama</label>
                            <input type="text" name="jabatan" value="{{ old('jabatan', $pengurus->jabatan) }}" required 
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-4 px-5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all duration-300">
                        </div>

                        {{-- Nomor WhatsApp --}}
                        <div class="group">
                            <label class="block text-sm font-semibold text-slate-400 mb-3 group-focus-within:text-sky-400 transition-colors">Nomor WhatsApp</label>
                            <input type="text" name="kontak" value="{{ old('kontak', $pengurus->kontak) }}" required 
                                class="w-full bg-slate-950 border border-slate-800 rounded-2xl text-white py-4 px-5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all duration-300">
                        </div>
                    </div>

                    {{-- Foto Profil --}}
                    <div class="bg-slate-950 p-6 rounded-3xl border border-slate-800 transition-all hover:border-slate-700">
                        <label class="block text-sm font-semibold text-slate-400 mb-4">Foto Profil Saat Ini</label>
                        <div class="flex items-center gap-6">
                            @if($pengurus->foto)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $pengurus->foto) }}" 
                                        class="w-24 h-24 rounded-full object-cover border-4 border-slate-800 group-hover:border-sky-500/50 transition-all duration-500">
                                    <div class="absolute inset-0 rounded-full bg-sky-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            @endif
                            <div class="flex-1">
                                <input type="file" name="foto" accept="image/*" 
                                    class="block w-full text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-sky-950 file:text-sky-400 hover:file:bg-sky-900 transition-all cursor-pointer">
                                <p class="text-[10px] text-slate-600 mt-3 uppercase tracking-widest font-bold italic">Kosongkan jika tidak ingin mengubah foto</p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end items-center gap-4 pt-6 border-t border-slate-800">
                        <a href="{{ route('admin.pengurus.index') }}" 
                            class="text-slate-400 hover:text-white font-bold text-sm transition-colors px-6 py-2">
                            Batal
                        </a>
                        <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-500 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-sky-900/20 transition-all duration-300 hover:scale-105 active:scale-95 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>