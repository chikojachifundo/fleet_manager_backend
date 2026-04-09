<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\Consignment;
use App\Models\ConsignmentRoute;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function getStatistics()
    {
        $data = [
            'vehicles' => [
                'horses' => Vehicle::where('category', 'horse')->count(),
                'trailers' => Vehicle::where('category', 'trailer')->count(),
                'saloon' => Vehicle::where('category', 'saloon')->count(),
                'tippers' => Vehicle::where('category', 'tipper')->count(),
                'others' => Vehicle::where('category', 'other')->count(),
                'total' => Vehicle::count(),
            ],

            'drivers' => Driver::count(),
            'consignments' => [
                'pending' => Consignment::where('status', 'pending')->count(),
                'approved' => Consignment::where('status', 'approved')->count(),
                'total' => Consignment::count(),
            ],
            'users' => [
                'admins' => User::where('group', 'admins')->count(),
                'stores' => User::where('group', 'stores')->count(),
                'lubricants' => User::where('group', 'lubricants')->count(),
                'operations' => User::where('group', 'operations')->count(),
                'drivers' => User::where('group', 'drivers')->count(),
                'managers' => User::where('group', 'managers')->count(),
            ],
            'consignmentRoutes' => ConsignmentRoute::count(),
        ];

        return response()->json($data);
    }
}
