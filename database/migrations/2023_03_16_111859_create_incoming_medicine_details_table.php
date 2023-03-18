<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingMedicineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_medicine_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incoming_medicine_id', false, true);
            $table->integer('medicine_id', false, true);
            $table->integer('stock_in');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('incoming_medicine_id')->references('id')->on('incoming_medicines')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('medicine_id')->references('id')->on('medicines')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incoming_medicine_details');
    }
}
