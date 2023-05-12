<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id', false, true);
            $table->date('date_out');
            $table->string('reason_mrs');
            $table->string('abnormality');
            $table->string('result');
            $table->string('diagnosa_first');
            $table->string('operatif');
            $table->string('dilit');
            $table->string('farmakology');
            $table->string('other_teraphy');
            $table->string('consultation');
            $table->date('date_control');
            $table->string('place_control');
            $table->string('time_control');
            $table->string('doctor_name');
            $table->string('hospital_name');
            $table->string('condition');
            $table->string('next_checkup');
            $table->timestamps();
            
            $table->foreign('checkup_id')->references('id')->on('checkups')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_resumes');
    }
}
