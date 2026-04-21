<div class="flex h-full w-64 flex-col border-r border-trium-border bg-trium-bg2 shadow-xl">

    <div class="flex h-16 items-center border-b border-trium-border bg-trium-panel px-5">
        <div class="flex items-center gap-3">
            <img src="{{ asset('brand/tt-lion.png') }}" class="h-8 w-8 object-contain" alt="Just No logo">
            <h4 class="text-lg font-bold uppercase tracking-tight text-trium-text">Just No</h4>
        </div>

        <button
            @click="sidebarOpen = false"
            type="button"
            class="ml-auto text-trium-sub transition-colors hover:text-trium-400 lg:hidden"
            aria-label="Close sidebar">
            <i class='bx bx-arrow-back text-xl'></i>
        </button>
    </div>

    <div class="custom-scrollbar flex-1 overflow-y-auto px-3 py-4">
        <ul class="space-y-1">

            <li>
                <a href="{{ route('backoffice.dashboard') }}"
                    class="flex items-center rounded-lg px-3 py-2.5 transition-all duration-200 {{ request()->routeIs('backoffice.dashboard') ? 'bg-trium-400/10 text-trium-400 shadow-trium-soft' : 'text-trium-text hover:bg-trium-bg/50 hover:text-trium-400' }}">
                    <div class="text-xl"><i class='bx bx-home-alt'></i></div>
                    <div class="ml-3 font-medium">Dashboard</div>
                </a>
            </li>

            <li>
                <a href="/" target="_blank"
                    class="flex items-center rounded-lg px-3 py-2.5 text-trium-sub transition-all hover:bg-trium-bg/50 hover:text-trium-400">
                    <div class="text-xl"><i class='bx bx-first-page'></i></div>
                    <div class="ml-3 text-sm font-medium">Zur Homepage</div>
                </a>
            </li>

            <li class="px-3 pb-2 pt-6">
                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-trium-sub/60">Your Backoffice</span>
            </li>

            <li x-data="{ open: {{ request()->routeIs('backoffice.no-reasons.*') ? 'true' : 'false' }} }">
                <button
                    @click="open = !open"
                    type="button"
                    class="group flex w-full items-center rounded-lg px-3 py-2.5 text-trium-text transition-all hover:bg-trium-bg/50 hover:text-trium-400">
                    <div class="text-xl group-hover:text-trium-400"><i class='bx bx-block'></i></div>
                    <div class="ml-3 font-medium">No Reasons</div>
                    <i class='bx bx-chevron-down ml-auto transition-transform duration-200' :class="open ? 'rotate-180' : ''"></i>
                </button>

                <ul
                    x-show="open"
                    x-cloak
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="mt-1 space-y-1 pl-10">
                    <li>
                        <a href="{{ route('backoffice.no-reasons.index') }}"
                            class="block rounded-md px-3 py-2 text-sm transition-colors {{ request()->routeIs('backoffice.no-reasons.index') ? 'bg-trium-400/10 font-medium text-trium-400' : 'text-trium-sub hover:bg-trium-bg/50 hover:text-trium-400' }}">
                            All No Reasons
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.no-reasons.create') }}"
                            class="block rounded-md px-3 py-2 text-sm transition-colors {{ request()->routeIs('backoffice.no-reasons.create') ? 'bg-trium-400/10 font-medium text-trium-400' : 'text-trium-sub hover:bg-trium-bg/50 hover:text-trium-400' }}">
                            Add No Reason
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>