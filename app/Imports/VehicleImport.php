<?php

namespace App\Imports;

use App\Models\Fuel;
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
        $fuel = Fuel::where('name', '=', ucfirst(strtolower($row['fuel'])))->first();
        // TODO: Implement model() method.
        return new Vehicle([
            'registration_number' => $row['registration_number'],
            'engine_number' => $row['engine_number'],
            'chassis_number' => $row['chassis_number'],
            'category' => $row['category'],

            'model' => $row['model'],
            'fuel_id' => $fuel->id,
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
