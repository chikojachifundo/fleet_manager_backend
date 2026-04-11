<?php

namespace App\Exports;

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SummarySheet implements FromArray, WithHeadings, WithStyles, WithEvents, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = collect($data);
    }

    public function headings(): array
    {
        return [
            ['EXPENSE SUMMARY REPORT'],
            ['Category', 'Total Amount'],
        ];
    }

    public function array(): array
    {
        $grouped = $this->data->groupBy('category');

        $rows = [];
        $grandTotal = 0;

        foreach ($grouped as $category => $items) {
            $total = $items->sum('amount');
            $grandTotal += $total;

            $rows[] = [
                $category,
                $total,
            ];
        }

        // grand total row
        $rows[] = [
            'GRAND TOTAL',
            $grandTotal,
        ];

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'color' => ['rgb' => '1F4E79'],
                ],
            ],
            2 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F81BD'],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();

                // Borders
                $sheet->getStyle("A2:{$lastColumn}{$lastRow}")
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ],
                        ],
                    ]);

                // Format currency column
                $sheet->getStyle("B3:B{$lastRow}")
                    ->getNumberFormat()
                    ->setFormatCode('#,##0.00');
            },
        ];
    }
}
