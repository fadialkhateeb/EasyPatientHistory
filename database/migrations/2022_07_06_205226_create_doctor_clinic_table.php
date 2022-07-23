<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorClinicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_clinic', function (Blueprint $table) {
            $table->id();
            $table->string('work_hours');
            $table->unsignedBigInteger('Clinic_id');
            $table->unsignedBigInteger('doc_id');
            $table->foreign('clinic_id')->references('cli_id')->on('clinics');
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
        Schema::dropIfExists('doctor_clinic');
    }
}
