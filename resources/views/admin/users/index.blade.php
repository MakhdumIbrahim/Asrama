<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-white">Kelola Akun</h2>
                    <p class="text-slate-400 text-sm mt-1">Manajemen akses Super Admin dan Sekretaris.</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="bg-sky-500 hover:bg-sky-400 text-white font-semibold py-2 px-4 rounded-lg shadow-lg shadow-sky-500/30 transition-all duration-300">
                    + Tambah Akun
                </a>
            </div>

            <!-- Pesan Notifikasi -->
            @if(session('success'))
                <div class="mb-4 bg-emerald-500/10 border border-emerald-500/50 text-emerald-400 px-4 py-3 rounded-lg relative">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-rose-500/10 border border-rose-500/50 text-rose-400 px-4 py-3 rounded-lg relative">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabel Data -->
            <div class="bg-slate-900 border border-slate-800 shadow-xl rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-800/50 text-slate-400 font-medium border-b border-slate-800">
                            <tr>
                                <th class="px-6 py-4">Nama Lengkap</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role Akses</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @foreach($users as $user)
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 font-semibold text-white">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if($user->role === 'super_admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                            Super Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-500/10 text-sky-400 border border-sky-500/20">
                                            Sekretaris
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-3">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-slate-400 hover:text-sky-400 transition-colors">Edit</a>
                                    
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-rose-400 transition-colors">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>