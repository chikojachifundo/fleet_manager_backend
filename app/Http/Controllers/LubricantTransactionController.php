<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use App\Models\Lubricant;
use App\Models\LubricantTransaction;
use App\Http\Requests\StoreLubricantTransactionRequest;
use App\Http\Requests\UpdateLubricantTransactionRequest;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;

class LubricantTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreLubricantTransactionRequest $request)
    {
        //checking if a vehicle is on a consignment and lubricant dates is in line and the consignment is active
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
                    'message' => 'lubricants cannot be booked. Consignment is already delivered.'
                ], 422);
            }

            // 3. Check if vehicle belongs to consignment
            if (!in_array($data['vehicle_id'], [$consignment->vehicle_id, $consignment->horse_id])) {
                return response()->json([
                    'message' => 'Selected vehicle is not part of this consignment.'
                ], 422);
            }

            // 4. Check date alignment
            $lubricantDate = Carbon::parse($data['date']);
            $consignmentDate = Carbon::parse($consignment->date);

            if ($lubricantDate->lt($consignmentDate)) {
                return response()->json([
                    'message' => 'Lubricant date cannot be earlier than consignment date.'
                ], 422);
            }
        }


        $lubricant = Lubricant::find($data['lubricant_id']);
        if ($data['type'] == 'issue') {
            if ($data['quantity'] > $lubricant->current_stock) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => [
                        'quantity' => ['Quantity exceeds available stock']
                    ]
                ], 422);
            }
        }
        LubricantTransaction::create(array_merge($request->validated(), ['initiator' => auth()->id()]));
        return response()->json([
            'message' => 'Lubricant transaction created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LubricantTransaction $lubricantTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LubricantTransaction $lubricantTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLubricantTransactionRequest $request, LubricantTransaction $lubricantTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LubricantTransaction $lubricantTransaction)
    {
        //
    }
}
