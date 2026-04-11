<?php

namespace App\Exports;

use App\Exports\CategorySheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\SummarySheet;
use Maatwebsite\Excel\Events\AfterSheet;

class ExpensesReportExport implements WithMultipleSheets, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = collect($data);
    }

    public function sheets(): array
    {
        $sheets = [];

        // ✅ Summary Sheet FIRST
        $sheets[] = new SummarySheet($this->data);

        // ✅ Group by category
        $grouped = $this->data->groupBy('category');

        foreach ($grouped as $category => $rows) {
            $sheets[] = new CategorySheet($category, $rows);
        }

        return $sheets;
    }

    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Get last row dynamically
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();

                $range = "A1:{$lastColumn}{$lastRow}";

                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
            },
        ];
    }
}
