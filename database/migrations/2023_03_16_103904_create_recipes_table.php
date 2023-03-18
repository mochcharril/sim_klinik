<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_rp');
            $table->integer('checkup_id', false, true);
            $table->integer('doctor_id', false, true);
            $table->date('date_recipe');
            $table->timestamps();

            $table->foreign('checkup_id')->references('id')->on('checkups')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('doctor_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
