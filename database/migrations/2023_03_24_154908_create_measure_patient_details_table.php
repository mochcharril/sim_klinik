<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measure_patient_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('measure_patient_id', false, true);
            $table->integer('measure_id', false, true);
            $table->timestamps();

            $table->foreign('measure_patient_id')->references('id')->on('measure_patients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('measure_id')->references('id')->on('measures')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measure_patient_details');
    }
}
