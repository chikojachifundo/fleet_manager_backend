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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('engine_number')->unique();
            $table->string('chassis_number')->nullable()->unique();
            $table->string('model')->nullable();
            $table->enum('category', ['horse', 'trailer', 'saloon', 'tipper', 'other'])->default('other');
            $table->date('year_of_manufacture')->nullable();
            $table->enum('fuel', ['diesel', 'petrol', 'electric'])->default('diesel');
            $table->double('mileage')->default(0);
            $table->enum('status', ['active', 'inactive', 'written-off'])->default('active');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
