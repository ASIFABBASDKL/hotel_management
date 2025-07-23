<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->enum('payment_method', ['cash', 'card', 'online']);
            $table->decimal('amount_paid', 10, 2);
            $table->dateTime('payment_date')->nullable(); // 👈 Add this line
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->decimal('refund_amount', 10, 2)->nullable();
            $table->string('transaction_reference')->nullable(); // for card/online
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
