<?php

namespace App\Http\Controllers;

use App\Models\IncomingSparePartRequisition;
use App\Http\Requests\StoreIncomingSparePartRequisitionRequest;
use App\Http\Requests\UpdateIncomingSparePartRequisitionRequest;
use App\Models\User;

class IncomingSparePartRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'requisitions' => IncomingSparePartRequisition::with('sparePart.code')->get(),
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
    public function store(StoreIncomingSparePartRequisitionRequest $request)
    {
        $data = array_merge($request->validated(), ['requester_id' => User::first()->id]);
        $requisition = IncomingSparePartRequisition::create($data);
        return response()->json([
            'requisition' => $requisition,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingSparePartRequisition $incomingSparePartRequisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomingSparePartRequisition $incomingSparePartRequisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomingSparePartRequisitionRequest $request, IncomingSparePartRequisition $incomingSparePartRequisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomingSparePartRequisition $incomingSparePartRequisition)
    {
        //
    }
}
