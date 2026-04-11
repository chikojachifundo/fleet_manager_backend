<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategorySheet implements FromCollection, WithHeadings, WithTitle, WithStyles, ShouldAutoSize
{
    protected $category;
    protected $rows;

    public function __construct($category, $rows)
    {
        $this->category = $category;
        $this->rows = $rows;
    }

    public function collection()
    {
        return collect($this->rows)->map(function ($row) {
            return [
                'date' => $row->date,
                'reference' => $row->reference,
                'description' => $row->description,
                'amount' => $row->amount,
            ];
        });
    }

    public function headings(): array
    {
        return ['Date', 'Reference', 'Description', 'Amount'];
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return substr($this->category, 0, 31); // Excel limit
    }

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        return [
            // Header row style (row 1)
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '4F81BD', // blue header
                    ],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                ],
            ],
        ];
    }
}
