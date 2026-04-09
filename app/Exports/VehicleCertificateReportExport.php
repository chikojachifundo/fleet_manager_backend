<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class VehicleCertificateReportExport implements WithMultipleSheets
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        // TODO: Implement sheets() method.
        $types = ['horse', 'trailer', 'saloon', 'tipper', 'other'];

        $sheets = [];

        foreach ($types as $type) {
            $filtered = array_filter($this->data, function ($item) use ($type) {
                return strtolower($item['category']) === $type;
            });

            $sheets[] = new VehicleCertificateSheet($filtered, ucfirst($type));
        }

        return $sheets;
    }
}
