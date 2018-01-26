<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table = 'articulos';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['riesgo_id','articulo','num_articulo'];

    public function riesgo(){
        return $this->belongsto('App\Models\Riesgos','riesgo_id');
    }
}
