<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Politica extends Model
{
    protected $table = 'politica';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['titulo','descripcion'];
}
