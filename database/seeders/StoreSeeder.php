<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stores')->insert([
            'name' => 'Blantyre main stores office',
            'code' => 'BT-main',
            'location' => 'Blantyre',
            'stores_manager' => 'Mr Japhet',
            'stores.stores_manager_phone_number' => '0888271862',
            'status' => 'open',
            'description' => 'Blantyre main stores office at the head office',
        ]);

        DB::table('stores')->insert([
            'name' => 'Blantyre MD`s stores office',
            'code' => 'BT-MD-STORES',
            'location' => 'Blantyre',
            'stores_manager' => 'Mr Japhet',
            'stores.stores_manager_phone_number' => '0888271862',
            'status' => 'open',
            'description' => 'Blantyre main stores office at the head office',
        ]);

        DB::table('stores')->insert([
            'name' => 'Mangochi main stores office',
            'code' => 'MHG-main',
            'location' => 'Mangochi',
            'stores_manager' => 'Mr Japhet',
            'stores.stores_manager_phone_number' => '0888271862',
            'status' => 'open',
            'description' => 'Blantyre main stores office at the head office',
        ]);
    }
}
