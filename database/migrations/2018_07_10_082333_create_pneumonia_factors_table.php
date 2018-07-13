<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePneumoniaFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pneumonia_factors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('district_id')->nullable();
            $table->integer('age_group')->nullable();
            $table->integer('month_of_admission')->nullable();
            $table->integer('gender')->comment('0 = male, 1 = female')->nullable();
            $table->integer('level_of_education')->nullable();
            $table->integer('breast_feeding')->nullable();
            $table->integer('weight_for_height')->nullable();
            $table->integer('nutrition_status')->nullable();
            $table->integer('HIV_status')->nullable();
            $table->integer('congestion')->nullable();
            $table->integer('immusation_status')->nullable();
            $table->integer('family_cigaratte_smoker')->nullable();
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
        Schema::dropIfExists('pneumonia_factors');
    }
}
