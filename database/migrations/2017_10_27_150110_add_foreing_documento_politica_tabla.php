<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingDocumentoPoliticaTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documento_politica', function (Blueprint $table) {
            $table->foreign('documento_id')
                 ->references('id')->on('documento');
            $table->foreign('politica_id')
                 ->references('id')->on('politica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documento_politica', function (Blueprint $table) {
            $table->dropForeign('documento_politica_documento_id_foreign');
            $table->dropForeign('documento_politica_politica_id_foreign');
        });
    }
}
