<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Schedule::with('employee')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio'
        ]);
        return Schedule::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
        return $schedule->load('employee');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
        $request->validate([
            'employee_id' => 'sometimes|exists:employees,id',
            'fecha' => 'sometimes|date',
            'hora_inicio' => 'sometimes|date_format:H:i',
            'hora_fin' => 'sometimes|date_format:H:i|after:hora_inicio'
        ]);
        $schedule->update($request->all());
        return $schedule;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
        $schedule->delete();
        return response()->json(null, 204);
    }
}
