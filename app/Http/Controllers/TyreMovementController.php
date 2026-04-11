<?php

namespace App\Http\Controllers;

use App\Models\Tyre;
use App\Models\TyreMovement;
use App\Http\Requests\StoreTyreMovementRequest;
use App\Http\Requests\UpdateTyreMovementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TyreMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => ['required', 'integer', 'exists:vehicles,id'],

            'positions' => ['required', 'array', 'min:1'],

            'positions.*.position_id' => ['required', 'integer', 'exists:tyre_positions,id'],
            'positions.*.tyre_id' => ['nullable', 'integer', 'exists:tyres,id'],

            'positions.*.fitted_date' => ['nullable', 'date'],
            'positions.*.removed_date' => ['nullable', 'date'],

            'positions.*.odometer_at_fit' => ['nullable', 'numeric', 'min:0'],
            'positions.*.odometer_at_removal' => ['nullable', 'numeric', 'min:0'],

            'positions.*.remove' => ['required', 'boolean'],
        ]);


        DB::beginTransaction();
        try {

            foreach ($validated['positions'] as $pos) {
                //checking if the position is already taken
                if (TyreMovement::where('vehicle_id', $validated['vehicle_id'])->where('tyre_position_id', $pos['position_id'])->count() > 0) {
                    DB::rollBack();
                    return response()->json([
                        'message' => 'Failed to process tyre movements',
                        'error' => "The position is already taken. Please remove the allocation first before new assignment",
                    ], 422);
                }

                // 🔴 CASE 1: REMOVE TYRE
//                if ($pos['remove'] === true) {
//
//                    TyreMovement::create([
//                        'vehicle_id' => $validated['vehicle_id'],
//                        'position_id' => $pos['position_id'],
//                        'tyre_id' => $pos['tyre_id'], // may be null depending on your logic
//                        'type' => 'remove',
//                        'movement_date' => $pos['removed_date'],
//                        'odometer' => $pos['odometer_at_removal'],
//                    ]);
//
//                    continue;
//                }

                // 🟢 CASE 2: FIT TYRE
                if (!empty($pos['tyre_id'])) {

                    TyreMovement::create([
                        'vehicle_id' => $validated['vehicle_id'],
                        'tyre_position_id' => $pos['position_id'],
                        'tyre_id' => $pos['tyre_id'],
                        'fitted_date' => $pos['fitted_date'],
                        'odometer_at_fit' => $pos['odometer_at_fit'],
                        'odometer_at_removal' => $pos['odometer_at_fit'],
                    ]);
                }

                Tyre::find($pos['tyre_id'])->update(['status' => 'mounted']);
            }


            DB::commit();

            return response()->json([
                'message' => 'Tyre movements recorded successfully'
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'message' => 'Failed to process tyre movements',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TyreMovement $tyreMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TyreMovement $tyreMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTyreMovementRequest $request, TyreMovement $tyreMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TyreMovement $tyreMovement)
    {
        //
    }
}
