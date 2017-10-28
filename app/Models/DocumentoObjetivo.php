<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoObjetivo extends Model
{
    protected $table = 'documento_objetivo';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['documento_id','objetivo_id'];

    public function objetivo(){
        return $this->belongsto('App\Models\Objetivo','objetivo_id');
    }
}
