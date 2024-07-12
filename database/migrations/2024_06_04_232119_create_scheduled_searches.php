<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scheduled_searches', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('query');
            $table->string('frequency');
            $table->json('schedule_times');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scheduled_searches');
    }
};
