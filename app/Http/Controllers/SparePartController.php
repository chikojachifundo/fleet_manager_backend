<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use App\Http\Requests\StoreSparePartRequest;
use App\Http\Requests\UpdateSparePartRequest;
use App\Models\SparePartCode;
use App\Models\Store;
use App\Models\User;

class SparePartController extends Controller
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
            'codes' => SparePartCode::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSparePartRequest $request)
    {
        $data = array_merge($request->validated(), ['captured_by' => User::first()->id]);
        $sparePart = SparePart::create($data);
        return response()->json($sparePart, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparePart)
    {
        return response()->json([
            'sparePart' => $sparePart->load('code', 'store','incomingRequisitions'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparePart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSparePartRequest $request, SparePart $sparePart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePart $sparePart)
    {
        //
    }
}
