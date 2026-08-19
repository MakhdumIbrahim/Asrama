<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Card Profil --}}
            <div class="p-8 bg-slate-900 border border-slate-800 shadow-2xl rounded-[2rem] transition-all duration-500 hover:border-slate-700">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Card Password --}}
            <div class="p-8 bg-slate-900 border border-slate-800 shadow-2xl rounded-[2rem] transition-all duration-500 hover:border-slate-700">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Card Hapus Akun --}}
            <div class="p-8 bg-slate-900 border border-slate-800 shadow-2xl rounded-[2rem] transition-all duration-500 hover:border-slate-700">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>