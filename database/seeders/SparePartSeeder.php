<?php

namespace Database\Seeders;

use App\Models\SparePartCode;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SparePartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spare_parts')->insert([
            'spare_part_code_id' => SparePartCode::first()->id,
            'store_id' => Store::first()->id,
            'serial_number' => "76243846",
            'quantity' => 30,
            'value' => 9000000,
            'purchase_date' => now(),
            'expiry_date' => now()->addYear(),
            'status' => 'available',
            'supplier' => 'K Motors',
            'supplier_contact' => '0995388776',
            'captured_by' => User::first()->id,
        ]);
    }
}
