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
        Schema::create('lubricants', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                'engine_oil',
                'gear_oil',
                'hydraulic_oil',
                'transmission_fluid',
                'brake_fluid',
                'grease',
                'coolant'
            ]);
            $table->string('code')->unique();
            $table->string('brand')->nullable();
            $table->string('name')->unique();
            $table->string('cost_per_litre')->default(1);
            $table->integer('minimum_stock')->nullable();
            $table->decimal('current_stock', 10, 2)->default(0);
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lubricants');
    }
};
