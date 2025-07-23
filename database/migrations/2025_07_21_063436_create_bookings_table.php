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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Core Booking Info
            $table->unsignedBigInteger('guest_id');
            $table->unsignedBigInteger('room_id');
            $table->enum('booking_type', ['walk-in', 'online']);
            $table->dateTime('check_in');
            $table->dateTime('check_out');

            // Status & Tracking
            $table->enum('status', ['booked', 'checked_in', 'checked_out', 'cancelled'])->default('booked');
          
            // Payment Info
            $table->string('booking_reference')->unique()->nullable();
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('payment_method')->nullable();

            // Additional Info
            $table->text('notes')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();

            // Timestamps
            $table->timestamps();

            // Foreign Keys
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
