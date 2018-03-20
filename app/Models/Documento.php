<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['titulo','empresa_id','usuario_id','estado','encabezado'];

    public function empresa(){
        return $this->belongsto('App\Models\Empresa','empresa_id');
    }
}
