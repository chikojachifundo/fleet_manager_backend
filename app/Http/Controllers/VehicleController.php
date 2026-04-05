<?php

namespace App\Http\Controllers;

use App\Models\Tyre;
use App\Models\TyrePosition;
use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'vehicles' => Vehicle::with('fuel')->get(),
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
    public function store(StoreVehicleRequest $request)
    {
        Vehicle::create($request->validated());
        return response()->json([
            'data' => $request->validated()
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return response()->json([
            'vehicle' => $vehicle->load('fuel', 'fuelTransactions.fuel'),
            'documents' => $vehicle->getMedia('bluebooks'),
            'tyrePositions' => TyrePosition::where('vehicle_type', $vehicle->category)->get(),
            'availableTyres' => Tyre::where('status', 'in_stock')->get(),
            'tyreMovements' => $vehicle->tyreMovements,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());
        return response()->json([
            'data' => $request->validated(),
            'message' => 'Vehicle updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
