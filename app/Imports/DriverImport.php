<?php

namespace App\Imports;

use App\Models\Driver;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DriverImport implements ToCollection, WithHeadingRow, WithValidation
{

    public function collection(Collection $rows)
    {

        DB::transaction(function () use ($rows) {

            foreach ($rows as $row) {

//                Log::info($row);

                $birthdate = null;

                if (is_numeric($row['birthdate'])) {
                    $birthdate = Date::excelToDateTimeObject($row['birthdate'])
                        ->format('Y-m-d');
                } elseif (!empty($row['birthdate'])) {
                    $birthdate = Carbon::createFromFormat('d/m/Y', trim($row['birthdate']))
                        ->format('Y-m-d');
                }


                $engagementDate = null;
                if (is_numeric($row['engagement_date'])) {
                    $engagementDate = Date::excelToDateTimeObject($row['engagement_date'])
                        ->format('Y-m-d');
                } elseif (!empty($row['engagement_date'])) {
                    $engagementDate = Carbon::createFromFormat('d/m/Y', trim($row['engagement_date']))
                        ->format('Y-m-d');
                }

//                Log::info($birthdate);
//                Log::info($engagementDate);
                /*
                 |------------------------------------------
                 | 1. Create User
                 |------------------------------------------
                 */

                $user = User::create([
                    'name' => $row['firstname'].' '.$row['surname'],
                    'email' => $row['email'],
                    'password' => Hash::make('password123'), // default password
                    'status' => 'active',
                    'group'=>'drivers'
                ]);


                /*
                 |------------------------------------------
                 | 2. Create Driver
                 |------------------------------------------
                 */

                $gender = null;
                if (strtolower($row['gender']) == 'male' ) {
                    $gender = 'M';
                }elseif (strtolower($row['gender']) == 'female') {
                    $gender = 'F';
                }

                Driver::create([
                    'user_id' => $user->id,
                    'national_id_number' => $row['national_id_number'],
                    'licence_number' => $row['licence_number'],
                    'passport_number' => $row['passport_number'],
                    'licence_type' => $row['licence_type'],
                    'firstname' => $row['firstname'],
                    'surname' => $row['surname'],
                    'gender' => $gender,
                    'marital_status' => $row['marital_status'],
                    'birthdate' => $birthdate,
                    'engagement_date' => $engagementDate,
                    'email' => $row['email'],
                    'phone_number' => $row['phone_number'],
                    'physical_address' => $row['physical_address'],
                    'home_district' => $row['home_district'],
                    'next_of_kin_name' => $row['next_of_kin_name'],
                    'next_of_kin_phone_number' => $row['next_of_kin_phone_number'],
                    'description' => $row['description'],
                ]);

            }

        });

    }

    public function rules(): array
    {
        // TODO: Implement rules() method.

        return [
            '*.national_id_number' => 'required|unique:drivers,national_id_number',
            '*.licence_number' => 'required|unique:drivers,licence_number',
            '*.licence_type' => 'required',
            '*.firstname' => 'required',
            '*.surname' => 'required',
            '*.gender' => 'required',
            '*.marital_status' => 'required',
            '*.birthdate' => 'required',
            '*.email' => 'required|unique:drivers,email',
            '*.phone_number' => 'required',
            '*.engagement_date' => 'required',
            '*.next_of_kin_name' => 'required',
            '*.next_of_kin_phone_number' => 'required',

        ];
    }
}
