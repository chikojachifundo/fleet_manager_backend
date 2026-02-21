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
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_part_code_id')->constrained('spare_part_codes');
            $table->foreignId('store_id')->constrained('stores');
            $table->string('serial_number')->nullable()->unique();
            $table->string('quantity')->nullable()->unique();
            $table->double('value')->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('expiry_date')->nullable()->unique();
            $table->enum('status', ['available', 'unavailable', 'damaged', 'expired'])->nullable()->default('available');
            $table->string('supplier')->nullable();
            $table->string('supplier_contact')->nullable();
            $table->foreignId('captured_by')->constrained('users');
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_parts');
    }
};
