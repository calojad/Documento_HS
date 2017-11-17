<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['ruc','nombre','logo','tipoEmpresa','privada_publica','razonSocial','actiEconomica','tamaño','hombres','mujeres','menores','vulnerables','centros','otrosCentros','comiteSH','unidadSeg','servicioMed','capacitacionRiesgo','contingentcia','registroEstadist','registroMorbilidad','examenMedico'];

    public function direccionMatriz($id){
        return EmpresaDireccion::where('empresa_id',$id)
             ->where('sucursal',1)
             ->first();
    }
}
