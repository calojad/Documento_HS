<?php

namespace App\Http\Controllers;

use App\Models\Ambito;
use App\Models\Empresa;
use App\Models\Objetivo;
use App\Models\Parrafos;
use App\Models\Politica;
use App\Models\Representante;
use App\Models\Riesgos;
use App\Models\TipoRiesgos;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class MantenimientoController extends Controller
{
//    LISTADOS===============================================
    public function getAmbitos(){
        $ambitos = Ambito::all();
        return view('mantenimientos.ambito.ambitos', compact('ambitos'));
    }
    public function getEmpresas(){
        $empresas = Empresa::all();
        return view('mantenimientos.empresa.empresas', compact('empresas'));
    }
    public function getObjetivos(){
        $objetivos = Objetivo::all();
        return view('mantenimientos.objetivo.objetivos', compact('objetivos'));
    }
    public function getParrafos(){
        $parrafos = Parrafos::all();
        return view('mantenimientos.parrafo.parrafos', compact('parrafos'));
    }
    public function getPoliticas(){
        $politicas = Politica::all();
        return view('mantenimientos.politica.politicas', compact('politicas'));
    }
    public function getRepresentantes(){
        $representantes = Representante::all();
        return view('mantenimientos.representante.representantes', compact('representantes'));
    }
    public function getRiesgos(){
        $riesgos = Riesgos::orderBy('tipoRiesgo_id','ASC')->get();
        return view('mantenimientos.riesgo.riesgos', compact('riesgos'));
    }
    public function getTiporiesgo(){
        $tipoRiesgos = TipoRiesgos::all();
        return view('mantenimientos.tipoRiesgo.tipoRiesgos', compact('tipoRiesgos'));
    }
    public function getUsuarios(){
        $usuarios = User::all();
        return view('mantenimientos.usuario.usuarios', compact('usuarios'));
    }
    //    EDITAR GET'S===============================================
    public function getEditarambito($id){
        $ambito = Ambito::find($id);
        $titulo = 'EDITAR AMBITO';
        return view('mantenimientos.ambito.form', compact('ambito','titulo'));
    }
    public function getEditarempresa($id){
        $empresa = Empresa::find($id);
        $titulo = 'EDITAR EMPRESA';
        return view('mantenimientos.empresa.form', compact('empresa','titulo'));
    }
    public function getEditarobjetivo($id){
        $objetivo = Objetivo::find($id);
        $titulo = 'EDITAR OBJETIVO';
        return view('mantenimientos.objetivo.form', compact('objetivo','titulo'));
    }
    public function getEditarparrafo($id){
        $parrafo = Parrafos::find($id);
        $titulo = 'EDITAR PARRAFO';
        return view('mantenimientos.parrafo.form', compact('parrafo','titulo'));
    }
    public function getEditarpolitica($id){
        $politica = Politica::find($id);
        $titulo = 'EDITAR POLITICA';
        return view('mantenimientos.politica.form', compact('politica','titulo'));
    }
    public function getEditarepresentante($id){
        $representante = Representante::find($id);
        $titulo = 'EDITAR REPRESENTANTE';
        return view('mantenimientos.representante.form', compact('representante','titulo'));
    }
    public function getEditariesgo($id){
        $riesgo = Riesgos::find($id);
        $tipoRiesgos = TipoRiesgos::orderBy('riesgo','ASC')->pluck('riesgo','id');
        $titulo = 'EDITAR RIESGO';
        return view('mantenimientos.riesgo.form', compact('riesgo','titulo','tipoRiesgos'));
    }
    public function getEditartiporiesgo($id){
        $tipoRiesgo = TipoRiesgos::find($id);
        $titulo = 'EDITAR TIPO DE RIESGO';
        return view('mantenimientos.tipoRiesgo.form', compact('tipoRiesgo','titulo'));
    }
    public function getEditarusuario($id){
        $usuario = User::find($id);
        $titulo = 'EDITAR USUARIO';
        return view('mantenimientos.usuario.form', compact('usuario','titulo'));
    }
//    EDITAR POST'S===============================================
    public function postEditarambito($id){
        $data = Input::all();
        $ambito = Ambito::find($id);
        $ambito->update($data);
        return Redirect::to('mantenimiento/ambitos');
    }
    public function postEditarempresa($id){
        $data = Input::all();
        $empresa = Empresa::find($id);
        $empresa->update($data);
        return Redirect::to('mantenimiento/empresas');
    }
    public function postEditarobjetivo($id){
        $data = Input::all();
        $objetivos = Objetivo::find($id);
        $objetivos->update($data);
        return Redirect::to('mantenimiento/objetivos');
    }
    public function postEditarparrafo($id){
        $data = Input::all();
        $parrafo = Parrafos::find($id);
        $parrafo->update($data);
        return Redirect::to('mantenimiento/parrafos');
    }
    public function postEditarpolitica($id){
        $data = Input::all();
        $politica = Politica::find($id);
        $politica->update($data);
        return Redirect::to('mantenimiento/politicas');
    }
    public function postEditarepresentante($id){
        $data = Input::all();
        $representante = Representante::find($id);
        $representante->update($data);
        return Redirect::to('mantenimiento/representantes');
    }
    public function postEditariesgo($id){
        $data = Input::all();
        $riesgo = Riesgos::find($id);
        $riesgo->update($data);
        return Redirect::to('mantenimiento/riesgos');
    }
    public function postEditartiporiesgo($id){
        $data = Input::all();
        $tiporiesgo = TipoRiesgos::find($id);
        $tiporiesgo->update($data);
        return Redirect::to('mantenimiento/tiporiesgo');
    }
    public function postEditarusuario($id){
        $data = Input::all();
        $usuario = User::find($id);
        $usuario->update($data);
        return Redirect::to('mantenimiento/usuarios');
    }
//    CREAR GET'S===============================================
    public function getCrearambito(){
        $ambito = new Ambito();
        $titulo = 'CREAR AMBITO';
        return view('mantenimientos.ambito.form', compact('ambito','titulo'));
    }
    public function getCrearobjetivo(){
        $objetivo = new Objetivo();
        $titulo = 'CREAR OBJETIVO';
        return view('mantenimientos.objetivo.form', compact('objetivo','titulo'));
    }
    public function getCrearparrafo(){
        $parrafo = new Parrafos();
        $titulo = 'CREAR PARRAFO';
        return view('mantenimientos.parrafo.form', compact('parrafo','titulo'));
    }
    public function getCrearpolitica(){
        $politica = new Politica();
        $titulo = 'CREAR POLITICA';
        return view('mantenimientos.politica.form', compact('politica','titulo'));
    }
    public function getCreariesgo(){
        $riesgo = new Riesgos();
        $tipoRiesgos = TipoRiesgos::orderBy('riesgo','ASC')->pluck('riesgo','id');
        $titulo = 'CREAR RIESGO';
        return view('mantenimientos.riesgo.form', compact('riesgo','titulo','tipoRiesgos'));
    }
    public function getCreatiporiesgo(){
        $tipoRiesgo = new TipoRiesgos();
        $titulo = 'CREAR CATEGORIA DE RIESGO';
        return view('mantenimientos.tipoRiesgo.form', compact('tipoRiesgo','titulo'));
    }
    //    CREAR POST'S===============================================
    public function postCrearambito(){
        $data = Input::all();
        Ambito::create($data);

        return Redirect::to('mantenimiento/ambitos');
    }
    public function postCrearobjetivo(){
        $data = Input::all();
        Objetivo::create($data);

        return Redirect::to('mantenimiento/objetivos');
    }
    public function postCrearparrafo(){
        $data = Input::all();
        Parrafos::create($data);

        return Redirect::to('mantenimiento/parrafos');
    }
    public function postCrearpolitica(){
        $data = Input::all();
        Politica::create($data);

        return Redirect::to('mantenimiento/politicas');
    }
    public function postCreariesgo(){
        $data = Input::all();
        Riesgos::create($data);

        return Redirect::to('mantenimiento/riesgos');
    }
    public function postCreatiporiesgo(){
        $data = Input::all();
        TipoRiesgos::create($data);

        return Redirect::to('mantenimiento/tiporiesgo');
    }
//    ELIMINAR===============================================
    public function getEliminarambito($id){
        $ambito = Ambito::find($id);
        $ambito->delete();

        return Redirect::to('mantenimiento/ambitos');
    }
    public function getEliminarobjetivo($id){
        $objetivo = Objetivo::find($id);
        $objetivo->delete();

        return Redirect::to('mantenimiento/objetivos');
    }
    public function getEliminarparrafo($id){
        $parrafo = Parrafos::find($id);
        $parrafo->delete();

        return Redirect::to('mantenimiento/parrafos');
    }
    public function getEliminarpolitica($id){
        $politica = Politica::find($id);
        $politica->delete();

        return Redirect::to('mantenimiento/politicas');
    }
    public function getEliminariesgo($id){
        $riesgo = Riesgos::find($id);
        $riesgo->delete();

        return Redirect::to('mantenimiento/riesgos');
    }
    public function getEliminartiporiesgo($id){
        $tiporiesgo = TipoRiesgos::find($id);
        $tiporiesgo->delete();

        return Redirect::to('mantenimiento/tiporiesgo');
    }
}