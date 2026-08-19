<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white tracking-tight">
                {{ __('Daftar Prestasi') }}
            </h2>
            <a href="{{ route('prestasi.create') }}" class="bg-sky-600 hover:bg-sky-500 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-sky-900/20 text-sm font-semibold transition-all duration-300 hover:scale-105 flex items-center gap-2 border border-sky-500/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                Tambah Prestasi
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <div class="bg-slate-900 overflow-hidden shadow-2xl rounded-3xl border border-slate-800">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-300">
                        <thead class="text-xs text-white uppercase bg-slate-950/50 border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-5">Foto</th>
                                <th class="px-6 py-5">Judul Prestasi</th>
                                <th class="px-6 py-5 text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($prestasi as $item)
                            <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    @if($item->foto)
                                        {{-- Menggunakan gaya shadow dan border yang persis sama dengan gambar berita --}}
                                        <img src="{{ asset('storage/'.$item->foto) }}" class="w-20 h-12 object-cover rounded-lg shadow-lg border border-slate-700">
                                    @else
                                        <div class="w-20 h-12 bg-slate-800 rounded-lg flex items-center justify-center text-[10px] text-slate-500 border border-slate-700">No Image</div>
                                    @endif
                                </td>
                                {{-- Menghapus class text-lg agar ukuran font persis dengan Berita --}}
                                <td class="px-6 py-4 font-semibold text-white">{{ $item->judul }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Tombol Edit (Warna Sky) -->
                                        <a href="{{ route('prestasi.edit', $item->id) }}" class="text-sky-400 hover:text-white bg-sky-950/30 hover:bg-sky-900 px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 border border-sky-900/50">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus dengan SweetAlert -->
                                        <form action="{{ route('prestasi.destroy', $item->id) }}" method="POST" onsubmit="confirmDelete(event, this)">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:text-white bg-rose-950/30 hover:bg-rose-900 px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 border border-rose-900/50">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-500 italic">Belum ada data prestasi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Area Paginasi --}}
                @if($prestasi->hasPages())
                <div class="p-6 border-t border-slate-800 bg-slate-900/50">
                    {{ $prestasi->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>