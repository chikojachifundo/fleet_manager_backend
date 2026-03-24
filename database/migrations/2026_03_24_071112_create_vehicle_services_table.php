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
        Schema::create('vehicle_services', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('consignment_id')->nullable()->constrained('consignments');
            $table->date('date');
            $table->double('cost')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('contractor')->nullable();
            $table->string('contractor_contact')->nullable();
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
        Schema::dropIfExists('vehicle_services');
    }
};
