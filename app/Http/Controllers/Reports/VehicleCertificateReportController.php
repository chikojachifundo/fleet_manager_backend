<?php

namespace App\Http\Controllers\Reports;

use App\Exports\VehicleCertificateReportExport;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VehicleCertificateReportController extends Controller
{
    public function vehicleCertificates(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $this->vehicleCertificateReport()
        ]);
    }

    public function exportVehicleCertificates()
    {
        $data = $this->vehicleCertificateReport();
        return Excel::download(
            new VehicleCertificateReportExport($data),
            'vehicle-certificates-report.xlsx'
        );
    }

    public function vehicleCertificateReport(): array
    {
        $today = Carbon::today();
        $in7Days = Carbon::today()->addDays(7);
        $in1Month = Carbon::today()->addMonth();
        $in2Months = Carbon::today()->addMonths(2);

        $vehicles = Vehicle::with(['certificates' => function ($q) {
            $q->where('status', '!=', 'cancelled')
                ->latest();
        }])->get();

        $report = [];

        foreach ($vehicles as $vehicle) {

            $insurance = $vehicle->certificates
                ->where('type', 'insurance')
                ->sortByDesc('expiry_date')
                ->first();

            $cof = $vehicle->certificates
                ->where('type', 'cof')
                ->sortByDesc('expiry_date')
                ->first();

            $report[] = [
                'vehicle' => $vehicle->registration_number,
                'model' => $vehicle->model,
                'category' => $vehicle->category,
                'insurance_status' => $this->getStatus($insurance?->expiry_date),
                'cof_status' => $this->getStatus($cof?->expiry_date),
                'insurance_expiry' => $insurance?->expiry_date,
                'cof_expiry' => $cof?->expiry_date,
            ];
        }
        return $report;
    }


    private function getStatus($expiryDate)
    {
        if (!$expiryDate) return 'missing';

        $today = now();
        $expiry = Carbon::parse($expiryDate);

        if ($expiry->isToday()) return 'today';
        if ($expiry->lt($today)) return 'expired';
        if ($expiry->lte($today->copy()->addDays(7))) return 'this_week';
        if ($expiry->lte($today->copy()->addMonth())) return 'one_month';
        if ($expiry->lte($today->copy()->addMonths(2))) return 'two_months';

        return 'valid';
    }
}
