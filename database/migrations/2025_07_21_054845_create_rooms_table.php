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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->integer('floor_number')->nullable(); // New: Floor number
            $table->enum('type', ['Single', 'Deluxe', 'Suite']);
            $table->decimal('price', 10, 2);
            $table->json('amenities')->nullable(); // e.g. ["WiFi", "TV", "AC"]
            $table->integer('occupancy_limit');
            $table->enum('status', ['available', 'occupied', 'maintenance'])->default('available');
            $table->string('image')->nullable(); // Optional room image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
