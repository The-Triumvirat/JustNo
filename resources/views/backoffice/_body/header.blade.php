<header class="jn-topbar">
    <nav class="jn-topbar-inner">

        <div class="jn-topbar-group">
            <button
                @click="sidebarOpen = true"
                type="button"
                class="jn-topbar-icon-btn-strong lg:hidden"
                aria-label="Open sidebar">
                <i class='bx bx-menu'></i>
            </button>

            <div class="jn-topbar-search-wrap group">
                <span class="jn-topbar-search-icon group-focus-within:text-trium-400">
                    <i class='bx bx-search text-xl'></i>
                </span>

                <input
                    type="text"
                    readonly
                    placeholder="Search coming later"
                    class="jn-topbar-search">
            </div>
        </div>

        @php($profileData = Auth::user())

        <div class="jn-topbar-actions">

            <button
                type="button"
                class="jn-topbar-icon-btn lg:hidden"
                aria-label="Search">
                <i class='bx bx-search text-2xl'></i>
            </button>

            <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    type="button"
                    class="jn-topbar-icon-btn relative"
                    aria-label="Notifications">
                    <i class='bx bx-bell text-2xl'></i>
                    <span class="jn-topbar-counter">2</span>
                </button>

                <div
                    x-show="open"
                    x-cloak
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform scale-95 opacity-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-end="transform scale-95 opacity-0"
                    class="jn-topbar-dropdown w-80">
                    <div class="jn-topbar-dropdown-head">
                        <p class="jn-topbar-dropdown-title">Benachrichtigungen</p>
                    </div>

                    <div class="max-h-64 overflow-y-auto">
                        <button
                            type="button"
                            class="flex w-full items-center border-b border-trium-border px-4 py-3 text-left transition-colors hover:bg-trium-bg2/50 last:border-0">
                            <div class="mr-3 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-500/10 text-red-500">
                                <i class='bx bx-error text-xl'></i>
                            </div>
                            <div class="flex-grow">
                                <h6 class="text-sm font-medium text-trium-text">Test-Alarm</h6>
                                <p class="text-xs text-trium-sub">Neue Bestellung eingegangen</p>
                            </div>
                        </button>
                    </div>

                    <div class="p-2">
                        <button
                            type="button"
                            class="w-full rounded-lg py-2 text-center text-sm font-medium text-trium-400 transition-colors hover:bg-trium-400/5">
                            Alle anzeigen
                        </button>
                    </div>
                </div>
            </div>

            <div class="jn-topbar-profile-wrap" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    type="button"
                    class="group flex items-center gap-3 focus:outline-none">
                    <div class="hidden text-right sm:block">
                        <p class="text-sm font-semibold leading-tight text-trium-text transition-colors group-hover:text-trium-400">
                            {{ $profileData->name }}
                        </p>
                        <p class="text-[10px] uppercase tracking-wider text-trium-sub">
                            {{ \Illuminate\Support\Str::limit($profileData->email, 20) }}
                        </p>
                    </div>

                    <img
                        src="{{ !empty($profileData->photo) ? url('upload/profile_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                        class="jn-topbar-avatar"
                        alt="User avatar">
                </button>

                <div
                    x-show="open"
                    x-cloak
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform scale-95 opacity-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-end="transform scale-95 opacity-0"
                    class="jn-topbar-dropdown w-56">
                    <div class="space-y-1 p-2">
                        <a href="{{ route('backoffice.profile') }}" class="jn-topbar-menu-link">
                            <i class="bx bx-user text-lg"></i>
                            Profil
                        </a>

                        <a href="{{ route('backoffice.change.password') }}" class="jn-topbar-menu-link">
                            <i class="bx bx-lock text-lg"></i>
                            Passwort ändern
                        </a>

                        <hr class="jn-topbar-divider">

                        <a href="{{ route('backoffice.logout') }}" class="jn-topbar-menu-link-danger">
                            <i class="bx bx-log-out-circle text-lg"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</header>