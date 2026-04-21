<div class="jn-sidebar-panel">

    <div class="jn-sidebar-head">
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

    <div class="jn-sidebar-body custom-scrollbar">
        <ul class="space-y-1">

            <li>
                <a href="{{ route('backoffice.dashboard') }}"
                    class="jn-sidebar-link {{ request()->routeIs('backoffice.dashboard') ? 'jn-sidebar-link-active' : '' }}">
                    <div class="jn-sidebar-icon">
                        <i class='bx bx-home-alt'></i>
                    </div>
                    <div class="jn-sidebar-text">Dashboard</div>
                </a>
            </li>

            <li>
                <a href="/" target="_blank" class="jn-sidebar-link-muted">
                    <div class="jn-sidebar-icon">
                        <i class='bx bx-first-page'></i>
                    </div>
                    <div class="jn-sidebar-text text-sm">Zur Homepage</div>
                </a>
            </li>

            <li>
                <div class="jn-sidebar-section-label">Your Backoffice</div>
            </li>

            <li x-data="{ open: {{ request()->routeIs('backoffice.no-reasons.*') ? 'true' : 'false' }} }">
                <button
                    @click="open = !open"
                    type="button"
                    class="jn-sidebar-link w-full group">
                    <div class="jn-sidebar-icon group-hover:text-trium-400">
                        <i class='bx bx-block'></i>
                    </div>
                    <div class="jn-sidebar-text">No Reasons</div>
                    <i class='bx bx-chevron-down ml-auto transition-transform duration-200' :class="open ? 'rotate-180' : ''"></i>
                </button>

                <ul
                    x-show="open"
                    x-cloak
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="jn-sidebar-submenu">
                    <li>
                        <a href="{{ route('backoffice.no-reasons.index') }}"
                            class="jn-sidebar-sublink {{ request()->routeIs('backoffice.no-reasons.index') ? 'jn-sidebar-sublink-active' : '' }}">
                            All No Reasons
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.no-reasons.create') }}"
                            class="jn-sidebar-sublink {{ request()->routeIs('backoffice.no-reasons.create') ? 'jn-sidebar-sublink-active' : '' }}">
                            Add No Reason
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>