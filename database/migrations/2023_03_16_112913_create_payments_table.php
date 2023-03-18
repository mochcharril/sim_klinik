<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_py');
            $table->integer('checkup_id', false, true);
            $table->integer('recipe_id', false, true);
            $table->integer('total');
            $table->integer('admin_id', false, true);
            $table->date('date_payment');
            $table->timestamps();

            $table->foreign('checkup_id')->references('id')->on('checkups')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('recipe_id')->references('id')->on('recipes')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
