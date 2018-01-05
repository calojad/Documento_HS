<?php

namespace App\Http\Controllers;

use App\Models\Riesgos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class RiesgosController extends Controller
{
    public function getRiesgoeditar($riesgoId) {
        $riesgo = Riesgos::find($riesgoId);
        echo json_encode($riesgo);
    }
    public function postRiesgoeditar() {
        $data = Input::all();
        $riesgo = Riesgos::find($data['modalRiesgoId']);
        $riesgo->update($data);
        return Redirect::to('/documento/identificariesgos');
    }
}
