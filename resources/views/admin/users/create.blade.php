<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 shadow-xl rounded-2xl overflow-hidden p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Tambah Akun Baru</h2>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Alamat Email</label>
                        <input type="email" name="email" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                        @error('email') <span class="text-rose-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Pilih Role Akses</label>
                        <select name="role" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                            <option value="sekretaris">Sekretaris (Terbatas)</option>
                            <option value="super_admin">Super Admin (Akses Penuh)</option>
                        </select>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Password</label>
                        <input type="password" name="password" required minlength="8" class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                        <p class="text-slate-500 text-xs mt-1">Minimal 8 karakter.</p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-700 text-slate-300 hover:bg-slate-800 transition-colors">Batal</a>
                        <button type="submit" class="bg-sky-500 hover:bg-sky-400 text-white font-semibold py-2.5 px-6 rounded-lg transition-colors">Simpan Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>