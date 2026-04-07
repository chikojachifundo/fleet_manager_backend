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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consignment_id')->nullable()->constrained('consignments');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles');
            $table->string('description');
            $table->float('amount');
            $table->date('date');
            $table->enum('category', ['road-charge', 'insurance', 'cof', 'capex', 'opex', 'others', 'toll-gate']);
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
        Schema::dropIfExists('expenses');
    }
};
