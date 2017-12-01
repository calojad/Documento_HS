<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiesgosEmpresa extends Model
{
    protected $table = 'riesgo_empresa';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['riesgo_id','empresa_id','probabilidad','consecuencia','estimacion','control','observacion','seguimiento','prioridad'];
}
