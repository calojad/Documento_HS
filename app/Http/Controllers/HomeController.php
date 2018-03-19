<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($alert=0,$doc=0)
    {
        if($alert == 1)
            Alert::success()
                 ->html('<label style="font-size: 12pt;"><samp class="glyphicon glyphicon-ok" style="padding-right: 10px;"></samp> Usuario Creado Exitosamente</label>');
        if($alert == 2){
            Alert::success()
                 ->html('<label style="font-size: 12pt;"><samp class="glyphicon glyphicon-ok" style="padding-right: 10px;"></samp> Documento <b style="color: #9f191f">"'.$doc.'"</b> Creado Exitosamente</label>');
        }
        $userId = Session::get('userId');
        $documentos = Documento::where('estado','<>',0)
             ->where('usuario_id',$userId)
             ->get();
        Session::put('documentoId',0);
        Session::put('empresaId',0);
        return view('auth.home',compact('documentos'));
    }
}
