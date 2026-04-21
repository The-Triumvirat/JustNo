<header class="h-16 bg-trium-panel border-b border-trium-border sticky top-0 z-40">
    <nav class="h-full flex items-center justify-between px-4 lg:px-6">

        <div class="flex items-center gap-4">
            <button class="lg:hidden text-trium-text text-2xl">
                <i class='bx bx-menu'></i>
            </button>

            <div class="hidden lg:block relative group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-trium-sub group-focus-within:text-trium-400">
                    <i class='bx bx-search text-xl'></i>
                </span>
                <input type="text"
                    class="block w-80 bg-trium-bg2 border border-trium-border text-trium-text text-sm rounded-lg focus:ring-1 focus:ring-trium-400 focus:border-trium-400 pl-10 p-2 transition-all"
                    placeholder="Suchen..." disabled>
            </div>
        </div>

        <div class="flex items-center gap-2 lg:gap-4">

            <button class="lg:hidden text-trium-sub p-2">
                <i class='bx bx-search text-2xl'></i>
            </button>

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="relative p-2 text-trium-sub hover:text-trium-400 transition-colors">
                    <i class='bx bx-bell text-2xl'></i>
                    <span id="notification-count" class="absolute top-1 right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] text-white font-bold shadow-sm">2</span>
                </button>

                <div x-show="open" @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-trium-panel border border-trium-border rounded-xl shadow-trium z-50 overflow-hidden">
                    <div class="px-4 py-3 border-b border-trium-border bg-trium-bg2/50">
                        <p class="text-sm font-semibold text-trium-text">Benachrichtigungen</p>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <a href="javascript:;" class="flex items-center px-4 py-3 hover:bg-trium-bg2/50 transition-colors border-b border-trium-border last:border-0">
                            <div class="w-10 h-10 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center mr-3 shrink-0">
                                <i class='bx bx-error text-xl'></i>
                            </div>
                            <div class="flex-grow">
                                <h6 class="text-sm font-medium text-trium-text">Test-Alarm</h6>
                                <p class="text-xs text-trium-sub">Neue Bestellung eingegangen</p>
                            </div>
                        </a>
                    </div>
                    <div class="p-2">
                        <button class="w-full py-2 text-sm text-center text-trium-400 hover:bg-trium-400/5 rounded-lg transition-colors font-medium">
                            Alle anzeigen
                        </button>
                    </div>
                </div>
            </div>

            @php
            $profileData = App\Models\User::find(Auth::id());
            @endphp

            <div class="relative ml-2 border-l border-trium-border pl-4" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-trium-text leading-tight group-hover:text-trium-400 transition-colors">{{ $profileData->name }}</p>
                        <p class="text-[10px] text-trium-sub uppercase tracking-wider">{{ Str::limit($profileData->email, 20) }}</p>
                    </div>
                    <img src="{{ (!empty($profileData->photo)) ? url('upload/profile_images/'.$profileData->photo) : url('upload/no_image.jpg')}}"
                        class="w-10 h-10 rounded-xl object-cover border-2 border-trium-border shadow-sm group-hover:border-trium-400 transition-all" alt="user avatar">
                </button>

                <div x-show="open" @click.away="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-56 bg-trium-panel border border-trium-border rounded-xl shadow-trium z-50 overflow-hidden">
                    <div class="p-2 space-y-1">
                        <a href="{{ route('backoffice.profile') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-trium-text hover:bg-trium-400/10 hover:text-trium-400 rounded-lg transition-all">
                            <i class="bx bx-user text-lg"></i> Profil
                        </a>
                        <a href="{{ route('backoffice.change.password') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-trium-text hover:bg-trium-400/10 hover:text-trium-400 rounded-lg transition-all">
                            <i class="bx bx-lock text-lg"></i> Passwort ändern
                        </a>
                        <hr class="border-trium-border my-1">
                        <a href="{{ route('backoffice.logout') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-red-400 hover:bg-red-400/10 rounded-lg transition-all">
                            <i class="bx bx-log-out-circle text-lg"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>