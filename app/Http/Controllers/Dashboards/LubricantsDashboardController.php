<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\Lubricant;
use App\Models\LubricantTransaction;
use Illuminate\Http\Request;

class LubricantsDashboardController extends Controller
{
    public function counters()
    {
        $data = [
            'totalStock' => Lubricant::sum('current_stock'),
            'pendingPurchases' => LubricantTransaction::where('type', 'purchase')->where('status', 'pending')->count(),
            'pendingIssues' => LubricantTransaction::where('type', 'issue')->where('status', 'pending')->count(),
            'ApprovedIssues' => LubricantTransaction::where('type', 'issue')->where('status', 'approved')->count(),
            'approvedPurchases' => LubricantTransaction::where('type', 'purchase')->where('status', 'approved')->count(),
        ];

        return response()->json($data);
    }
}
