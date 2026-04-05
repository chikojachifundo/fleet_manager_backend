<?php

namespace App\Http\Controllers;

use App\Models\Tyre;
use App\Models\TyreMovement;
use App\Models\TyreRepair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TyreRepairController extends Controller
{
    public function sendToRepair(Tyre $tyre, Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'repair_date' => 'required|date|before:tomorrow',
            'cost' => 'required|numeric|min:0',
            'repairer_name' => 'nullable|string',
            'repairer_contact' => 'nullable|string',
        ]);

        DB::beginTransaction();
        $tyre->update(['status' => 'in_repair']);
        TyreRepair::create([
            'tyre_id' => $tyre->id,
            'date' => $validated['repair_date'],
            'repair_cost' => $validated['cost'],
            'repairer_name' => $validated['repairer_name'],
            'repairer_contact' => $validated['repairer_contact'],
        ]);
        DB::commit();
        return response()->json([
            'message' => 'Tyre repair recorded successfully'
        ], 200);

    }

    public function acceptFromRepair(Tyre $tyre): \Illuminate\Http\JsonResponse
    {
        $tyre->update(['status' => 'in_stock']);
        return response()->json([
            'message' => 'Tyre repair recorded successfully'
        ], 200);
    }

    public function markScrap(Tyre $tyre)
    {
        DB::beginTransaction();
        $tyre->update(['status' => 'scrapped']);
        TyreMovement::where('tyre_id', $tyre->id)->update(['status' => 'overwritten']);
        DB::commit();
        return response()->json([
            'message' => 'Tyre scrapped successfully'
        ], 200);
    }
}
