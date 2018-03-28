<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plantillas extends Model
{
    protected $table = 'plantillas';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['titulo','plantilla'];
}
