<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingDireccionEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresa_direccion', function (Blueprint $table) {
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
        Schema::table('empresa_direccion', function (Blueprint $table) {
            $table->dropForeign('empresa_direccion_empresa_id_foreign');
        });
    }
}
