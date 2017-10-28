<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingDocumentoObjetivoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documento_objetivo', function (Blueprint $table) {
            $table->foreign('documento_id')
                 ->references('id')->on('documento');
            $table->foreign('objetivo_id')
                 ->references('id')->on('objetivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documento_objetivo', function (Blueprint $table) {
            $table->dropForeign('documento_objetivo_documento_id_foreign');
            $table->dropForeign('documento_objetivo_objetivo_id_foreign');
        });
    }
}
