<header class="sticky top-0 z-40 h-16 border-b border-trium-border bg-trium-panel">
    <nav class="flex h-full items-center justify-between px-4 lg:px-6">

        {{-- LEFT: Menu + Search --}}
        <div class="flex items-center gap-4">

            {{-- Mobile Sidebar Toggle --}}
            <button
                @click="sidebarOpen = true"
                type="button"
                class="rounded-lg p-2 text-2xl text-trium-text transition-colors hover:bg-trium-bg2 hover:text-trium-400 lg:hidden"
                aria-label="Open sidebar">
                <i class='bx bx-menu'></i>
            </button>

            {{-- Desktop Search --}}
            <div class="relative hidden lg:block group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-trium-sub group-focus-within:text-trium-400">
                    <i class='bx bx-search text-xl'></i>
                </span>

                <input
                    type="text"
                    readonly
                    placeholder="Search coming later"
                    class="block w-80 rounded-lg border border-trium-border bg-trium-bg2 p-2 pl-10 text-sm text-trium-text transition-all focus:border-trium-400 focus:ring-1 focus:ring-trium-400">
            </div>
        </div>

        @php($profileData = Auth::user())

        {{-- RIGHT: Actions --}}
        <div class="flex items-center gap-2 lg:gap-4">

            {{-- Mobile Search Button --}}
            <button
                type="button"
                class="rounded-lg p-2 text-trium-sub transition-colors hover:bg-trium-bg2 hover:text-trium-400 lg:hidden"
                aria-label="Search">
                <i class='bx bx-search text-2xl'></i>
            </button>

            {{-- Notifications --}}
            <div class="relative" x-data="{ open: false }">

                <button
                    @click="open = !open"
                    type="button"
                    class="relative rounded-lg p-2 text-trium-sub transition-colors hover:bg-trium-bg2 hover:text-trium-400"
                    aria-label="Notifications">
                    <i class='bx bx-bell text-2xl'></i>

                    {{-- Counter --}}
                    <span class="absolute right-1 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white shadow-sm">
                        2
                    </span>
                </button>

                {{-- Dropdown --}}
                <div
                    x-show="open"
                    x-cloak
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform scale-95 opacity-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-end="transform scale-95 opacity-0"
                    class="absolute right-0 z-50 mt-2 w-80 overflow-hidden rounded-xl border border-trium-border bg-trium-panel shadow-trium">
                    <div class="border-b border-trium-border bg-trium-bg2/50 px-4 py-3">
                        <p class="text-sm font-semibold text-trium-text">Benachrichtigungen</p>
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

            {{-- Profile --}}
            <div class="relative ml-2 border-l border-trium-border pl-4" x-data="{ open: false }">

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
                        class="h-10 w-10 rounded-xl border-2 border-trium-border object-cover shadow-sm transition-all group-hover:border-trium-400"
                        alt="User avatar">
                </button>

                {{-- Dropdown --}}
                <div
                    x-show="open"
                    x-cloak
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform scale-95 opacity-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-end="transform scale-95 opacity-0"
                    class="absolute right-0 z-50 mt-2 w-56 overflow-hidden rounded-xl border border-trium-border bg-trium-panel shadow-trium">
                    <div class="space-y-1 p-2">

                        <a href="{{ route('backoffice.profile') }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-trium-text transition-all hover:bg-trium-400/10 hover:text-trium-400">
                            <i class="bx bx-user text-lg"></i>
                            Profil
                        </a>

                        <a href="{{ route('backoffice.change.password') }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-trium-text transition-all hover:bg-trium-400/10 hover:text-trium-400">
                            <i class="bx bx-lock text-lg"></i>
                            Passwort ändern
                        </a>

                        <hr class="my-1 border-trium-border">

                        <a href="{{ route('backoffice.logout') }}"
                            class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm text-red-400 transition-all hover:bg-red-400/10">
                            <i class="bx bx-log-out-circle text-lg"></i>
                            Logout
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </nav>
</header>