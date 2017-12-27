<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parrafos extends Model
{
    protected $table = 'parrafos';
    const CREATED_AT = 'created_At';
    const UPDATED_AT = 'updated_At';
    public $timestamps = true;

    protected $fillable = ['titulo','parrafo'];
}
