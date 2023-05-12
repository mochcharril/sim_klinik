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
            $table->increments('id');
            $table->string('code_rm');
            $table->string('name');
            $table->string('nik')->unique();
            $table->enum('gender', ['laki-laki', 'Perempuan']);
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('address');
            $table->string('phone_number');
            $table->string('insurance_type');
            $table->string('insurance_number');
            $table->enum('is_retention', ['yes', 'no']);
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
