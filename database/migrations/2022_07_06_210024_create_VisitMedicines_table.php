<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Visit_medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('frequency');
            $table->string('note',1000);
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('medic_id');
            $table->foreign('visit_id')->references('visit_id')->on('visits');
            $table->foreign('medic_id')->references('medic_id')->on('medicines');
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
        Schema::dropIfExists('Visit_medicines');
    }
}
