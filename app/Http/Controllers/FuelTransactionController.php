<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use App\Models\FuelTransaction;
use App\Http\Requests\StoreFuelTransactionRequest;
use App\Http\Requests\UpdateFuelTransactionRequest;
use App\Models\User;
use Carbon\Carbon;

class   FuelTransactionController extends Controller
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

        //checking if a vehicle is on a consignment and fueling dates is in line and the consignment is active
        $data = $request->validated();

        if (!empty($data['consignment_id'])) {

            $consignment = Consignment::find($data['consignment_id']);

            // 1. Check if consignment exists
            if (!$consignment) {
                return response()->json([
                    'message' => 'Consignment not found.'
                ], 404);
            }

            // 2. Check consignment status
            if (!in_array($consignment->status, ['pending', 'approved'])) {
                return response()->json([
                    'message' => 'Fuel cannot be booked. Consignment is already delivered.'
                ], 422);
            }

            // 3. Check if vehicle belongs to consignment
            if (!in_array($data['vehicle_id'], [$consignment->vehicle_id, $consignment->horse_id])) {
                return response()->json([
                    'message' => 'Selected vehicle is not part of this consignment.'
                ], 422);
            }

            // 4. Check date alignment
            $fuelDate = Carbon::parse($data['date']);
            $consignmentDate = Carbon::parse($consignment->date);

            if ($fuelDate->lt($consignmentDate)) {
                return response()->json([
                    'message' => 'Fuel date cannot be earlier than consignment date.'
                ], 422);
            }
        }

        // 5. Create transaction
        FuelTransaction::create(array_merge($data, [
            'initiator' => auth()->id() ?? User::first()->id
        ]));

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
