<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TyrePositionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tyre_positions')->insert([

            // =========================
            // 🚗 SALOON
            // =========================
            ['code' => 'FL', 'name' => 'Front Left', 'vehicle_type' => 'saloon', 'axle_number' => 1, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'FR', 'name' => 'Front Right', 'vehicle_type' => 'saloon', 'axle_number' => 1, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'RL', 'name' => 'Rear Left', 'vehicle_type' => 'saloon', 'axle_number' => 2, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'RR', 'name' => 'Rear Right', 'vehicle_type' => 'saloon', 'axle_number' => 2, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],


            // =========================
            // 🚛 HORSE
            // =========================
            ['code' => 'H-FL', 'name' => 'Front Left', 'vehicle_type' => 'horse', 'axle_number' => 1, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'H-FR', 'name' => 'Front Right', 'vehicle_type' => 'horse', 'axle_number' => 1, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],

            ['code' => 'H-RL1', 'name' => 'Rear Left Outer', 'vehicle_type' => 'horse', 'axle_number' => 2, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'H-RL2', 'name' => 'Rear Left Inner', 'vehicle_type' => 'horse', 'axle_number' => 2, 'side' => 'left', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],

            ['code' => 'H-RR1', 'name' => 'Rear Right Outer', 'vehicle_type' => 'horse', 'axle_number' => 2, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'H-RR2', 'name' => 'Rear Right Inner', 'vehicle_type' => 'horse', 'axle_number' => 2, 'side' => 'right', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],


            // =========================
            // 🚚 TRAILER (3 AXLES)
            // =========================
            ['code' => 'T-A1L1', 'name' => 'Axle 1 Left Outer', 'vehicle_type' => 'trailer', 'axle_number' => 1, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A1L2', 'name' => 'Axle 1 Left Inner', 'vehicle_type' => 'trailer', 'axle_number' => 1, 'side' => 'left', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A1R1', 'name' => 'Axle 1 Right Outer', 'vehicle_type' => 'trailer', 'axle_number' => 1, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A1R2', 'name' => 'Axle 1 Right Inner', 'vehicle_type' => 'trailer', 'axle_number' => 1, 'side' => 'right', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],

            ['code' => 'T-A2L1', 'name' => 'Axle 2 Left Outer', 'vehicle_type' => 'trailer', 'axle_number' => 2, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A2L2', 'name' => 'Axle 2 Left Inner', 'vehicle_type' => 'trailer', 'axle_number' => 2, 'side' => 'left', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A2R1', 'name' => 'Axle 2 Right Outer', 'vehicle_type' => 'trailer', 'axle_number' => 2, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A2R2', 'name' => 'Axle 2 Right Inner', 'vehicle_type' => 'trailer', 'axle_number' => 2, 'side' => 'right', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],

            ['code' => 'T-A3L1', 'name' => 'Axle 3 Left Outer', 'vehicle_type' => 'trailer', 'axle_number' => 3, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A3L2', 'name' => 'Axle 3 Left Inner', 'vehicle_type' => 'trailer', 'axle_number' => 3, 'side' => 'left', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A3R1', 'name' => 'Axle 3 Right Outer', 'vehicle_type' => 'trailer', 'axle_number' => 3, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'T-A3R2', 'name' => 'Axle 3 Right Inner', 'vehicle_type' => 'trailer', 'axle_number' => 3, 'side' => 'right', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],


            // =========================
            // 🚜 TIPPER
            // =========================
            ['code' => 'TP-FL', 'name' => 'Front Left', 'vehicle_type' => 'tipper', 'axle_number' => 1, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'TP-FR', 'name' => 'Front Right', 'vehicle_type' => 'tipper', 'axle_number' => 1, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],

            ['code' => 'TP-A2L1', 'name' => 'Axle 2 Left Outer', 'vehicle_type' => 'tipper', 'axle_number' => 2, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'TP-A2L2', 'name' => 'Axle 2 Left Inner', 'vehicle_type' => 'tipper', 'axle_number' => 2, 'side' => 'left', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'TP-A2R1', 'name' => 'Axle 2 Right Outer', 'vehicle_type' => 'tipper', 'axle_number' => 2, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'TP-A2R2', 'name' => 'Axle 2 Right Inner', 'vehicle_type' => 'tipper', 'axle_number' => 2, 'side' => 'right', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],

            ['code' => 'TP-A3L1', 'name' => 'Axle 3 Left Outer', 'vehicle_type' => 'tipper', 'axle_number' => 3, 'side' => 'left', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'TP-A3L2', 'name' => 'Axle 3 Left Inner', 'vehicle_type' => 'tipper', 'axle_number' => 3, 'side' => 'left', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'TP-A3R1', 'name' => 'Axle 3 Right Outer', 'vehicle_type' => 'tipper', 'axle_number' => 3, 'side' => 'right', 'position_index' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'TP-A3R2', 'name' => 'Axle 3 Right Inner', 'vehicle_type' => 'tipper', 'axle_number' => 3, 'side' => 'right', 'position_index' => '2', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
