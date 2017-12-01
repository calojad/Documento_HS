<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingRiesgoEmpresaTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('riesgo_empresa', function (Blueprint $table) {
            $table->foreign('riesgo_id')
                 ->references('id')->on('riesgo');
            $table->foreign('empresa_id')
                 ->references('id')->on('empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('riesgo_empresa', function (Blueprint $table) {
            $table->dropForeign('riesgo_empresa_riesgo_id_foreign');
            $table->dropForeign('riesgo_empresa_empresa_id_foreign');
        });
    }
}
