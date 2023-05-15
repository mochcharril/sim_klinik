<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnStatusInformedConsentCheckupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkups', function (Blueprint $table) {
            $table->enum('status_informed_consent', ['Ya', 'Tidak', 'Menunggu']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkups', function (Blueprint $table) {
            //
        });
    }
}
