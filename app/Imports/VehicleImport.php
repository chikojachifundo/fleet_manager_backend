<?php

namespace App\Imports;

use App\Models\Vehicle;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class VehicleImport implements ToModel, WithHeadingRow, WithValidation
{


    public function model(array $row)
    {
        // TODO: Implement model() method.
        return new Vehicle([
            'registration_number' => $row['registration_number'],
            'engine_number' => $row['engine_number'],
            'chassis_number' => $row['chassis_number'],
            'category' => $row['category'],
            'year_of_manufacture' => is_numeric($row['year_of_manufacture'])
                ? Date::excelToDateTimeObject($row['year_of_manufacture'])->format('Y-m-d')
                : $row['year_of_manufacture'],
            'model' => $row['model'],
            'fuel' => $row['fuel'],
            'mileage' => $row['mileage'],
            'description' => $row['description'],
        ]);
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            '*.registration_number' => 'required',
            '*.engine_number' => 'required',
            '*.category' => 'required',
            '*.fuel' => 'required',
            '*.mileage' => 'required',
            '*.year_of_manufacture' => 'required',
            '*.model' => 'required',
        ];
    }
}
