<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoPolitica extends Model
{
    protected $table = 'documento_politica';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['documento_id','politica_id'];

    public function politicas(){
        return $this->belongsto('App\Models\Politica','politica_id');
    }
}
