<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehicleTemplateExport implements WithHeadings
{

    public function headings(): array
    {
        // TODO: Implement headings() method.

        return [
          'registration_number',
          'engine_number',
          'chassis_number',
          'model',
          'category',
          'year_of_manufacture',
          'fuel',
          'mileage',
          'description',
        ];
    }
}
