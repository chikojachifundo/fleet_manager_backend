<?php

namespace App\Http\Controllers;

use App\Models\Lubricant;
use App\Models\LubricantTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LubricantTransactionActionController extends Controller
{
    public function approve(LubricantTransaction $lubricantTransaction, Request $request)
    {

        if ($request->action == 'approve') {
            DB::transaction(function () use ($lubricantTransaction) {
                $lubricant = Lubricant::lockForUpdate()->find($lubricantTransaction->lubricant_id);

                if (!$lubricant) {
                    abort(404, 'Lubricant not found.');
                }

                // Adjust stock based on transaction type
                if ($lubricantTransaction->type === 'issue') {
                    if ($lubricantTransaction->quantity > $lubricant->current_stock) {
                        abort(422, 'Not enough stock to approve this issue transaction.');
                    }

                    $lubricant->update([
                        'current_stock' => $lubricant->current_stock - $lubricantTransaction->quantity,
                    ]);
                } elseif ($lubricantTransaction->type === 'purchase') {
                    $lubricant->update([
                        'current_stock' => $lubricant->current_stock + $lubricantTransaction->quantity,
                    ]);
                }

                // Approve transaction
                $lubricantTransaction->update(['status' => 'approved']);
            });

        } else {
            $lubricantTransaction->update(['status' => 'rejected']);
        }

        return response()->json([
            'lubricantTransaction' => $lubricantTransaction,
            'message' => 'Transaction processed successfully'
        ]);
    }
}
