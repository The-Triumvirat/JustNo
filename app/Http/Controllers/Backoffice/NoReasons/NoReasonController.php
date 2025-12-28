<?php

namespace App\Http\Controllers\Backoffice\NoReasons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NoReason;

class NoReasonController extends Controller
{
    
    public function index()
    {
        $noReasons = NoReason::all();
        return view('backoffice.no-reasons.index', compact('noReasons'));
    }

    public function create()
    {
        return view('backoffice.no-reasons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:512',
        ]);

        NoReason::create([
            'reason' => $request->input('reason'),
        ]);

        return redirect()->route('backoffice.no-reasons.index')->with('success', 'No Reason created successfully.');
    }

    public function edit($id)
    {
        $noReason = NoReason::findOrFail($id);
        return view('backoffice.no-reasons.edit', compact('noReason'));
    }

    public function update(Request $request, $id)
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

    public function destroy($id)
    {
        $noReason = NoReason::findOrFail($id);
        $noReason->delete();

        return redirect()->route('backoffice.no-reasons.index')->with('success', 'No Reason deleted successfully.');
    }

    public function export()
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
    public function importNoReasons()
    {
        return view('backoffice.no-reasons.import');
    }

    public function importNoReasonsStore(Request $request)
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

            // Leere / zu kurze Werte ignorieren
            if ($reason === '' || strlen($reason) < 3) {
                $skipped++;
                continue;
            }

            // Duplikate verhindern
            if (NoReason::where('reason', $reason)->exists()) {
                $skipped++;
                continue;
            }

            NoReason::create(['reason' => $reason]);
            $imported++;
        }

        $notification = array(
            'message' => "Import abgeschlossen — Importiert: $imported | Übersprungen: $skipped",
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}