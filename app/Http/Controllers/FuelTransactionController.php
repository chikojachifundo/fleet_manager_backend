<?php

namespace App\Http\Controllers;

use App\Models\FuelTransaction;
use App\Http\Requests\StoreFuelTransactionRequest;
use App\Http\Requests\UpdateFuelTransactionRequest;
use App\Models\User;

class FuelTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'fuel_transactions' => FuelTransaction::with('vehicle','fuel')->get(),
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
    public function store(StoreFuelTransactionRequest $request)
    {
        FuelTransaction::create(array_merge($request->validated(), ['initiator' => User::first()->id]));
        return response()->json([
            'message' => 'Fuel transaction created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FuelTransaction $fuelTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelTransaction $fuelTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelTransactionRequest $request, FuelTransaction $fuelTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FuelTransaction $fuelTransaction)
    {
        //
    }
}
