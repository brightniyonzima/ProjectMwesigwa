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
            $table->string('month_of_admission')->nullable();
            $table->integer('age_in_month')->nullable();
            $table->float('body_mass_index')->nullable();
            $table->integer('immusation_status')->nullable();
            $table->integer('symptoms')->nullable();
            $table->integer('outcome')->nullable();
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
