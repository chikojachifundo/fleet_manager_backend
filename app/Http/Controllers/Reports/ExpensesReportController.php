<?php

namespace App\Http\Controllers\Reports;

use App\Exports\ExpensesReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ExpensesReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        // 🔹 Spare Parts (issued → expense)
        $spares = DB::table('incoming_spare_part_requisitions')
            ->join('spare_parts', 'incoming_spare_part_requisitions.spare_part_id', '=', 'spare_parts.id')
            ->select(
                'incoming_spare_part_requisitions.date as date',
                DB::raw("'Spare Parts Purchase' as category"),
                'incoming_spare_part_requisitions.id as reference',
                DB::raw("CONCAT('Purchase - ', spare_parts.id) as description"),
                DB::raw('CAST(incoming_spare_part_requisitions.value as DECIMAL(15,2)) as amount')
            )
            ->where('incoming_spare_part_requisitions.status', 'approved')
            ->whereNotNull('incoming_spare_part_requisitions.value');


        // 🔹 Tyres Purchase
        $tyres = DB::table('tyres')
            ->select(
                'tyres.purchase_date as date',
                DB::raw("'Tyre Purchase' as category"),
                'tyres.id as reference',
                DB::raw("CONCAT('Tyre purchase - ', tyres.serial_number) as description"),
                'tyres.purchase_cost as amount'
            );

        // 🔹 Lubricants (transactions)
        $lubricants = DB::table('lubricant_transactions')
            ->select(
                'lubricant_transactions.date as date',
                DB::raw("'Lubricants' as category"),
                'lubricant_transactions.id as reference',
                DB::raw("CONCAT('Lubricant issued ID: ', lubricant_transactions.id) as description"),
                DB::raw('lubricant_transactions.quantity * lubricant_transactions.cost as amount')
            );

        // 🔹 Fuel Transactions
        $fuel = DB::table('fuel_transactions')
            ->select(
                'fuel_transactions.date as date',
                DB::raw("'Fuel' as category"),
                'fuel_transactions.id as reference',
                DB::raw("CONCAT('Fuel transaction ID: ', fuel_transactions.id) as description"),
                DB::raw('fuel_transactions.quantity * fuel_transactions.cost_per_litre as amount')
            );

        // 🔹 Vehicle Services
        $services = DB::table('vehicle_services')
            ->select(
                'vehicle_services.date as date',
                DB::raw("'Service' as category"),
                'vehicle_services.id as reference',
                DB::raw("CONCAT('Vehicle service ID: ', vehicle_services.description) as description"),
                'vehicle_services.cost as amount'
            );

        // 🔹 Driver Allowances (Consignments)
        $allowances = DB::table('consignments')
            ->select(
                'consignments.date as date',
                DB::raw("'Driver Allowance' as category"),
                'consignments.id as reference',
                DB::raw("CONCAT('Driver allowance for consignment ID: ', consignments.id) as description"),
                'consignments.drivers_allowance as amount'
            );

        // 🔹 Manual Expenses
        $expenses = DB::table('expenses')
            ->select(
                'expenses.date as date',
                DB::raw("'Other Expenses' as category"),
                'expenses.id as reference',
                'expenses.description',
                'expenses.amount'
            );

        // 🔥 UNION ALL (VERY IMPORTANT)
        $query = $spares
            ->unionAll($tyres)
            ->unionAll($lubricants)
            ->unionAll($fuel)
            ->unionAll($services)
            ->unionAll($allowances)
            ->unionAll($expenses);

        // 🔹 Wrap query for filtering
        $results = DB::query()
            ->fromSub($query, 'expenses')
            ->when($from, fn($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('date', '<=', $to))
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'data' => $results
        ]);
    }

    public function export(Request $request)
    {
        $data = $this->index($request)->getData()->data;

        return Excel::download(
            new ExpensesReportExport($data),
            'expenses_report.xlsx'
        );
    }
}

