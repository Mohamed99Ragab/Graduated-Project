<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeethDevelopmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teeth_developments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('apperance_date');
            $table->string('teeth_name');
            $table->string('age_in_years')->comment('child age in years when your teeth apperance');
            $table->string('age_in_months')->comment('child age in months when your teeth apperance');
            $table->string('age_in_days')->comment('child age in days when your teeth apperance');

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
        Schema::dropIfExists('teeth_developments');
    }
}
