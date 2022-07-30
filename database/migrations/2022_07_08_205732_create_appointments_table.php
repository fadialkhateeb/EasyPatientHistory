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
            $table->dateTime('time')->nullable(false);
            $table->text('description');
            $table->unsignedBigInteger('recep_id');
            $table->unsignedBigInteger('pat_id');
            $table->foreign('recep_id')->references('recep_id')->on('receptionists');
            $table->foreign('pat_id')->references('patient_id')->on('patients');
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
