<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingRiesgoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riesgo', function (Blueprint $table) {
            $table->foreign('tipoRiesgo_id')
                 ->references('id')->on('tipoRiesgo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riesgo', function (Blueprint $table) {
            $table->dropForeign('riesgo_tipoRiesgo_id_foreign');
        });
    }
}
