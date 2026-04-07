<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ConsignmentsExport;
use App\Http\Controllers\Controller;
use App\Models\Consignment;
use App\Services\ConsignmentReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ConsignmentsReportController extends Controller
{

    public function generate(Request $request, ConsignmentReportService $service)
    {
        $validated = $request->validate([
            'from_date' => 'nullable|date|before_or_equal:today',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        return response()->json(
            $service->generate($validated)
        );
    }

    public function exportExcel(Request $request, ConsignmentReportService $service)
    {
        $validated = $request->validate([
            'from_date' => 'nullable|date|before_or_equal:today',
            'to_date' => 'nullable|date|after_or_equal:from_date',
        ]);

        $data = $service->generate($validated);

        return Excel::download(
            new ConsignmentsExport($data['data'], $data['totals']),
            'consignments.xlsx'
        );
    }

    public function exportPDF(Request $request, ConsignmentReportService $service)
    {
        $data = $service->generate($request->all());

        $pdf = Pdf::loadView('reports.consignments', $data);

        return $pdf->download('consignments.pdf');
    }
}
