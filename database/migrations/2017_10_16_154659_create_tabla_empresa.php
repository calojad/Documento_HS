<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablaEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('ruc',20)->unique();
            $table->string('logo')->nullable();
            $table->tinyInteger('tipoEmpresa')->comment('1=Empresa;2=Institucion;3=ONG');
            $table->tinyInteger('privada_publica')->comment('1=Privada;2=Publica');
            $table->string('razonSocial');
            $table->string('actiEconomica');
            $table->integer('tamaño');
            $table->integer('hombres');
            $table->integer('mujeres');
            $table->integer('menores');
            $table->integer('vulnerables');
            $table->integer('centros');
            $table->integer('otrosCentros')->nullable();
            $table->tinyInteger('comiteSH')->comment('1=SI,0=NO');
            $table->tinyInteger('unidadSeg')->comment('1=SI,0=NO');
            $table->tinyInteger('servicioMed')->comment('1=SI,0=NO');
            $table->tinyInteger('capacitacionRiesgo')->comment('1=SI,0=NO');
            $table->tinyInteger('contingentcia')->comment('1=SI,0=NO');
            $table->tinyInteger('registroEstadist')->comment('1=SI,0=NO');
            $table->tinyInteger('registroMorbilidad')->comment('1=SI,0=NO');
            $table->tinyInteger('examenMedico')->comment('1=SI,0=NO');
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
        Schema::dropIfExists('empresa');
    }
}
