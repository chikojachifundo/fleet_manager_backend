<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DriverTemplateExport implements WithHeadings
{


    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'national_id_number',
            'licence_number',
            'passport_number',
            'licence_type',
            'firstname',
            'surname',
            'gender',
            'marital_status',
            'birthdate',
            'email',
            'phone_number',
            'physical_address',
            'home_district',
            'engagement_date',
            'next_of_kin_name',
            'next_of_kin_phone_number',
            'description',
        ];
    }
}
