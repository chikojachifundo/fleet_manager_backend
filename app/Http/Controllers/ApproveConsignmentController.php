<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use Illuminate\Http\Request;

class ApproveConsignmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Consignment $consignment)
    {
        if ($consignment->capturer_id == auth()->id()) {
            return response()->json([
                'message' => 'Sorry, you initiated the transaction, you need another user to approve it.'
            ], 422);
        }
        $consignment->update([
            'status' => 'approved',
            'approver_id' => auth()->id()
        ]);
        return response()->json([
            'message' => 'Consignment approved successfully',
        ]);
    }
}
