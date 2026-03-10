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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('national_id_number')->unique();
            $table->string('licence_number')->unique();
            $table->string('passport_number')->nullable()->unique();
            $table->string('licence_type');
            $table->string('firstname');
            $table->string('surname');
            $table->enum('gender', ['F', 'M']);
            $table->enum('marital_status', ['Single', 'Married', 'Widowed']);
            $table->date('birthdate')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('home_district')->nullable();
            $table->date('engagement_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'retired', 'expelled', 'resigned','suspended'])->default('Active');
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_phone_number')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
