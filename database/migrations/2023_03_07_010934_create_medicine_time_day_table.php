<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineTimeDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_time_day', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_time_id')->constrained('medicine_times')->cascadeOnDelete();
            $table->foreignId('medicine_day_id')->constrained('medicine_days')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_time_day');
    }
}
