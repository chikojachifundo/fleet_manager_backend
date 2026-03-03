<?php

namespace App\Http\Controllers;

use App\Models\IncomingSparePartRequisition;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Http\Request;

class StoresDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response([
            'pendingIncoming' => IncomingSparePartRequisition::where('status', 'pending')->count(),
            'totalSpares' => SparePart::count(),
            'users' => User::count(),
            'outgoing'=>2,
        ]);
    }
}
