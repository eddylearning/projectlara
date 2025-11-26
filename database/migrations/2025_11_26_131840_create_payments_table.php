<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete(); // link to booking
            $table->decimal('amount', 10, 2); // amount paid
            $table->string('mpesa_transaction_id')->nullable(); // MPESA reference
            $table->string('phone'); // phone number used for payment
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending'); // payment state
            $table->text('response')->nullable(); // raw MPESA callback JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
