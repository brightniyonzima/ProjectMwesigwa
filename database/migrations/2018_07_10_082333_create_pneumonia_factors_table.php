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
            $table->date('year_of_admission');
            $table->integer('age_group')->nullable();
            $table->integer('gender')->comment('2 = male, 1 = female')->nullable();           
            $table->integer('comorbidity')->nullable();
            $table->integer('exclusive_breast_feeding')->nullable();
            $table->float('birthweight')->nullable();
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
