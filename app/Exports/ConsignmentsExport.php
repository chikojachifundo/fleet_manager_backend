<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConsignmentsExport implements FromArray, WithHeadings, WithStyles, WithEvents
{
    protected $consignments;
    protected $totals;

    public function __construct(Collection $consignments, array $totals)
    {
        $this->consignments = $consignments;
        $this->totals = $totals;
    }

    public function array(): array
    {
        $data = $this->consignments->toArray();

        // Append totals row
        $data[] = [
            'Totals', // first column
            '', '', '', '', '', '', '', '', '', '',
            $this->totals['driver'],          // driver_allowance total
            $this->totals['fuel'],            // fuel_total
            $this->totals['servicing'],       // servicing_total
            $this->totals['road_charges'],    // road_charges_total
            $this->totals['tollgate'],        // tollgate_charges_total (optional)
            $this->totals['lubricants'],      // lubricants (optional)
            $this->totals['other_expenses'],  // other_expenses_total (optional)
            $this->totals['grand_total'],    // total_cost
        ];

        return $data;
    }

    public function headings(): array
    {
        return [
            'code',
            'date',
            'model',
            'route',
            'horse',
            'vehicle',
            'vehicle_model',
            'first_trailer',
            'second_trailer',
            'driver_national_id',
            'driver',
            'driver_allowance',
            'fuel_total',
            'servicing_total',
            'road_charges_total',
            'tollgate_charges_total',
            'lubricants_cost',
            'other_expenses_total',
            'total_cost',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header styling
        $sheet->getStyle('A1:S1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF1976D2']],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);

        // Add borders to all cells
        $lastRow = count($this->consignments) + 2; // +1 header +1 totals
        $sheet->getStyle("A1:S{$lastRow}")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = count($this->consignments) + 2; // header + data + totals

                // Bold totals row and highlight
                $sheet->getStyle("A{$lastRow}:S{$lastRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'FFE0E0E0']],
                ]);
            },
        ];
    }
}
