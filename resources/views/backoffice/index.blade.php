@section('title')
Backoffice Dashboard
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
<div>
    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">

        <div class="jn-stat-card border-cyan-500">
            <div class="flex items-center">
                <div>
                    <p class="jn-stat-label">Total Nos</p>
                    <h4 class="jn-stat-value text-cyan-500">{{ $totalNos }}</h4>
                </div>
                <div class="jn-icon-circle bg-cyan-500/10">
                    <i class='bx bx-block text-2xl text-cyan-500'></i>
                </div>
            </div>
        </div>

        <div class="jn-stat-card border-red-500">
            <div class="flex items-center">
                <div>
                    <p class="jn-stat-label">Nos Today</p>
                    <h4 class="jn-stat-value text-red-500">{{ $nosToday }}</h4>
                </div>
                <div class="jn-icon-circle bg-red-500/10">
                    <i class='bx bxs-calendar-check text-2xl text-red-500'></i>
                </div>
            </div>
        </div>

        <div class="jn-stat-card {{ $dbOk ? 'border-trium-400' : 'border-red-600' }}">
            <div class="flex items-center">
                <div>
                    <p class="jn-stat-label">Database</p>
                    <h4 class="text-xl font-bold {{ $dbOk ? 'text-trium-400' : 'text-red-600' }}">
                        {{ $dbOk ? 'OK (' . $dbMs . ' ms)' : 'DOWN' }}
                    </h4>
                </div>
                <div class="jn-icon-circle {{ $dbOk ? 'bg-trium-400/10' : 'bg-red-600/10' }}">
                    <i class='bx bxs-data text-2xl {{ $dbOk ? 'text-trium-400' : 'text-red-600' }}'></i>
                </div>
            </div>
        </div>

        <div class="jn-stat-card border-orange-500">
            <div class="flex items-center">
                <div>
                    <p class="jn-stat-label">Queue Status</p>
                    <h4 class="jn-stat-value text-orange-500">{{ $queueStatus }}</h4>
                </div>
                <div class="jn-icon-circle bg-orange-500/10">
                    <i class='bx bxs-add-to-queue text-2xl text-orange-500'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="jn-card overflow-hidden">
        <div class="jn-card-header">
            <h6 class="jn-card-title">Last 10 Nos</h6>
            <button type="button" class="jn-btn-ghost px-2 py-2">
                <i class='bx bx-dots-horizontal-rounded text-2xl'></i>
            </button>
        </div>

        <div class="jn-table-wrap">
            <table class="jn-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lastNos as $no)
                    <tr>
                        <td>#{{ $no->id }}</td>
                        <td>{{ $no->reason }}</td>
                        <td class="text-sm text-trium-sub">{{ $no->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <span class="jn-badge-success">OK</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center italic text-trium-sub">
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