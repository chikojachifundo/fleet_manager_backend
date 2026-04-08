<?php

namespace App\Http\Controllers;

use App\Models\VehicleCertificate;
use App\Http\Requests\StoreVehicleCertificateRequest;
use App\Http\Requests\UpdateVehicleCertificateRequest;

class VehicleCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'certificates' => VehicleCertificate::with('vehicle')->get()
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
    public function store(StoreVehicleCertificateRequest $request)
    {
        VehicleCertificate::create(array_merge($request->validated(), ['capturer' => auth()->id()]));
        return response()->json(['message' => 'Vehicle Certificate created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleCertificate $vehicleCertificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleCertificate $vehicleCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleCertificateRequest $request, VehicleCertificate $vehicleCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleCertificate $vehicleCertificate)
    {
        //
    }
}
