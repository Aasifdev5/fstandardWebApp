<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;

class InstrumentController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }

        $instruments = Instrument::all();
        return view('admin.instruments.index', compact('instruments', 'user_session'));
    }

    public function create()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }

        return view('admin.instruments.create', compact('user_session'));
    }

    public function store(Request $request)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }

        $validated = $request->validate([
            'symbol' => 'required|unique:instruments|string|max:255',
            'category' => 'required|in:index,stock,commodity',
            'sector' => 'required|string|max:255',
            'base_price' => 'required|numeric',
            'volatility_class' => 'required|in:low,medium,high,very_high',
            'tick_size' => 'required|numeric',
            'lot_size' => 'required|integer',
            'session_start' => 'required',
            'session_end' => 'required',
            'news_sensitivity' => 'required|in:low,medium,high,very_high',
        ]);

        Instrument::create($validated);

        return redirect()->route('instruments.index')->with('success', 'Instrument created.');
    }

    public function edit(Instrument $instrument)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }

        return view('admin.instruments.edit', compact('instrument', 'user_session'));
    }

    public function update(Request $request, Instrument $instrument)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }

        $validated = $request->validate([
            'symbol' => 'required|string|max:255|unique:instruments,symbol,' . $instrument->id,
            'category' => 'required|in:index,stock,commodity',
            'sector' => 'required|string|max:255',
            'base_price' => 'required|numeric',
            'volatility_class' => 'required|in:low,medium,high,very_high',
            'tick_size' => 'required|numeric',
            'lot_size' => 'required|integer',
            'session_start' => 'required',
            'session_end' => 'required',
            'news_sensitivity' => 'required|in:low,medium,high,very_high',
        ]);

        $instrument->update($validated);

        return redirect()->route('instruments.index')->with('success', 'Instrument updated.');
    }
    public function showImportForm()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }
        return view('admin.instruments.import', compact('user_session'));
    }
    public function destroy(Instrument $instrument)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }

        $instrument->delete();
        return redirect()->route('admin.instruments.index')->with('success', 'Instrument deleted.');
    }

    public function import(Request $request)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx,xls',
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        DB::beginTransaction();

        try {

            // ================= CSV =================
            if (in_array($extension, ['csv', 'txt'])) {

                $handle = fopen($file->getRealPath(), 'r');
                fgetcsv($handle); // skip header

                while (($row = fgetcsv($handle)) !== false) {
                    $this->saveInstrumentRow($row);
                }

                fclose($handle);
            }
            // ================= EXCEL =================
            else {

                $rows = Excel::toArray([], $file)[0];
                unset($rows[0]); // remove header row

                foreach ($rows as $row) {
                    $this->saveInstrumentRow($row);
                }
            }

            DB::commit();

            return redirect()
                ->route('instruments.index')
                ->with('success', 'Instruments imported successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Save one CSV / Excel row
     */
    private function saveInstrumentRow(array $row)
    {
        if (count($row) < 10) {
            return;
        }

        Instrument::updateOrCreate(
            ['symbol' => trim($row[0])],
            [
                'category'         => trim($row[1]),
                'sector'           => trim($row[2]),
                'base_price'       => (float) $row[3],
                'volatility_class' => trim($row[4]),
                'tick_size'        => (float) $row[5],
                'lot_size'         => (int) $row[6],
                'session_start'    => trim($row[7]),
                'session_end'      => trim($row[8]),
                'news_sensitivity' => trim($row[9]),
                'is_active'        => true,
            ]
        );
    }

    // Add bulkDelete if you have it
    public function bulkDelete(Request $request)
    {
        if (!Session::has('LoggedIn')) {
            return redirect('admin')->with('fail', 'Please login first.');
        }

        $user_session = \App\Models\User::find(Session::get('LoggedIn'));
        if (!$user_session) {
            return redirect('admin')->with('fail', 'Invalid session. Please login again.');
        }

        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Instrument::whereIn('id', $ids)->delete();
        }

        return redirect()->route('instruments.index')->with('success', 'Selected instruments deleted.');
    }
}
