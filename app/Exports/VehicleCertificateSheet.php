<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class VehicleCertificateSheet implements FromArray, WithHeadings, WithTitle
{
    protected $data;
    protected $title;

    public function __construct($data, $title)
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function array(): array
    {
        return array_map(function ($item) {
            return [
                'Vehicle' => $item['vehicle'],
                'Model' => $item['model'],
                'Category' => $item['category'],
                'Insurance Status' => $item['insurance_status'],
                'Insurance Expiry' => $item['insurance_expiry'],
                'COF Status' => $item['cof_status'],
                'COF Expiry' => $item['cof_expiry'],
            ];
        }, $this->data);
    }

    public function headings(): array
    {
        return [
            'Vehicle',
            'Model',
            'Category',
            'Insurance Status',
            'Insurance Expiry',
            'COF Status',
            'COF Expiry',
        ];
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return $this->title;
    }
}
