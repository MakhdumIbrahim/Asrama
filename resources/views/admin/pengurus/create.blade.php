<x-app-layout>
    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-slate-900 p-10 rounded-[2rem] border border-slate-800 shadow-2xl">
                <h2 class="text-2xl font-bold text-white mb-8">
                    {{ isset($pengurus) ? 'Edit Data Pengurus' : 'Tambah Data Pengurus' }}
                </h2>
                
                <form action="{{ isset($pengurus) ? route('admin.pengurus.update', $pengurus->id) : route('admin.pengurus.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-6">
                    @csrf
                    @if(isset($pengurus)) @method('PUT') @endif

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pengurus->nama_lengkap ?? '') }}" 
                               class="w-full rounded-2xl bg-slate-950 border-slate-800 text-white focus:border-sky-500 focus:ring-sky-500 transition py-3 px-4" 
                               required>
                    </div>

                    {{-- Jabatan --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Jabatan</label>
                        <input type="text" name="jabatan" value="{{ old('jabatan', $pengurus->jabatan ?? '') }}" 
                               class="w-full rounded-2xl bg-slate-950 border-slate-800 text-white focus:border-sky-500 focus:ring-sky-500 transition py-3 px-4" 
                               required>
                    </div>

                    {{-- Kontak WA --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Kontak WhatsApp</label>
                        <input type="text" name="kontak" value="{{ old('kontak', $pengurus->kontak ?? '') }}" 
                               class="w-full rounded-2xl bg-slate-950 border-slate-800 text-white focus:border-sky-500 focus:ring-sky-500 transition py-3 px-4" 
                               placeholder="0812xxxxxxxx" required>
                    </div>

                    {{-- Foto Profil --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-2">Foto Profil</label>
                        @if(isset($pengurus) && $pengurus->foto)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $pengurus->foto) }}" class="w-20 h-20 rounded-full object-cover border-2 border-slate-700 shadow-lg">
                            </div>
                        @endif
                        <input type="file" name="foto" 
                               class="w-full rounded-2xl bg-slate-950 border-slate-800 text-slate-400 focus:border-sky-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-900 file:text-sky-300 hover:file:bg-sky-800 transition">
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('admin.pengurus.index') }}" class="flex-1 text-center py-4 rounded-2xl font-bold text-slate-400 hover:text-white transition">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 bg-sky-600 text-white py-4 rounded-2xl font-bold hover:bg-sky-500 transition shadow-lg shadow-sky-900/20">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>