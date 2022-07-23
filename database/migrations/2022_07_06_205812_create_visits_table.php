<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id('visit_id');
            $table->dateTime('visit_time')->nullable(false);
            $table->text('Description');
            $table->unsignedBigInteger('pat_id');
            $table->unsignedBigInteger('doc_id');
            $table->unsignedBigInteger('recep_id');
            $table->foreign('pat_id')->references('patient_id')->on('patients');
            $table->foreign('doc_id')->references('doc_id')->on('doctors');
            $table->foreign('recep_id')->references('recep_id')->on('receptionists');
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
        Schema::dropIfExists('visits');
    }
}
