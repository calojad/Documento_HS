<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'objetivo';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timestamps = true;

    protected $fillable = ['titulo','descripcion'];
}
