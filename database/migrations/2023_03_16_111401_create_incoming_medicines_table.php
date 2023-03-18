<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_im');
            $table->integer('parmachist_id', false, true);
            $table->integer('total');
            $table->date('date_income_medicine');
            $table->timestamps();

            $table->foreign('parmachist_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incoming_medicines');
    }
}
