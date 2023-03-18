<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id', false, true);
            $table->integer('measure_id', false, true);
            $table->integer('total');
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('payment_details');
    }
}
