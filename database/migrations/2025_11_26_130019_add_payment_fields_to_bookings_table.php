<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFieldsToBookingsTable extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            // Add number of days
            if (!Schema::hasColumn('bookings', 'days')) {
                $table->integer('days')->nullable()->after('end_date');
            }

            // Add total amount
            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->nullable()->after('days');
            }

            // Add payment_status (only if not already there)
            if (!Schema::hasColumn('bookings', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'paid', 'failed'])
                      ->default('pending')
                      ->after('total_amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            if (Schema::hasColumn('bookings', 'days')) {
                $table->dropColumn('days');
            }

            if (Schema::hasColumn('bookings', 'total_amount')) {
                $table->dropColumn('total_amount');
            }

            if (Schema::hasColumn('bookings', 'payment_status')) {
                $table->dropColumn('payment_status');
            }
        });
    }
}
