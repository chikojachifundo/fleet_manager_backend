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
        Schema::create('tyres', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique();
            $table->string('brand');
            $table->string('model');
            $table->string('size');
            $table->enum('type', ['tube', 'tubeless']);
            $table->string('thread_pattern');
            $table->enum('category', ['steer', 'driver', 'trailer']);
            $table->date('year_of_manufacture')->nullable();
            $table->date('purchase_date');
            $table->double('purchase_cost');
            $table->string('supplier')->nullable();
            $table->string('supplier_contact')->nullable();
            $table->enum('status', ['in_stock', 'mounted', 'in_repair', 'scrapped'])->default('in_stock');
            $table->foreignId('capturer')->constrained('users');
            $table->foreignId('approver')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tyres');
    }
};
