<?php

namespace App\Http\Controllers;

use App\Models\VehicleCertificate;
use Illuminate\Http\Request;

class CancelVehicleCertificateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VehicleCertificate $vehicleCertificate)
    {
        $vehicleCertificate->update(['status' => 'cancelled']);
        return response()->json([
            'message' => 'Vehicle certificate cancelled successfully'
        ]);
    }
}
