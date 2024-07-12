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
        Schema::table('scheduled_searches', function (Blueprint $table) {
            // Change the data type of customer_id column
            $table->unsignedBigInteger('customer_id')->change();

            // Add the foreign key constraint
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheduled_searches', function (Blueprint $table) {
            //
        });
    }
};
