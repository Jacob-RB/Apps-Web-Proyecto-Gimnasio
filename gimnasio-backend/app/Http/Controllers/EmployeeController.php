<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|string|max:255',
            'puesto' => 'required|string|max:255'
        ]);

        return Employee::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'puesto' => 'sometimes|string|max:255'
        ]);

        $employee->update($request->all());
        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return response()->json(null, 204);
    }
}
