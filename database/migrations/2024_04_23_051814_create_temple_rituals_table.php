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
        Schema::create('temple_rituals', function (Blueprint $table) {
            $table->id();
            $table->string('ritual_id');
            $table->string('ritual_name');
            $table->string('time');
            $table->string('niti_name');
            $table->string('sebak_name');
            $table->string('description');
            $table->string('status')->default('active');
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
        Schema::dropIfExists('temple_rituals');
    }
};
