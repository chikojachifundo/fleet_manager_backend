<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SparePartCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spare_part_codes')->insert([
            'name' => 'Spark Plugs',
            'code' => 'SP100',
            'model' => 'Bosch',
            'manufacturer' => 'Volkswagen',
            'description' => 'Original spark plugs from Germany',
        ]);
    }
}
