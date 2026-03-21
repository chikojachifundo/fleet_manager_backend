<?php

namespace App\Http\Controllers;

use App\Models\Lubricant;
use App\Models\LubricantTransaction;
use App\Http\Requests\StoreLubricantTransactionRequest;
use App\Http\Requests\UpdateLubricantTransactionRequest;
use App\Models\User;
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
        $data = $request->validated();
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
        LubricantTransaction::create(array_merge($request->validated(), ['initiator' => User::first()->id]));
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
