<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SummarySheet implements FromArray, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
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
                'category' => $category,
                'total' => $total,
            ];
        }

        // ✅ Add grand total row
        $rows[] = [
            'category' => 'GRAND TOTAL',
            'total' => $grandTotal,
        ];

        return $rows;
    }

    public function headings(): array
    {
        return ['Category', 'Total Amount'];
    }
}
