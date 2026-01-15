<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\PatternDefinition;
use App\Models\PatternState;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPatternController extends Controller
{
    public function index()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('Userlogin')->with('fail', 'Please login first.');
        }

        $user_session = User::findOrFail(Session::get('LoggedIn'));

        return view('admin.patterns.index', [
            'user_session' => $user_session,
            'patterns'     => PatternDefinition::where('is_active', true)->get(),
            'instruments'  => Instrument::where('is_active', true)->get(),
            'timeframes'   => ['1m', '5m', '15m', '30m', '1h', '4h', '1D'],
            'injectedPatterns' => PatternState::with('patternDefinition', 'instrument')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pattern_definition_id' => 'required|exists:pattern_definitions,id',
            'instrument_id'         => 'required|exists:instruments,id',
            'timeframe'             => 'required|string',
            'strength'              => 'required|numeric|min:0.4|max:0.95',
            'start_at'              => 'nullable|date',
            'end_at'                => 'nullable|date|after:start_at',
            'generate_fractals'     => 'boolean',
        ]);

        $startAt = $data['start_at'] ? Carbon::parse($data['start_at']) : now();
        $endAt = $data['end_at'] ?? $startAt->copy()->addMinutes(rand(20, 120));

        $pattern = PatternState::create([
            'pattern_definition_id' => $data['pattern_definition_id'],
            'instrument_id'         => $data['instrument_id'],
            'timeframe'             => $data['timeframe'],
            'strength'              => $data['strength'],
            'confidence'            => round($data['strength'] * rand(85, 100), 2),
            'source'                => 'admin_manual',
            'is_active'             => true,
            'starts_at'             => $startAt,
            'ends_at'               => $endAt,
        ]);

        if ($request->boolean('generate_fractals')) {
            $this->generateFractals($pattern);
        }

        return redirect()->route('admin.patterns.index')
                         ->with('success', 'Pattern injected successfully!');
    }

    protected function generateFractals(PatternState $parent)
    {
        $map = [
            '1m'  => ['5m'],
            '5m'  => ['1m', '15m'],
            '15m' => ['5m', '30m'],
            '30m' => ['15m', '1h'],
            '1h'  => ['30m', '4h'],
            '4h'  => ['1h', '1D'],
        ];

        foreach ($map[$parent->timeframe] ?? [] as $tf) {
            PatternState::create([
                'pattern_definition_id' => $parent->pattern_definition_id,
                'instrument_id'         => $parent->instrument_id,
                'timeframe'             => $tf,
                'strength'              => round($parent->strength * 0.8, 2),
                'confidence'            => round($parent->confidence * 0.85, 2),
                'source'                => 'admin_fractal',
                'parent_pattern_id'     => $parent->id,
                'is_active'             => true,
                'starts_at'             => $parent->starts_at,
                'ends_at'               => $parent->ends_at,
            ]);
        }
    }

    public function destroy(PatternState $pattern)
    {
        $pattern->delete();
        return redirect()->route('patterns.index')
                         ->with('success', 'Pattern deleted successfully!');
    }
}
