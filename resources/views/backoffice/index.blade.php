@section('title')
Backoffice Dashboard
@endsection

@extends('backoffice.backoffice')
@section('backofficepage')

<div class="p-6"> {{-- Ersetzt .page-content --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <div class="bg-trium-panel border-l-4 border-cyan-500 rounded-xl shadow-trium-soft p-4">
            <div class="flex items-center">
                <div>
                    <p class="text-trium-sub text-sm mb-1 uppercase tracking-wider">Total Nos</p>
                    <h4 class="text-2xl font-bold text-cyan-500">{{ $totalNos }}</h4>
                </div>
                <div class="ml-auto w-12 h-12 rounded-full bg-cyan-500/10 flex items-center justify-center">
                    <i class='bx bx-block text-2xl text-cyan-500'></i>
                </div>
            </div>
        </div>

        <div class="bg-trium-panel border-l-4 border-red-500 rounded-xl shadow-trium-soft p-4">
            <div class="flex items-center">
                <div>
                    <p class="text-trium-sub text-sm mb-1 uppercase tracking-wider">Nos Today</p>
                    <h4 class="text-2xl font-bold text-red-500">{{ $nosToday }}</h4>
                </div>
                <div class="ml-auto w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center">
                    <i class='bx bxs-calendar-check text-2xl text-red-500'></i>
                </div>
            </div>
        </div>

        <div class="bg-trium-panel border-l-4 {{ $dbOk ? 'border-trium-400' : 'border-red-600' }} rounded-xl shadow-trium-soft p-4">
            <div class="flex items-center">
                <div>
                    <p class="text-trium-sub text-sm mb-1 uppercase tracking-wider">Database</p>
                    <h4 class="text-xl font-bold {{ $dbOk ? 'text-trium-400' : 'text-red-600' }}">
                        {{ $dbOk ? 'OK (' . $dbMs . ' ms)' : 'DOWN' }}
                    </h4>
                </div>
                <div class="ml-auto w-12 h-12 rounded-full {{ $dbOk ? 'bg-trium-400/10' : 'bg-red-600/10' }} flex items-center justify-center">
                    <i class='bx bxs-data text-2xl {{ $dbOk ? 'text-trium-400' : 'text-red-600' }}'></i>
                </div>
            </div>
        </div>

        <div class="bg-trium-panel border-l-4 border-orange-500 rounded-xl shadow-trium-soft p-4">
            <div class="flex items-center">
                <div>
                    <p class="text-trium-sub text-sm mb-1 uppercase tracking-wider">Queue Status</p>
                    <h4 class="text-2xl font-bold text-orange-500">{{ $queueStatus }}</h4>
                </div>
                <div class="ml-auto w-12 h-12 rounded-full bg-orange-500/10 flex items-center justify-center">
                    <i class='bx bxs-add-to-queue text-2xl text-orange-500'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-trium-panel rounded-xl shadow-trium-soft border border-trium-border overflow-hidden">
        <div class="px-6 py-4 border-b border-trium-border flex items-center justify-between">
            <h6 class="text-lg font-semibold text-trium-text">Last 10 Nos</h6>
            <button class="text-trium-sub hover:text-trium-400 transition-colors">
                <i class='bx bx-dots-horizontal-rounded text-2xl'></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-trium-bg2/50 text-trium-sub text-xs uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4 font-medium">ID</th>
                        <th class="px-6 py-4 font-medium">Reason</th>
                        <th class="px-6 py-4 font-medium">Date</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-trium-border">
                    @forelse($lastNos as $no)
                    <tr class="hover:bg-trium-bg2/30 transition-colors">
                        <td class="px-6 py-4 text-trium-text">#{{ $no->id }}</td>
                        <td class="px-6 py-4 text-trium-text">{{ $no->reason }}</td>
                        <td class="px-6 py-4 text-trium-sub text-sm">{{ $no->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium bg-trium-400/10 text-trium-400 rounded-full border border-trium-400/20">
                                OK
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-trium-sub italic">
                            No entries yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection