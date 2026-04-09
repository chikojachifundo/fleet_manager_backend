<?php

namespace App\Http\Controllers;

use App\Models\VehicleService;
use Illuminate\Http\Request;

class VehicleServiceActionController extends Controller
{
    public function approve(VehicleService $vehicleService): \Illuminate\Http\JsonResponse
    {
        if ($vehicleService->initiator == auth()->id()) {
            return response()->json([
                'message' => 'Sorry, you initiated the transaction, you need another user to approve it.'
            ], 422);
        }
        $vehicleService->update([
            'status' => 'approved',
            'approver' => auth()->id()
        ]);
        return response()->json([
            'message' => 'Vehicle Service approved successfully',
        ]);
    }

    public function reject(VehicleService $vehicleService): \Illuminate\Http\JsonResponse
    {
        if ($vehicleService->initiator == auth()->id()) {
            return response()->json([
                'message' => 'Sorry, you initiated the transaction, you need another user to approve it.'
            ], 422);
        }
        $vehicleService->update(['status' => 'rejected']);
        return response()->json([
            'message' => 'Vehicle Service rejected successfully',
        ]);
    }
}
