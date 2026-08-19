<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Prestasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    Form Edit Prestasi
                </h2>
                
                <!-- Perhatikan route mengarah ke prestasi.update dengan menyertakan ID -->
                <form action="{{ route('prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Method PUT wajib ditambahkan untuk proses update data di Laravel -->
                    @method('PUT') 

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Prestasi</label>
                        <!-- Menggunakan value="{{ old('judul', $prestasi->judul) }}" untuk memanggil data lama -->
                        <input type="text" name="judul" value="{{ old('judul', $prestasi->judul) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Contoh: Juara 1 Tahfidz Nasional" required>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                        <!-- Menyelipkan isi textarea di antara tag pembuka dan penutup -->
                        <textarea name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-sky-500 focus:border-sky-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Berikan detail singkat mengenai prestasi tersebut..." required>{{ old('keterangan', $prestasi->keterangan) }}</textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Prestasi</label>
                        
                        <!-- Menampilkan preview foto lama jika ada -->
                        @if($prestasi->foto)
                            <div class="mb-3">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Foto saat ini:</p>
                                <img src="{{ asset('storage/' . $prestasi->foto) }}" alt="Foto Prestasi" class="h-32 w-auto object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            </div>
                        @endif

                        <!-- Atribut 'required' dihilangkan agar user bisa menyimpan tanpa harus upload ulang foto -->
                        <input type="file" name="foto" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG (Max 2MB). Biarkan kosong jika tidak ingin mengubah foto.</p>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('prestasi.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700">
                            Batal
                        </a>
                        <button type="submit" class="text-white bg-sky-600 hover:bg-sky-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>