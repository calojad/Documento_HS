<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambito extends Model
{
    protected $table = 'ambito';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['titulo','descripcion'];
}
