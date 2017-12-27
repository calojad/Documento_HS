<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riesgos extends Model
{
    protected $table = 'riesgo';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['riesgo','tipoRiesgo_id','descripcion'];

    public function tipoRiesgo(){
        return $this->belongsto('App\Models\TipoRiesgos','tipoRiesgo_id');
    }
}
