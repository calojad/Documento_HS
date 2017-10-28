<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Session;
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
    public function index($alert=0)
    {
        if($alert != 0)
            Alert::message('You are logged in!','info');
        $documentos = Documento::take(10)->get();
        return view('auth.home',compact('documentos'));
    }
}
