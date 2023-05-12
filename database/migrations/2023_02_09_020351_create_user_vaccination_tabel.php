<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVaccinationTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vaccination', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccination_id')->references('id')->on('vaccinations')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            // status 0 => means that user not attach vaccine yet , 1 => user is attach vaccine
            $table->tinyInteger('status')->default(0)->comment('0 => not attach vaccine , 1=> attach vaccine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vaccination_tabel');
    }
}
