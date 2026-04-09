<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use App\Models\SparePartTransaction;
use App\Models\User;
use App\Models\VehicleService;
use App\Http\Requests\StoreVehicleServiceRequest;
use App\Http\Requests\UpdateVehicleServiceRequest;
use Carbon\Carbon;
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

        //checking if a vehicle is on a consignment and servicing dates is in line and the consignment is active
        $data = $request->validated();

        if (!empty($data['consignment_id'])) {

            $consignment = Consignment::find($data['consignment_id']);

            // 1. Check if consignment exists
            if (!$consignment) {
                return response()->json([
                    'message' => 'Consignment not found.'
                ], 404);
            }

            // 2. Check consignment status
            if (!in_array($consignment->status, ['pending', 'approved'])) {
                return response()->json([
                    'message' => 'Fuel cannot be booked. Consignment is already delivered.'
                ], 422);
            }

            // 3. Check if vehicle belongs to consignment
            if (!in_array($data['vehicle_id'], [$consignment->vehicle_id, $consignment->horse_id])) {
                return response()->json([
                    'message' => 'Selected vehicle is not part of this consignment.'
                ], 422);
            }

            // 4. Check date alignment
            $serviceDate = Carbon::parse($data['date']);
            $consignmentDate = Carbon::parse($consignment->date);

            if ($serviceDate->lt($consignmentDate)) {
                return response()->json([
                    'message' => 'Service date cannot be earlier than consignment date.'
                ], 422);
            }
        }

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
