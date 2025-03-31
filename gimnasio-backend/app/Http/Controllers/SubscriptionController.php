<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Subscription::with('client')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'tipo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);
        return Subscription::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
        return $subscription->load('client');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
        $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'tipo' => 'sometimes|string|max:255',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'sometimes|date|after:fecha_inicio',
        ]);
        $subscription->update($request->all());
        return $subscription;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
        $subscription->delete();
        return response()->json(null, 204);
    }
}
