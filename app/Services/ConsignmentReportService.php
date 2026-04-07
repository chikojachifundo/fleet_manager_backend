<?php

namespace App\Services;

use App\Models\Consignment;

class ConsignmentReportService
{
    public function generate($filters)
    {
        $query = Consignment::with([
            'driver',
            'vehicle',
            'firstTrailer',
            'secondTrailer',
            'consignmentRoute',
            'fuelTransactions',
            'vehicleServices',
            'expenses',
        ]);

        if (!empty($filters['from_date'])) {
            $query->whereDate('date', '>=', $filters['from_date']);
        }

        if (!empty($filters['to_date'])) {
            $query->whereDate('date', '<=', $filters['to_date']);
        }

        $consignments = $query->get();

        $data = $consignments->map(function ($c) {
            $fuelTotal = $c->fuelTransactions->sum('total_cost');
            $servicingTotal = $c->vehicleServices->sum('cost');
            $roadCharges = $c->expenses->where('category', 'road-charge')->sum('amount');
            $tollgateCharges = $c->expenses->where('category', 'toll-gate')->sum('amount');
            $otherExpenses = $c->expenses->where('category', 'others')->sum('amount');
            $driverAllowance = $c->drivers_allowance ?? 0;

            $totalCost = $driverAllowance + $fuelTotal + $servicingTotal + $roadCharges + $tollgateCharges + $otherExpenses;

            return [
                'code' => $c->id,
                'date' => $c->date,
                'model' => $c->model,
                'route' => $c->consignmentRoute?->code,
                'horse' => $c->horse?->registration_number,
                'vehicle' => $c->vehicle?->registration_number,
                'vehicle_model' => $c->vehicle?->registration_number,
                'first_trailer' => $c->firstTrailer?->registration_number,
                'second_trailer' => $c->secondTrailer?->registration_number,
                'driver_national_id' => $c->driver?->national_id_number,
                'driver' => $c->driver?->full_name,
                'driver_allowance' => $driverAllowance,
                'fuel_total' => $fuelTotal,
                'servicing_total' => $servicingTotal,
                'road_charges_total' => $roadCharges,
                'tollgate_charges_total' => $tollgateCharges,
                'other_expenses_total' => $otherExpenses,
                'total_cost' => $totalCost,
            ];
        });

        $totals = [
            'driver' => $data->sum('driver_allowance'),
            'fuel' => $data->sum('fuel_total'),
            'servicing' => $data->sum('servicing_total'),
            'road' => $data->sum('road_charges_total'),
            'grand_total' => $data->sum('total_cost'),
        ];

        return compact('data', 'totals');
    }
}
