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
        $consignment->update(['status' => 'approved']);
        return response()->json([
            'message' => 'Consignment approved successfully',
        ]);
    }
}
