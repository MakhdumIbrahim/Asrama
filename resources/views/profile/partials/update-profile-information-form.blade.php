<section>
    <header class="flex flex-col sm:flex-row sm:items-center gap-5 pb-6 border-b border-slate-800">
        <!-- Avatar / Foto Profile Section -->
        <div class="relative group/avatar">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center text-white justify-center text-2xl font-bold shadow-xl shadow-indigo-500/20 border-2 border-slate-800 overflow-hidden">
                {{-- Menampilkan inisial nama atau placeholder foto profil --}}
                <span class="group-hover/avatar:scale-110 transition-transform duration-300">{{ substr($user->name, 0, 2) }}</span>
            </div>
            <div class="absolute inset-0 bg-black/40 rounded-2xl opacity-0 group-hover/avatar:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer text-white text-xs font-medium">
                Ubah
            </div>
        </div>
        <div>
            <h2 class="text-xl font-bold text-white tracking-wide">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-slate-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-slate-300 font-medium" />
            <x-text-input id="name" name="name" type="text" class="mt-2 block w-full bg-slate-950/50 border-slate-800 text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-300 font-medium" />
            <x-text-input id="email" name="email" type="email" class="mt-2 block w-full bg-slate-950/50 border-slate-800 text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-amber-500/10 border border-amber-500/20 rounded-xl">
                    <p class="text-sm text-amber-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm font-semibold text-amber-400 hover:text-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-600/30 transition-all duration-200">
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-emerald-400 flex items-center gap-1.5"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>