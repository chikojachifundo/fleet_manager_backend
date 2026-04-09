<?php

namespace App\Imports;

use App\Models\Tyre;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TyreImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {

            foreach ($rows as $row) {

                /*
                 |------------------------------------------
                 | Handle Excel Date
                 |------------------------------------------
                 */
                $purchaseDate = is_numeric($row['purchase_date'])
                    ? Date::excelToDateTimeObject($row['purchase_date'])->format('Y-m-d')
                    : $row['purchase_date'];

                $yearOfManufacture = is_numeric($row['year_of_manufacture'])
                    ? Date::excelToDateTimeObject($row['year_of_manufacture'])->format('Y-m-d')
                    : $row['year_of_manufacture'];

                /*
                 |------------------------------------------
                 | Create Tyre
                 |------------------------------------------
                 */
                Tyre::create([
                    'serial_number' => $row['serial_number'],
                    'brand' => $row['brand'],
                    'model' => $row['model'],
                    'size' => $row['size'],
                    'type' => strtolower($row['type']),
                    'thread_pattern' => $row['thread_pattern'],
                    'category' => strtolower($row['category']),
                    'purchase_date' => $purchaseDate,
                    'purchase_cost' => $row['purchase_cost'],

                    'supplier' => $row['supplier'] ?? null,
                    'supplier_contact' => $row['supplier_contact'] ?? null,

                    'status' => $row['status'] ?? 'in_stock',

                    // Optional field (not in your original table but requested)
                    'year_of_manufacture' => $yearOfManufacture ?? null,

                    // Required FK (ensure it's in template)
                    'capturer' => auth()->id(),
                ]);
            }
        });
    }

    public function rules(): array
    {
        return [
            '*.serial_number' => 'required|string|max:255|unique:tyres,serial_number',
            '*.brand' => 'required|string|max:255',
            '*.model' => 'required|string|max:255',
            '*.size' => 'required',

            '*.type' => 'required|in:tube,Tube,tubeless,Tubeless',

            '*.thread_pattern' => 'required|string|max:255',

            '*.category' => 'required|in:steer,Steer,driver,Driver,trailer,Trailer',

            '*.purchase_date' => 'required',

            '*.purchase_cost' => 'required|numeric|min:0',

            '*.supplier' => 'nullable|string|max:255',
            '*.supplier_contact' => 'nullable|string|max:255',

            '*.status' => 'nullable|in:in_stock,mounted,in_repair,scrapped',
            '*.year_of_manufacture' => 'nullable',
        ];
    }
}
