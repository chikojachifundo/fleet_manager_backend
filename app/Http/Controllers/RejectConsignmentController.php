<?php

namespace App\Http\Controllers;

use App\Models\Consignment;
use Illuminate\Http\Request;

class RejectConsignmentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Consignment $consignment)
    {
        $consignment->update(['status' => "rejected"]);
        return response()->json([
            'message' => 'Consignment rejected successfully',
        ]);
    }
}
