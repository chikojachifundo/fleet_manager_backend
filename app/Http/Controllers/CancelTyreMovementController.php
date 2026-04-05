<?php

namespace App\Http\Controllers;

use App\Models\TyreMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CancelTyreMovementController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TyreMovement $tyreMovement)
    {
        DB::beginTransaction();
        $tyreMovement->tyre->update(['status' => 'in_stock']);
        $tyreMovement->update(['status' => 'cancelled']);
        DB::commit();
        return response()->json([
            'message' => 'Tyre movements recorded successfully'
        ], 200);
    }
}
