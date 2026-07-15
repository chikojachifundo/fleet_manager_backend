<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Cyrus',
                'email' => 'thindwacyrus86@gmail.com',
                'password' => bcrypt('password'),
                'group' => 'admins',
                'status' => 'active',
            ],
            [
                'name' => 'Administrator',
                'email' => 'chifundochikoja@yahoo.com',
                'password' => bcrypt('Fleet@2026'),
                'group' => 'admins',
                'status' => 'active',
            ],
        ]);
    }
}
