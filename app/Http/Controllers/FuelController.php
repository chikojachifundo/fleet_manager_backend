<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Http\Requests\StoreFuelRequest;
use App\Http\Requests\UpdateFuelRequest;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'fuels' => Fuel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuelRequest $request)
    {
        $fuel = Fuel::create($request->validated());
        return response()->json([
            'fuel' => $fuel,
            'message' => 'Fuel type created successfully.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fuel $fuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fuel $fuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelRequest $request, Fuel $fuel)
    {
        $fuel->update($request->validated());
        return response()->json([
            'fuel' => $fuel,
            'message' => 'Fuel type updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuel $fuel)
    {
        $fuel->delete();
        return response()->json([
            'message' => 'Fuel type deleted successfully.',
        ]);
    }
}
