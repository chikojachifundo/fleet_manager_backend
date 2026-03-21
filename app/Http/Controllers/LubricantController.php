<?php

namespace App\Http\Controllers;

use App\Models\Lubricant;
use App\Http\Requests\StoreLubricantRequest;
use App\Http\Requests\UpdateLubricantRequest;

class LubricantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'lubricants' => Lubricant::with('transactions')->get()
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
    public function store(StoreLubricantRequest $request)
    {
        Lubricant::create($request->validated());
        return response()->json([
            "message" => "Lubricant created",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lubricant $lubricant)
    {
        return response()->json([
            'lubricant' => $lubricant->load(['transactions.vehicle'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lubricant $lubricant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLubricantRequest $request, Lubricant $lubricant)
    {
        $lubricant->update($request->validated());
        return response()->json([
            "message" => "Lubricant updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lubricant $lubricant)
    {
        //
    }
}
