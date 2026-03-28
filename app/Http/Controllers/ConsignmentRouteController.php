<?php

namespace App\Http\Controllers;

use App\Models\ConsignmentRoute;
use App\Http\Requests\StoreConsignmentRouteRequest;
use App\Http\Requests\UpdateConsignmentRouteRequest;
use function MongoDB\Driver\Monitoring\removeSubscriber;

class ConsignmentRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'consignmentRoutes' => ConsignmentRoute::all()
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
    public function store(StoreConsignmentRouteRequest $request)
    {
        ConsignmentRoute::create($request->validated());
        return response()->json([
            'message' => 'Consignment route created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsignmentRoute $consignmentRoute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConsignmentRoute $consignmentRoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConsignmentRouteRequest $request, ConsignmentRoute $consignmentRoute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsignmentRoute $consignmentRoute)
    {
        //
    }
}
