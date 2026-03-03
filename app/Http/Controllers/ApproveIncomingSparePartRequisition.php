<?php

namespace App\Http\Controllers;

use App\Models\IncomingSparePartRequisition;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApproveIncomingSparePartRequisition extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        foreach ($request->ids as $id) {
            DB::transaction(function () use ($id) {
                $requisition = IncomingSparePartRequisition::find($id);
                $sparePart = $requisition->sparePart;

                $sparePart->update([
                    'quantity' => $sparePart->quantity + $requisition->quantity
                ]);
                $requisition->update([
                    'status' => 'approved'
                ]);
            });
        }
        return response()->json([
            'message' => 'Incoming Spare Part Requisition Approved',
        ], 201);
    }
}
