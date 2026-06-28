<?php

namespace App\Http\Controllers\Backoffice\NoReasons;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\NoReason;
use Illuminate\Http\Response;
use Illuminate\View\View;

class NoReasonController extends Controller
{
    
    public function index(Request $request): View
    {
        $search = trim($request->string('search')->toString());
        $sort = $request->string('sort')->toString();
        $perPage = $request->integer('per_page');

        $sortOptions = [
            'alpha' => ['reason', 'asc'],
            'alpha_desc' => ['reason', 'desc'],
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
        ];

        if (!array_key_exists($sort, $sortOptions)) {
            $sort = 'oldest';
        }

        if (!in_array($perPage, [25, 50, 100], true)) {
            $perPage = 25;
        }

        [$sortColumn, $sortDirection] = $sortOptions[$sort];

        $noReasons = NoReason::query()
            ->when($search !== '', fn ($query) => $query->where('reason', 'like', "%{$search}%"))
            ->orderBy($sortColumn, $sortDirection)
            ->orderBy('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('backoffice.no-reasons.index', compact('noReasons', 'search', 'sort', 'perPage'));
    }

    public function create(): View
    {
        return view('backoffice.no-reasons.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'reason' => 'required|string|max:512',
        ]);

        NoReason::create([
            'reason' => $request->input('reason'),
        ]);

        return redirect()->route('backoffice.no-reasons.index')->with('success', 'No Reason created successfully.');
    }

    public function edit($id): View
    {
        $noReason = NoReason::findOrFail($id);
        return view('backoffice.no-reasons.edit', compact('noReason'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'reason' => 'required|string|max:512',
        ]);

        $noReason = NoReason::findOrFail($id);
        $noReason->update([
            'reason' => $request->input('reason'),
        ]);

        return redirect()->route('backoffice.no-reasons.index')->with('success', 'No Reason updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $noReason = NoReason::findOrFail($id);
        $noReason->delete();

        return redirect()->route('backoffice.no-reasons.index')->with('success', 'No Reason deleted successfully.');
    }

    public function export(): Response
    {
        $noReasons = NoReason::pluck('reason');

        $filename = 'no_reasons_' . now()->format('Y-m-d_H-i-s') . '.json';

        return response(
            $noReasons->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            200,
            [
                'Content-Type' => 'application/json',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ]
        );
    }

    /**
     * Import export No Reasons
     */
    public function importNoReasons(): View
    {
        return view('backoffice.no-reasons.import');
    }

    public function importNoReasonsStore(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:json'
        ]);

        try {
            $data = json_decode(
                file_get_contents($request->file('file')->path()),
                true
            );
        } catch (\Throwable $e) {
            return back()->with('error', 'JSON konnte nicht gelesen werden.');
        }

        if (!is_array($data)) {
            return back()->with('error', 'Ungültiges JSON Format.');
        }

        $imported = 0;
        $skipped = 0;

        foreach ($data as $reason) {
            $reason = trim($reason ?? '');

            // Ignore empty/too short values
            if ($reason === '' || strlen($reason) < 2) {
                $skipped++;
                continue;
            }

            // Automatically performs insert OR detects duplicate via UNIQUE index
            $entry = NoReason::firstOrCreate(['reason' => $reason]);

            if ($entry->wasRecentlyCreated) {
                $imported++;
            } else {
                $skipped++;
            }
        }

        $notification = [
            'message' => "Import abgeschlossen — Importiert: $imported | Übersprungen: $skipped",
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


}
