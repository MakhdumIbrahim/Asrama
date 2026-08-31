<section>
    <header class="pb-6 border-b border-slate-800">
        <h2 class="text-xl font-bold text-white tracking-wide">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-slate-300 font-medium" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-2 block w-full bg-slate-950/50 border-slate-800 text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-slate-300 font-medium" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-2 block w-full bg-slate-950/50 border-slate-800 text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-slate-300 font-medium" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-2 block w-full bg-slate-950/50 border-slate-800 text-slate-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-600/30 transition-all duration-200">
                {{ __('Update Password') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
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