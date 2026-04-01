<?php

namespace App\Http\Controllers;

use App\Models\Tyre;
use App\Http\Requests\StoreTyreRequest;
use App\Http\Requests\UpdateTyreRequest;

class TyreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'tyres' => Tyre::all()
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
    public function store(StoreTyreRequest $request)
    {
        Tyre::create(array_merge($request->validated(), ['capturer' => auth()->id()]));
        return response()->json(['message' => 'Tyre created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tyre $tyre)
    {
        return response()->json([
            'tyre' => $tyre
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tyre $tyre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTyreRequest $request, Tyre $tyre)
    {
        $tyre->update($request->validated());
        return response()->json(['message' => 'Tyre updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tyre $tyre)
    {
        //
    }
}
