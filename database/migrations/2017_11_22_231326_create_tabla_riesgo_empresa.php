<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaRiesgoEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riesgo_empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('riesgo_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->integer('probabilidad')->comment('1=Baja;2=Medio;3=Alto');
            $table->integer('consecuencia')->comment('1=Poco Daño;2=Daño;3=Alto Daño');
            $table->integer('estimacion')->comment('1=Trivial;2=Tolerable;3=Medio;4=Importante;5=Intolerable');
            $table->integer('control')->comment('1=Medio;2=Fuente;3=Persona');
            $table->string('observacion');
            $table->string('seguimiento');
            $table->integer('prioridad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riesgo_empresa');
    }
}
