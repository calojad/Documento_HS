<?php

namespace App\Http\Controllers;

use App\Models\Ambito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AmbitosController extends Controller
{
    public function postCrear(){
        $data = Input::all();
        Ambito::create($data);

        return Redirect::to('documento/objetivosambito');
    }
}
