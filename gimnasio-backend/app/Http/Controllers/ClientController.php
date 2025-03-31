<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        // ✅ Añadir middleware JWT para proteger todas las rutas
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Crear un nuevo Cliente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'telefono' => 'required|string|max:20',
        ]);
        return Client::create($request->all());
    }

    /**
     * Mostrar un Cliente específico.
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Actualizar un Cliente.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:clients,email,' . $client->id,
            'telefono' => 'sometimes|string|max:20',
        ]);
        $client->update($request->all());
        return $client;
    }

    /**
     * Eliminar un Cliente.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(null, 204);
    }
}