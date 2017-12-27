<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ObjetivosController extends Controller
{
    public function postCrear(){
        $data = Input::all();
        Objetivo::create($data);

        return Redirect::to('documento/objetivosambito');
    }
}
