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
        Schema::create('consignments', function (Blueprint $table) {
            $table->id();
            $table->enum('model', ['fixed', 'horse-trailer', 'horse-trailer-trailer']);
            $table->string('description')->nullable();
            $table->foreignId('driver_id')->constrained('drivers');
            $table->foreignId('horse_id')->nullable()->constrained('vehicles');
            $table->foreignId('first_trailer_id')->nullable()->constrained('vehicles');
            $table->foreignId('second_trailer_id')->nullable()->constrained('vehicles');
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles');
            $table->foreignId('consignment_route_id')->constrained('consignment_routes');
            $table->date('date');
            $table->double('mileage')->default(0);
            $table->double('first_weight')->default(0);
            $table->double('second_weight')->default(0);
            $table->double('drivers_allowance')->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('capturer_id')->constrained('users');
            $table->foreignId('approver_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignments');
    }
};
