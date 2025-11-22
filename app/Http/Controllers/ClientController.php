<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function index()
    {
        $user_session = Session::has('LoggedIn') ? \App\Models\User::find(Session::get('LoggedIn')) : null;
        $clients = Client::latest()->get();

        return view('admin.clients.index', compact('clients', 'user_session'));
    }

    public function create()
    {
        $user_session = Session::has('LoggedIn') ? \App\Models\User::find(Session::get('LoggedIn')) : null;
        return view('admin.clients.create', compact('user_session'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        $user_session = Session::has('LoggedIn') ? \App\Models\User::find(Session::get('LoggedIn')) : null;
        return view('admin.clients.edit', compact('client', 'user_session'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
