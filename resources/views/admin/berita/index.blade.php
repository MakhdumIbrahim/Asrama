<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white tracking-tight">
                {{ __('Manajemen Berita & Kegiatan') }}
            </h2>
            <a href="{{ route('berita.create') }}" class="bg-sky-600 hover:bg-sky-500 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-sky-900/20 text-sm font-semibold transition-all duration-300 hover:scale-105 flex items-center gap-2 border border-sky-500/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                Tambah Berita
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
                                <th class="px-6 py-5">Sampul</th>
                                <th class="px-6 py-5">Judul Berita</th>
                                <th class="px-6 py-5">Penulis</th>
                                <th class="px-6 py-5">Tanggal Post</th>
                                <th class="px-6 py-5 text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @forelse($berita as $b)
                            <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    @if($b->foto)
                                        <img src="{{ asset('storage/' . $b->foto) }}" class="w-20 h-12 object-cover rounded-lg shadow-lg border border-slate-700">
                                    @else
                                        <div class="w-20 h-12 bg-slate-800 rounded-lg flex items-center justify-center text-[10px] text-slate-500 border border-slate-700">No Image</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-white">{{ $b->judul }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-[11px] bg-slate-800 text-slate-300 px-3 py-1 rounded-full border border-slate-700">{{ $b->user->name ?? 'Admin' }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-400 font-mono">{{ $b->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('berita.edit', $b->id) }}" class="text-sky-400 hover:text-white bg-sky-950/30 hover:bg-sky-900 px-4 py-2 rounded-lg text-xs font-bold transition-all duration-200 border border-sky-900/50">
                                            Edit
                                        </a>
                                        {{-- Tombol Hapus dengan SweetAlert --}}
                                        <form action="{{ route('berita.destroy', $b->id) }}" method="POST" onsubmit="confirmDelete(event, this)">
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
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">Belum ada berita yang diterbitkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Area Paginasi --}}
                @if($berita->hasPages())
                <div class="p-6 border-t border-slate-800 bg-slate-900/50">
                    {{ $berita->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>