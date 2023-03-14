<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_diseases', function (Blueprint $table) {
            $table->id();
            // 0 => normal , 1=> upnormal
            $table->tinyInteger('prediction')->comment('0 =>normal , 1=>upnormal');
            $table->string('disease_name');
            $table->string('disease_photo');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
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
        Schema::dropIfExists('ai_diseases');
    }
}
