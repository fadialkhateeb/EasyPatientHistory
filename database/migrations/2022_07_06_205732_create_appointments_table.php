<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appoint_id');
            $table->dateTime('appoint_time')->nullable(false);
            $table->enum('state',['canceled','approved']);
            $table->text('description');
            $table->unsignedBigInteger('recep_id');
            $table->unsignedBigInteger('pat_id');
            $table->unsignedBigInteger('doc_id');
            $table->foreign('recep_id')->references('recep_id')->on('receptionists');
            $table->foreign('pat_id')->references('patient_id')->on('patients');
            $table->foreign('doc_id')->references('doc_id')->on('doctors');
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
        Schema::dropIfExists('appointments');
    }
}
