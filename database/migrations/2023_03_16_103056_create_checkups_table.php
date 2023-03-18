<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_cu');
            $table->integer('patient_id', false, true);
            $table->integer('doctor_nurse_id', false, true);
            $table->string('complaint');
            $table->string('height');
            $table->string('weight');
            $table->string('blood_preasure');
            $table->string('allergy');
            $table->string('diagnosis');
            $table->string('measures');
            $table->integer('poly_id', false, true);
            $table->date('checkup_date');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('doctor_nurse_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('poly_id')->references('id')->on('polies')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkups');
    }
}
