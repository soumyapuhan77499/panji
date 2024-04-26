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
        Schema::create('niti_ritual', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('niti_id');
            $table->unsignedBigInteger('ritual_id');
            $table->foreign('niti_id')->references('id')->on('nitis')->onDelete('cascade');
            $table->foreign('ritual_id')->references('id')->on('rituals')->onDelete('cascade');
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
        Schema::dropIfExists('niti_ritual');
    }
};
