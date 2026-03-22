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
        Schema::create('fuel_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fuel_id')->constrained('fuels');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('consignment_id')->nullable()->constrained('consignments');
            $table->date('date');
            $table->double('cost_per_litre');
            $table->double('quantity');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
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
        Schema::dropIfExists('fuel_transactions');
    }
};
