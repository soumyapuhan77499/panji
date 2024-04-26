<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('event_name')->nullable(false);
            $table->string('event_photo');
            $table->string('tithi');
            $table->string('good_time');
            $table->string('bad_time');
            $table->string('sun_rise');
            $table->string('sun_set');
            $table->string('special_niti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event');
    }
};
