<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            <div class="bg-slate-900 border border-slate-800 shadow-xl rounded-2xl overflow-hidden p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Edit Akun</h2>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                        @error('email') <span class="text-rose-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Pilih Role Akses</label>
                        <select name="role" required class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                            <option value="sekretaris" {{ $user->role == 'sekretaris' ? 'selected' : '' }}>Sekretaris (Terbatas)</option>
                            <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin (Akses Penuh)</option>
                        </select>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Password Baru <span class="text-slate-500 font-normal">(Opsional)</span></label>
                        <input type="password" name="password" minlength="8" class="w-full bg-slate-950 border border-slate-800 text-white rounded-lg focus:ring-sky-500 focus:border-sky-500">
                        <p class="text-slate-500 text-xs mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-lg border border-slate-700 text-slate-300 hover:bg-slate-800 transition-colors">Batal</a>
                        <button type="submit" class="bg-sky-500 hover:bg-sky-400 text-white font-semibold py-2.5 px-6 rounded-lg transition-colors">Update Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>