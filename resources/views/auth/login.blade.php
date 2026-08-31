<x-guest-layout>
    <div class="sm:max-w-md w-full mx-auto">
        <!-- Header & Logo Section -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block group">
                <div class="w-20 h-20 bg-white/5 backdrop-blur-xl rounded-2xl mx-auto flex items-center justify-center border border-white/10 shadow-[0_0_30px_rgba(14,165,233,0.3)] transition-transform duration-500 group-hover:scale-105 group-hover:rotate-3 p-3">
                    <img src="{{ asset('storage/logo/logo_asrama.jpg-removebg-preview.png') }}" alt="Logo Asrama" class="h-full w-full object-contain drop-shadow-md" />
                </div>
            </a>
            <h2 class="mt-5 text-2xl font-black tracking-tight text-white uppercase bg-clip-text text-transparent bg-gradient-to-r from-white to-sky-200">
                Selamat Datang
            </h2>
            <p class="mt-1 text-xs text-slate-400 font-light tracking-wide">
                Silakan masuk ke akun Anda untuk mengakses sistem
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-center text-xs text-emerald-400 font-medium" :status="session('status')" />

        <!-- Card Form Login -->
        <div class="glass-card p-8 rounded-[2rem] border border-white/10 shadow-2xl relative overflow-hidden backdrop-blur-2xl bg-slate-900/60">
            <!-- Decorative Glow Background -->
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-sky-500/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-12 -left-12 w-32 h-32 bg-sky-500/10 rounded-full blur-2xl pointer-events-none"></div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1" />
                    <x-text-input id="email" 
                        class="block w-full px-4 py-3 bg-slate-950/60 border border-white/10 rounded-xl text-slate-100 placeholder-slate-500 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition-all text-sm" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        placeholder="nama@email.com"
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-rose-400" />
                </div>

                <!-- Password dengan Toggle Mata -->
                <div x-data="{ showPassword: false }">
                    <x-input-label for="password" :value="__('Password')" class="text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1" />
                    
                    <div class="relative">
                        <x-text-input id="password" 
                            class="block w-full px-4 py-3 pr-12 bg-slate-950/60 border border-white/10 rounded-xl text-slate-100 placeholder-slate-500 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/30 transition-all text-sm"
                            ::type="showPassword ? 'text' : 'password'"
                            name="password"
                            placeholder="••••••••"
                            required 
                            autocomplete="current-password" />

                        <!-- Tombol Toggle Mata -->
                        <button type="button" 
                            @click="showPassword = !showPassword" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-sky-400 focus:outline-none transition-colors">
                            
                            <!-- Icon Mata Terbuka (Muncul saat password tersembunyi) -->
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12c.074-.154 1.038-2.11 2.86-3.87C6.674 6.355 9.173 5 12 5c2.827 0 5.326 1.355 7.104 3.13 1.822 1.76 2.786 3.716 2.86 3.87a.75.75 0 010 .52c-.074.154-1.038 2.11-2.86 3.87C17.326 17.645 14.827 19 12 19c-2.827 0-5.326-1.355-7.104-3.13-1.822-1.76-2.786-3.716-2.86-3.87a.75.75 0 010-.52z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <!-- Icon Mata Dicoret (Muncul saat password diperlihatkan) -->
                            <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-400" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                        <input id="remember_me" type="checkbox" class="rounded bg-slate-950/80 border-white/10 text-sky-500 shadow-sm focus:ring-sky-500/50 focus:ring-offset-slate-900 cursor-pointer" name="remember">
                        <span class="ms-2 text-slate-400 font-light hover:text-slate-200 transition-colors">{{ __('Ingat Saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sky-400 hover:text-sky-300 font-medium transition-colors hover:underline" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-4 rounded-xl text-xs font-bold uppercase tracking-widest text-white bg-gradient-to-r from-sky-600 to-sky-400 hover:from-sky-500 hover:to-sky-300 focus:outline-none focus:ring-2 focus:ring-sky-500/50 shadow-[0_0_20px_rgba(14,165,233,0.3)] hover:shadow-[0_0_25px_rgba(14,165,233,0.5)] transition-all duration-300 hover:scale-[1.01] active:scale-[0.98]">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Tombol Kembali ke Beranda -->
        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-xs text-slate-400 hover:text-sky-400 transition-colors inline-flex items-center gap-1.5 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-guest-layout>