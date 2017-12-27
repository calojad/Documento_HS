<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    protected $table = 'representante';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['nombre','empresa_id','cedula','firma'];

    public function empresa(){
        return $this->belongsto('App\Models\Empresa','empresa_id');
    }
}
