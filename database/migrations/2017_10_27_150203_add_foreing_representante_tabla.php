<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingRepresentanteTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('representante', function (Blueprint $table) {
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
        Schema::table('representante', function (Blueprint $table) {
            $table->dropForeign('representante_empresa_id_foreign');
        });
    }
}
