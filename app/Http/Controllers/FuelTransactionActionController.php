<?php

namespace App\Http\Controllers;

use App\Models\FuelTransaction;
use Illuminate\Http\Request;

class FuelTransactionActionController extends Controller
{
    public function process(FuelTransaction $fuelTransaction, Request $request): \Illuminate\Http\JsonResponse
    {

        if ($request->action == 'approve')
            $fuelTransaction->update(['status' => 'approved']);
        else
            $fuelTransaction->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Transaction approved',
        ]);
    }
}
