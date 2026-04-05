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
        Schema::create('tyre_repairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tyre_id')->constrained('tyres');
            $table->double('repair_cost');
            $table->date('date');
            $table->string('repairer_name')->nullable();
            $table->string('repairer_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tyre_repairs');
    }
};
