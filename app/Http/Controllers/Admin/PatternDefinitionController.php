<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatternDefinition;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PatternDefinitionController extends Controller
{
    private function checkLogin()
    {
        if (!Session::has('LoggedIn')) {
            return redirect('Userlogin')->with('fail', 'Please login first.');
        }
    }

    public function index()
    {
        $this->checkLogin();
        $user_session = User::find(Session::get('LoggedIn'));
        $patterns = PatternDefinition::orderBy('priority', 'desc')->get();
        return view('admin.pattern_definitions.index', compact('patterns', 'user_session'));
    }

    public function create()
    {
        $this->checkLogin();
        $user_session = User::find(Session::get('LoggedIn'));
        return view('admin.pattern_definitions.create', compact('user_session'));
    }

    public function store(Request $request)
    {
        $this->checkLogin();

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Convert dynamic key-value into JSON array
        $definition = [];
        $keys = $request->input('definition_keys', []);
        $values = $request->input('definition_values', []);
        foreach ($keys as $i => $key) {
            if ($key !== null && isset($values[$i])) {
                $definition[$key] = $values[$i];
            }
        }
        $data['definition_json'] = $definition;

        $data['priority'] = $data['priority'] ?? 0;
        $data['confidence_weight'] = $data['confidence_weight'] ?? 0;

        PatternDefinition::create($data);

        return redirect()->route('pattern-definitions.index')
                         ->with('success', 'Pattern Definition created successfully!');
    }

    public function edit($id)
    {
        $this->checkLogin();
        $pattern = PatternDefinition::findOrFail($id);
        $user_session = User::find(Session::get('LoggedIn'));
        return view('admin.pattern_definitions.edit', compact('pattern', 'user_session'));
    }

    public function update(Request $request, $id)
    {
        $this->checkLogin();
        $pattern = PatternDefinition::findOrFail($id);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $definition = [];
        $keys = $request->input('definition_keys', []);
        $values = $request->input('definition_values', []);
        foreach ($keys as $i => $key) {
            if ($key !== null && isset($values[$i])) {
                $definition[$key] = $values[$i];
            }
        }
        $data['definition_json'] = $definition;

        $data['priority'] = $data['priority'] ?? 0;
        $data['confidence_weight'] = $data['confidence_weight'] ?? 0;

        $pattern->update($data);

        return redirect()->route('pattern-definitions.index')
                         ->with('success', 'Pattern Definition updated successfully!');
    }

    public function destroy($id)
    {
        $this->checkLogin();
        $pattern = PatternDefinition::findOrFail($id);
        $pattern->delete();

        return redirect()->route('pattern-definitions.index')
                         ->with('success', 'Pattern Definition deleted successfully!');
    }
}
