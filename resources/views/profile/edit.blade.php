<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white tracking-tight flex items-center gap-3">
                <span class="p-2 bg-indigo-500/10 border border-indigo-500/20 rounded-xl text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round5" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span>
                {{ __('Account Settings') }}
            </h2>
            <span class="text-xs font-medium px-3 py-1 bg-slate-900 border border-slate-800 text-slate-400 rounded-full shadow-inner">
                Secure Dashboard
            </span>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Card Profil & Foto Profil --}}
            <div class="relative overflow-hidden p-8 sm:p-10 bg-slate-900/80 backdrop-blur-xl border border-slate-800/80 shadow-2xl rounded-[2.5rem] transition-all duration-500 hover:border-indigo-500/30 group">
                <div class="absolute -right-20 -top-20 w-60 h-60 bg-indigo-500/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition-all duration-700"></div>
                <div class="relative z-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Card Password --}}
            <div class="relative overflow-hidden p-8 sm:p-10 bg-slate-900/80 backdrop-blur-xl border border-slate-800/80 shadow-2xl rounded-[2.5rem] transition-all duration-500 hover:border-indigo-500/30 group">
                <div class="absolute -right-20 -top-20 w-60 h-60 bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-all duration-700"></div>
                <div class="relative z-10">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Card Hapus Akun --}}
            <div class="relative overflow-hidden p-8 sm:p-10 bg-slate-900/80 backdrop-blur-xl border border-red-950/40 shadow-2xl rounded-[2.5rem] transition-all duration-500 hover:border-red-900/50 group">
                <div class="absolute -right-20 -top-20 w-60 h-60 bg-red-500/10 rounded-full blur-3xl group-hover:bg-red-500/20 transition-all duration-700"></div>
                <div class="relative z-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>