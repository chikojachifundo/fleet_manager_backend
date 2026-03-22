<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use App\Http\Requests\StoreConsignmentRequest;
use App\Http\Requests\UpdateConsignmentRequest;
use App\Models\ConsignmentRoute;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;

class ConsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'consignments' => Consignment::with('driver','consignmentRoute')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'horses' => Vehicle::all(),
            'drivers' => Driver::all(),
            'routes' => ConsignmentRoute::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConsignmentRequest $request)
    {
        $consignment = Consignment::create(array_merge($request->validated(), [
            'capturer_id' => User::first()->id,
        ]));
        return response()->json([
            'consignment' => $consignment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Consignment $consignment)
    {
        return response()->json([
            'consignment' => $consignment->load('driver','consignmentRoute','horse','firstTrailer','secondTrailer','lubricantsTransactions.lubricant'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consignment $consignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsignmentRequest $request, Consignment $consignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consignment $consignment)
    {
        //
    }
}
