<div class="flex flex-col h-full bg-trium-bg2 border-r border-trium-border w-64 shadow-xl">

    <div class="flex items-center h-16 px-5 border-b border-trium-border bg-trium-panel">
        <div class="flex items-center gap-3">
            <img src="{{ asset('brand/tt-lion.png') }}" class="w-8 h-8 object-contain" alt="logo icon">
            <h4 class="text-trium-text font-bold text-lg tracking-tight uppercase">Just No</h4>
        </div>
        <button class="toggle-icon ms-auto text-trium-sub hover:text-trium-400 transition-colors lg:hidden">
            <i class='bx bx-arrow-back text-xl'></i>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto custom-scrollbar px-3 py-4" data-simplebar="true">
        <ul class="space-y-1">

            <li>
                <a href="{{ route('backoffice.dashboard') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-trium-text transition-all duration-200 {{ request()->routeIs('backoffice.dashboard') ? 'bg-trium-400/10 text-trium-400 shadow-trium-soft' : 'hover:bg-trium-bg/50 hover:text-trium-400' }}">
                    <div class="text-xl"><i class='bx bx-home-alt'></i></div>
                    <div class="ml-3 font-medium">Dashboard</div>
                </a>
            </li>

            <li>
                <a href="/" target="_blank"
                    class="flex items-center px-3 py-2.5 rounded-lg text-trium-sub hover:bg-trium-bg/50 hover:text-trium-400 transition-all">
                    <div class="text-xl"><i class='bx bx-first-page'></i></div>
                    <div class="ml-3 font-medium text-sm">Zur Homepage</div>
                </a>
            </li>

            <li class="px-3 pt-6 pb-2">
                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-trium-sub/60">Your Backoffice</span>
            </li>

            <li x-data="{ open: {{ request()->routeIs('backoffice.no-reasons.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center px-3 py-2.5 rounded-lg text-trium-text transition-all hover:bg-trium-bg/50 hover:text-trium-400 group">
                    <div class="text-xl group-hover:text-trium-400"><i class='bx bx-block'></i></div>
                    <div class="ml-3 font-medium">No Reasons</div>
                    <i class='bx bx-chevron-down ml-auto transition-transform duration-200' :class="open ? 'rotate-180' : ''"></i>
                </button>

                <ul x-show="open"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    class="mt-1 space-y-1 pl-10">
                    <li>
                        <a href="{{ route('backoffice.no-reasons.index') }}"
                            class="block py-2 text-sm {{ request()->routeIs('backoffice.no-reasons.index') ? 'text-trium-400' : 'text-trium-sub hover:text-trium-400 hover:bg-trium-bg/50 ' }}">
                            All No Reasons
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.no-reasons.create') }}"
                            class="block py-2 text-sm {{ request()->routeIs('backoffice.no-reasons.create') ? 'text-trium-400' : 'text-trium-sub hover:text-trium-400 hover:bg-trium-bg/50' }}">
                            Add No Reasons
                        </a>
                    </li>
                </ul>
            </li>

            <li class="px-3 pt-6 pb-2">
                <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-trium-sub/60">Additional services</span>
            </li>

            <li>
                <a href="https://themeforest.net/user/codervent" target="_blank"
                    class="flex items-center px-3 py-2.5 rounded-lg text-trium-sub hover:bg-trium-bg/50 hover:text-trium-400">
                    <div class="text-xl"><i class="bx bx-support"></i></div>
                    <div class="ml-3 font-medium text-sm">Support</div>
                </a>
            </li>
        </ul>
    </div>
</div>