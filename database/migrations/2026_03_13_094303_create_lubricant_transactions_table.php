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
        Schema::create('lubricant_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lubricant_id')->constrained('lubricants');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles');
            $table->date('date');
            $table->double('quantity')->default(0);
            $table->double('cost')->default(0);
            $table->enum('type', ['issue', 'purchase', 'adjustment'])->default('out');
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
        Schema::dropIfExists('lubricant_transactions');
    }
};
