<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-slate-950/80 backdrop-blur-xl border-b border-slate-800 shadow-2xl transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-tight text-white transition-colors">
                        Admin<span class="text-sky-500">Panel</span>
                    </a>
                </div>

                <div class="hidden space-x-1 sm:ms-10 sm:flex items-center">
                    @php 
                        $links = [
                            ['route' => 'dashboard', 'label' => 'Dashboard'],
                            ['route' => 'admin.pengurus.index', 'label' => 'Pengurus'],
                            ['route' => 'berita.index', 'label' => 'Berita'],
                            ['route' => 'prestasi.index', 'label' => 'Prestasi'],
                            ['route' => 'admin.profil.edit', 'label' => 'Pengaturan Profil Asrama']
                        ];
                    @endphp

                    @foreach($links as $link)
                    <x-nav-link :href="route($link['route'])" :active="request()->routeIs($link['route'] . '*')" 
                        class="px-4 py-2 text-sm font-medium transition-all duration-300 hover:text-sky-400 {{ request()->routeIs($link['route'] . '*') ? 'text-sky-500' : 'text-slate-400' }}">
                        {{ __($link['label']) }}
                    </x-nav-link>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="hidden sm:flex items-center gap-2 text-emerald-400 hover:text-emerald-300 font-bold text-sm bg-emerald-950/50 px-5 py-2.5 rounded-full border border-emerald-900/50 transition-all hover:scale-105 active:scale-95">
                    <span>🏠</span> Website
                </a>

                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-semibold text-slate-300 hover:text-sky-400 transition-colors duration-300">
                                <div class="mr-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800">{{ Auth::user()->name }}</div>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden shadow-xl">
                                <x-dropdown-link :href="route('profile.edit')" class="text-slate-300 hover:bg-slate-800 hover:text-white">Profile</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-400 hover:bg-slate-800 hover:text-rose-300">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>