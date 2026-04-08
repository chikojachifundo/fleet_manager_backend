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
        Schema::create('vehicle_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->enum('type', ['insurance', 'cof']);
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->double('total_cost');
            $table->enum('insurance_type', ['comprehensive', 'third-party'])->nullable();
            $table->string('insurance_number')->nullable();
            $table->string('insurance_company')->nullable();
            $table->string('insurance_company_address')->nullable();
            $table->string('insurance_company_telephone')->nullable();
            $table->enum('status', ['valid', 'expired', 'cancelled'])->default('valid');
            $table->foreignId('capturer')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_certificates');
    }
};
