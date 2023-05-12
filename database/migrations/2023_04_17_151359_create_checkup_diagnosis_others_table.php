<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckupDiagnosisOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkup_diagnosis_others', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkup_id', false, true);
            $table->string('code_diagnosis');
            $table->string('description_diagnosis');
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
        Schema::dropIfExists('checkup_diagnosis_others');
    }
}
