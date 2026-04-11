<?php

namespace App\Http\Controllers;

use App\Models\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleServiceActionController extends Controller
{
    public function approve(VehicleService $vehicleService): \Illuminate\Http\JsonResponse
    {
        if ($vehicleService->initiator == auth()->id()) {
            return response()->json([
                'message' => 'Sorry, you initiated the transaction, you need another user to approve it.'
            ], 422);
        }

        // ✅ Prevent double approval
        if ($vehicleService->status === 'approved') {
            return response()->json([
                'message' => 'This service is already approved.'
            ], 422);
        }


        DB::beginTransaction();

        try {

            foreach ($vehicleService->sparePartTransactions as $transaction) {

                // 🔒 Lock row for update (prevents race condition)
                $sparePart = $transaction->sparePart()->lockForUpdate()->first();

                if (!$sparePart) {
                    throw new \Exception("Spare part not found");
                }

                if ($sparePart->quantity < $transaction->quantity) {
                    DB::rollBack();
                    return response()->json([
                        'message' => "Insufficient stock for {$sparePart->code->name}"
                    ], 422);
                }

                $sparePart->decrement('quantity', $transaction->quantity);
            }

            $vehicleService->update([
                'status' => 'approved',
                'approver' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Vehicle Service approved successfully',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Failed to approve service',
                'error' => $e->getMessage()
            ], 500);
        }
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
