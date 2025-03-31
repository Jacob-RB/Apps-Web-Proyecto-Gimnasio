<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'precio' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return response()->json(null, 204);
    }
}
