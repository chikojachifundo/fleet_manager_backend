<?php

namespace App\Http\Controllers;

use App\Models\SparePartTransaction;
use App\Models\User;
use App\Models\VehicleService;
use App\Http\Requests\StoreVehicleServiceRequest;
use App\Http\Requests\UpdateVehicleServiceRequest;
use Illuminate\Support\Facades\DB;

class VehicleServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'vehicleServices' => VehicleService::with('vehicle', 'consignment', 'sparePartTransactions')->get()
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
    public function store(StoreVehicleServiceRequest $request)
    {
        $data = $request->validated();
        DB::transaction(function () use ($data) {
            $vehicleService = VehicleService::create([
                'description' => $data['description'],
                'vehicle_id' => $data['vehicle_id'],
                'consignment_id' => $data['consignment_id'] ?? null,
                'date' => $data['date'],
                'cost' => $data['cost'] ?? null,
                'contractor' => $data['contractor'],
                'contractor_contact' => $data['contractor_contact'],
                'initiator' => User::first()->id

            ]);

            foreach ($data['spare_parts'] as $key => $value) {
                SparePartTransaction::create([
                    'vehicle_id' => $data['vehicle_id'],
                    'vehicle_service_id' => $vehicleService->id,
                    'spare_part_id' => $value['spare_part_id'],
                    'quantity' => $value['quantity'],
                    'description' => $value['description'],
                    'date' => $data['date'],
                    'initiator' => User::first()->id
                ]);
            }
        });


        return response()->json([
            'data' => $request->validated(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleService $vehicleService)
    {
        return response()->json([
            'vehicleService' => $vehicleService->load('vehicle', 'consignment', 'sparePartTransactions.sparePart.code')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleService $vehicleService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleServiceRequest $request, VehicleService $vehicleService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleService $vehicleService)
    {
        //
    }
}
