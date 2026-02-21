<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Models\SparePartCode;
use App\Http\Requests\StoreSparePartCodeRequest;
use App\Http\Requests\UpdateSparePartCodeRequest;
use App\Models\Store;

class SparePartCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(SparePart::with('code', 'store')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'stores' => Store::where('status', '=', 'open')->get(),
            'spares' => SparePartCode::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSparePartCodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePartCode $sparePartCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePartCode $sparePartCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSparePartCodeRequest $request, SparePartCode $sparePartCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePartCode $sparePartCode)
    {
        //
    }
}
