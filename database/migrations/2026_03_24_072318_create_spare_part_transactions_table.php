<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spare_part_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('spare_part_id')->constrained('spare_parts');
            $table->foreignId('vehicle_service_id')->constrained('vehicle_services');
            $table->date('date');
            $table->double('quantity');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('description')->nullable();
            $table->foreignId('initiator')->constrained('users');
            $table->foreignId('approver')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_part_transactions');
    }
};
