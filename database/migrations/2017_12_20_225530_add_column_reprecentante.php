<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnReprecentante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('representante', function (Blueprint $table) {
            $table->string('cedula')->after('empresa_id');
            $table->string('firma')->after('cedula');
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
            $table->dropColumn('cedula');
            $table->dropColumn('firma');
        });
    }
}
