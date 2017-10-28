<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoAmbito extends Model
{
    protected $table = 'documento_ambito';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['documento_id','ambito_id'];
    public function ambitos(){
        return $this->belongsto('App\Models\Ambito','ambito_id');
    }
}
