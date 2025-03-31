<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Sale::with('client', 'product')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
            'cantidad' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);
        return Sale::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
        return $sale->load('client', 'product');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
        $request->validate([
            'client_id' => 'sometimes|exists:clients,id',
            'product_id' => 'sometimes|exists:products,id',
            'cantidad' => 'sometimes|integer|min:1',
            'total' => 'sometimes|numeric|min:0',
        ]);
        $sale->update($request->all());
        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
        $sale->delete();
        return response()->json(null, 204);
    }
}
