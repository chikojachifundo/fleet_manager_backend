<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tyre_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tyre_id')->constrained('tyres');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('tyre_position_id')->constrained('tyre_positions');
            $table->date('fitted_date');
            $table->date('removed_date')->nullable();
            $table->double('odometer_at_fit');
            $table->double('odometer_at_removal');
            $table->enum('status', ['active', 'overwritten','cancelled'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tyre_movements');
    }
};
