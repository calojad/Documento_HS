<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingDocumentoAmbitoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documento_ambito', function (Blueprint $table) {
            $table->foreign('documento_id')
                 ->references('id')->on('documento');
            $table->foreign('ambito_id')
                 ->references('id')->on('ambito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documento_ambito', function (Blueprint $table) {
            $table->dropForeign('documento_ambito_documento_id_foreign');
            $table->dropForeign('documento_ambito_ambito_id_foreign');
        });
    }
}
