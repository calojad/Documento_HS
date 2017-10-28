<?php

namespace App\Http\Controllers;

use App\Politica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PoliticaController extends Controller
{
    public function postCrear(){
        $data = Input::all();
        Politica::create($data);

        return Redirect::to('documento/politicasalud');
    }
}
