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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();

            $table->enum('id_type', ['CNIC', 'Passport', 'Driving License'])->nullable();
            $table->string('id_document_path')->nullable(); // Upload path for ID card/passport etc.
            $table->string('profile_image')->nullable();     // Optional profile photo
            $table->string('emergency_contact')->nullable(); // Emergency contact number
            $table->text('notes')->nullable();               // Internal notes about guest

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
