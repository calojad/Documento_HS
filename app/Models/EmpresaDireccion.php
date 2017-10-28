<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaDireccion extends Model
{
    protected $table = 'empresa_direccion';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['empresa_id','direccion','sucursal'];
}
