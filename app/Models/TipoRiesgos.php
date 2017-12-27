<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRiesgos extends Model
{
    protected $table = 'tiporiesgo';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['riesgo'];
}
