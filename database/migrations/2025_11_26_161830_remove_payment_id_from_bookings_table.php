<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaymentIdFromBookingsTable extends Migration
{
   public function up(): void
{
    Schema::table('bookings', function (Blueprint $table) {

        if (Schema::hasColumn('bookings', 'payment_id')) {

            // Check foreign key exists before dropping
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_NAME = 'bookings'
                AND COLUMN_NAME = 'payment_id';
            ");

            if (!empty($foreignKeys)) {
                $constraint = $foreignKeys[0]->CONSTRAINT_NAME;
                DB::statement("ALTER TABLE bookings DROP FOREIGN KEY $constraint");
            }

            // Now drop the column safely
            $table->dropColumn('payment_id');
        }
    });
}


    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('payment_id')
                ->nullable()
                ->constrained('payments')
                ->onDelete('set null');
        });
    }
}
