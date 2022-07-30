<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('gender');
            $table->date('brithDate')->nullable();
            $table->text('briefHistory');
            $table->string('blood',);
            $table->text('habit');
            $table->text('foodAllergy');
            $table->text('drugAllergy');

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
        Schema::dropIfExists('patients');
    }
}
