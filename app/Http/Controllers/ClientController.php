<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('identification_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('person_type')) {
            $query->where('person_type', $request->person_type);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'activo');
        }

        $clients = $query->orderBy('full_name')->paginate(10)->withQueryString();

        return view('modules.customers.index', compact('clients'));
    }
    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'identification_type' => 'required|in:Cédula,RUC,Pasaporte',
            'person_type' => 'required|in:jurídica,natural',
            'identification_number' => 'required|string|max:20|unique:clients',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:clients',
            'is_active' => 'boolean',
            'registered_at' => 'nullable|date',

            'marital_status' => 'nullable|string|max:50',
            'legal_representative' => 'nullable|string|max:255',
            'fiscal_address' => 'nullable|string|max:255',
        ]);
        Client::create($data);
        return redirect()->route('clients.index')->with('success', 'Cliente creado correctamente.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'identification_type' => 'required|in:Cédula,RUC,Pasaporte',
            'person_type' => 'required|in:jurídica,natural',
            'identification_number' => 'required|string|max:20|unique:clients,identification_number,' . $client->id,
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'is_active' => 'boolean',
            'registered_at' => 'nullable|date',

            'marital_status' => 'nullable|string|max:50',
            'legal_representative' => 'nullable|string|max:255',
            'fiscal_address' => 'nullable|string|max:255',
        ]);

        $client->update($data);
        return redirect()->route('clients.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
