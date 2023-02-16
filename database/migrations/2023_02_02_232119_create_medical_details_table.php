<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('blood_type');
            $table->string('allergy');
            $table->string('skin_disease');
            $table->string('chronic_disease');
            $table->string('genetic_disease')->nullable()->default('لا توجد اي امراض وراثية');
            $table->string('Is_medicine')->nullable()->default('لا توجد اي ادوية سابقة');
            $table->string('medicine_file')->nullable();
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
        Schema::dropIfExists('medical_details');
    }
}
