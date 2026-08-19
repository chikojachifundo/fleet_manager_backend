<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Change the `fuels.name` column from a fixed enum to a string so that
     * new fuel types can be added from the UI.
     */
    public function up(): void
    {
        // The existing unique index (`fuels_name_unique`) is preserved by MySQL.
        DB::statement("ALTER TABLE fuels MODIFY name VARCHAR(255) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE fuels MODIFY name ENUM('Petrol','Diesel') NOT NULL");
    }
};
