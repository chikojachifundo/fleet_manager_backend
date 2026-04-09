<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fuels')->insert([
            'code' => 'F1',
            'name' => 'Petrol',
            'cost_per_litre' => 6672,
            'description' => 'Gasoline',
        ]);

        DB::table('fuels')->insert([
            'code' => 'F2',
            'name' => 'Diesel',
            'cost_per_litre' => 6687,
            'description' => 'Diesel',
        ]);
    }
}
