<?php

namespace App\Http\Controllers;

use App\Models\Ambito;
use App\Models\Articulos;
use App\Models\DocumentoAmbito;
use App\Models\DocumentoObjetivo;
use App\Models\DocumentoPolitica;
use App\Models\EmpresaDireccion;
use App\Models\Plantillas;
use App\Models\Representante;
use App\Models\Objetivo;
use App\Models\Politica;
use App\Models\Riesgos;
use App\Models\RiesgosEmpresa;
use App\Models\TipoRiesgos;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\TemplateProcessor;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Input;
use App\Models\Empresa;
use App\Models\Documento;

class DocumentoController extends Controller
{
//    FUNCIONES DEL DOCUMENTO
    public function getEliminardocumento($id){
        $documento = Documento::find($id);
        $documento->delete();
        return json_encode('/home');
    }
    public function postConfigdocumento(){
        $data = Input::all();
        $documento = Documento::find($data['id']);
        $documento->update($data);

        return Redirect::to('/home');
    }
    //FORMULARIO PARA LLENAR EL DOCUMENTO
    public function getDatosgenerales($ver=0){
        $documento = Documento::find($ver);
        $empresa = new Empresa();
        if($documento != null)
            $empresa = Empresa::find($documento->empresa_id);
        $Sucdirecciones = EmpresaDireccion::where('empresa_id',$empresa->id)
             ->where('sucursal','<>',1)
             ->get();
        Session::put('documentoId',0);
        Session::put('empresaId',0);
        return view('documento.datosGenerales.form', compact('empresa','Sucdirecciones','articulos'));
    }
    public function postDatosgenerales(){
        $data = Input::all();
        if (Input::hasFile('logo')) {
            $file = Input::file('logo');
            $nombre = str_replace(' ','_',$file->getClientOriginalName());
            $nombre = date('ymdhis').'_'.$nombre;
            Storage::disk('local')->put($nombre,  File::get($file));
            $data['logo'] = 'public/logos_empresas/'.$nombre;
            $destinationPath = base_path().'/public/storage/logos_empresas/';
//            $file->move($destinationPath,$nombre);
        }
//        VERIFICAMOS SI LA EMPRESA YA ESTA REGISTRADA
        $empresa = Empresa::where('ruc',$data['ruc'])->first();
        if($empresa == null)
            $empresa = Empresa::create($data);
        else
            $empresa->update($data);

        $docu['titulo'] = 'Reglamento_HS_'.$data['nombre'];
        $docu['empresa_id'] = $empresa->id;
        $docu['estado'] = 1;
        $docu['usuario_id'] = Auth::user()->id;//Session::get('userId');
//        VERIFICAMOS SI EXISTE UN DOCUMENTO CON ESA EMPRESA
        $documento = Documento::where('empresa_id',$empresa->id)->first();
        if($documento == null)
            $documento = Documento::create($docu);
        else
            $documento->update($docu);

        $direccion['empresa_id'] = $empresa->id;
        $direccion['direccion'] = $data['direccion_matriz'];
        $direccion['sucursal'] = 1;
//        VERIFICAR SI EXISTEN DIRECCIONES DE LA EMPRESA
        $direc = EmpresaDireccion::where('empresa_id',$empresa->id)->get();
        if(count($direc) > 0)
            foreach ($direc as $dir){ $dir->delete(); }
        EmpresaDireccion::create($direccion);
        if($data['centros'] > 1){
            for ($i=2;$i<=$data['centros'];$i++){
                $direccion['empresa_id'] = $empresa->id;
                $direccion['direccion'] = $data['direccion_sucursal_'.$i];
                $direccion['sucursal'] = $i;
                EmpresaDireccion::create($direccion);
            }
        }
        Session::put('documentoId',$documento->id);
        Session::put('empresaId',$empresa->id);
        return Redirect()->to('/documento/objetivosambito/1');
    }
    public function getObjetivosambito($alert=0){
        if($alert == 1)
            Alert::success()
                 ->html('<label style="font-size: 12pt;"><samp class="glyphicon glyphicon-ok" style="padding-right: 10px;"></samp> Datos Generales Guardados</label>');
        $ambitos = Ambito::all()->pluck('titulo','id');
        $objetivos = Objetivo::all()->pluck('titulo','id');
        $doc_obj = DocumentoObjetivo::where('documento_id',Session::get('documentoId'))
             ->pluck('objetivo_id');
        $doc_amb = DocumentoAmbito::where('documento_id',Session::get('documentoId'))
             ->pluck('ambito_id');
        return view('documento.objetivosAmbito.form',compact('ambitos','objetivos','doc_amb','doc_obj'));
    }
    public function postObjetivosambito(){
        $data_obj = Input::get('objeto');
        $data_amb = Input::get('ambito');
        $data['documento_id'] = Session::get('documentoId');
        $documento = DocumentoObjetivo::where('documento_id',$data['documento_id'])->get();
//        VERIFICAR SI YA EXISTEN OBJETIVOS EN EL DOCUMENTO
        if(count($documento) > 0)
            foreach ($documento as $doc){ $doc->delete(); }
        foreach($data_obj as $obj){
            $data['objetivo_id'] = $obj;
            DocumentoObjetivo::create($data);
        }
        $documento = DocumentoAmbito::where('documento_id',$data['documento_id'])->get();
//        VERIFICAR SI EXISTEN AMBITOS EN EL DOCUMENTO
        if(count($documento) > 0)
            foreach ($documento as $doc){ $doc->delete(); }
        foreach($data_amb as $amb){
            $data['ambito_id'] = $amb;
            DocumentoAmbito::create($data);
        }
        return Redirect()->to('documento/politicasalud/1');
    }
    public function getPoliticasalud($alert=0){
        $politicas = Politica::all()->pluck('titulo','id');
        $doc_politicas = DocumentoPolitica::where('documento_id',Session::get('documentoId'))
             ->pluck('politica_id');
        $reprecentante = Representante::where('empresa_id',Session::get('empresaId'))->first();
        if($reprecentante == null)
            $reprecentante = new Representante();
        if($alert == 1)
            Alert::success()
                ->html('<label style="font-size: 12pt;"><samp class="glyphicon glyphicon-ok" style="padding-right: 10px;"></samp> Objetivos y Ambitos Guardados</label>');
        return view('documento.politicaSalud.form',compact('politicas','doc_politicas','reprecentante'));
    }
    public function postPoliticasalud(){
        $dataR['nombre'] = Input::get('reprecentante');
        $dataR['cedula'] = Input::get('cedula');
        $data_poli = Input::get('politicas');
        $reprecentante = Representante::where('empresa_id',Session::get('empresaId'))->first();
        $dataR['empresa_id'] = Session::get('empresaId');
        $dataP['documento_id'] = Session::get('documentoId');
        if (Input::hasFile('firma')) {
            $file = Input::file('firma');
            $nombre = str_replace(' ','_',$file->getClientOriginalName());
            $nombre = date('ymdhis').'_'.$nombre;
            Storage::disk('local_firma')->put($nombre,  File::get($file));
            $dataR['firma'] = 'public/firmas/'.$nombre;
            $destinationPath = base_path().'/public/storage/firmas/';
//            $file->move($destinationPath,$nombre);
        }
//        VERIFICAR SI EXISTE UN REPRECENTANTE LEGAL YA REGISTRADO
        if($reprecentante == null){
            $reprecentante = Representante::create($dataR);
        }else{
            $reprecentante->update($dataR);
        }
//        VERIFICAR LAS POLITICAS
        $politicas = DocumentoPolitica::where('documento_id',$dataP['documento_id'])
             ->get();
        if(count($politicas) > 0)
            foreach ($politicas as $poli){ $poli->delete(); }
        foreach($data_poli as $poli){
            $dataP['politica_id'] = $poli;
            DocumentoPolitica::create($dataP);
        }
        return Redirect::to('/documento/identificariesgos/1');
    }
    public function getIdentificariesgos($alert=0){
        $riesgos = Riesgos::orderBy('riesgo','asc')
            ->get();
        $riesgosEmp = RiesgosEmpresa::where('empresa_id',Session::get('empresaId'))
             ->get();
        $tipoRiesgos = TipoRiesgos::all();
        $probabilidades=[0=>"--Seleccionar--",1=>"B-Baja",2=>"M-Media",3=>"A-Alta"];
        $consecuencias=[0=>"--Seleccionar--",1=>"LD-Ligeramente Dañino",2=>"D-Dañino",3=>"ED-Extremadamente Dañino"];
        $control=[0=>"--Seleccionar--",1=>"Medio",2=>"Fuente",3=>"Persona"];
        if($alert == 1)
            Alert::success()
                 ->html('<label style="font-size: 12pt;"><samp class="glyphicon glyphicon-ok" style="padding-right: 10px;"></samp> Politicas Guardadas</label>');
        return view('documento.matrizRiesgos.form_identi', compact('riesgos','tipoRiesgos','probabilidades','consecuencias','control','riesgosEmp'));
    }
    public function postIdentificariesgos(){
        $data['empresa_id'] = Session::get('empresaId');
        $inputRiesgos = Input::get('riesgos');
        $inputProba = Input::get('probabilidad');
        $inputConce = Input::get('consecuencia');
        $inputEstima = Input::get('estimacion');
        $riesgoEmpresa = RiesgosEmpresa::where('empresa_id',$data['empresa_id'])
             ->get();
        if(count($riesgoEmpresa) > 0)
            foreach ($riesgoEmpresa as $rEmp){ $rEmp->delete(); }
        $i=0;
        foreach ($inputRiesgos as $irgs){
            $data['riesgo_id'] = $irgs;
            $data['probabilidad'] = $inputProba[$i];
            $data['consecuencia'] = $inputConce[$i];
            $data['estimacion'] = $inputEstima[$i];
            RiesgosEmpresa::create($data);
            $i++;
        }
        $documento = Documento::where('empresa_id',$data['empresa_id'])->first();
        $documento->update(['estado' => 2]);
        return Redirect::to('/home/2/'.$documento->titulo);
    }
    public function getExportplantilla($doc=0)
    {
        try{
        $arrTamaño = [1 => "Microempresa", 2 => "Pequeña empresa", 3 => "Mediana empresa A", 4 => "Mediana empresa B", 5 => "Gran empresa"];
        $si_no = ['No', 'Si'];
        $documento = Documento::find($doc);
        $empresa = Empresa::find($documento->empresa_id);
        $direcciones = EmpresaDireccion::where('empresa_id', $empresa->id)->get();
        $objetivos = DocumentoObjetivo::where('documento_id', $documento->id)->get();
        $ambitos = DocumentoAmbito::where('documento_id', $documento->id)->get();
        $politicas = DocumentoPolitica::where('documento_id', $documento->id)->get();
        $reprecentante = Representante::where('empresa_id', $empresa->id)->first();
        $poblacion = $empresa->hombres + $empresa->mujeres + $empresa->menores + $empresa->vulnerables;
        $tipoRiesgos = Riesgos::leftjoin('riesgo_empresa', 'riesgo_empresa.riesgo_id', '=', 'riesgo.id')
             ->leftjoin('tiporiesgo','tiporiesgo.id','=','riesgo.tipoRiesgo_id')
             ->where('riesgo_empresa.empresa_id',$empresa->id)
             ->select('tiporiesgo.id','riesgo.tipoRiesgo_id','tiporiesgo.riesgo')
             ->groupBy('riesgo.tipoRiesgo_id')
             ->get();
//==========================CREA INSTANCIA DE PLANTILLA===================================

        $plantilla = Plantillas::find($documento->encabezado);
        $templateWord = new TemplateProcessor(storage_path('app/'.$plantilla->plantilla));
//      VARIABLES SEGUN N° TRABAJADORES

//      COLOCAR RIESGOS
        $templateWord->cloneBlock('CLONEME_TIPO', count($tipoRiesgos));
        $i=0;
        foreach ($tipoRiesgos as $triesgo) {
            $i++;
            $templateWord->setValue('tipoRiesgo_'.$i,$triesgo->riesgo);
            $riesgos = Riesgos::leftjoin('riesgo_empresa', 'riesgo_empresa.riesgo_id', '=', 'riesgo.id')
                 ->where('riesgo_empresa.empresa_id', $empresa->id)
                 ->where('riesgo.tipoRiesgo_id', $triesgo->id)
                 ->select('riesgo.id', 'riesgo.riesgo', 'riesgo.tipoRiesgo_id')
                 ->get();
            $templateWord->cloneBlock('CLONEME_RIESGO_'.$i, count($riesgos));
            $j=0;
            foreach ($riesgos as $riesgo){
                $j++;
                $templateWord->setValue('riesgo_'.$i.'_'.$j,$riesgo->riesgo);
                $articulos =Articulos::where('riesgo_id',$riesgo->id)
                     ->orderBy('num_articulo')
                     ->get();
                if(count($articulos) >= 0)
                    $templateWord->cloneBlock('CLONEME_ARTICULO_'.$i.'_'.$j,count($articulos));
                $k=0;
                foreach ($articulos as $articulo){
                    $k++;
                    $templateWord->setValue('articulo_'.$i.'_'.$j.'_'.$k,$articulo->articulo);
                }
            }
        }

//      INGRESAR VALORES DE LAS VARIABLES
//        LOGO
        if($empresa->logo != ''){
            $templateWord->setImg('logo',['src'=>storage_path('app/'.$empresa->logo),'swh'=>100]);
        }else{
            $templateWord->setValue('logo','');
        }

//        DATOS GENERALES
        $templateWord->setValue('nombreEmpresa',$empresa->nombre);
        $templateWord->setValue('ruc',$empresa->ruc);
        $templateWord->setValue('razonSocial',$empresa->razonSocial);
        $templateWord->setValue('actiEconomica',$empresa->actiEconomica);
        $templateWord->setValue('tamaño',$arrTamaño[$empresa->tamaño]);
        $templateWord->setValue('poblacion',$poblacion);
        $templateWord->setValue('centros',$empresa->centros);
        $templateWord->setValue('direcciónMatriz',$direcciones[0]->direccion);
        if(count($direcciones) > 1){
            $templateWord->setValue('sucursal','Sucursales: ');
            $templateWord->cloneRow('direcciónSucursal',count($direcciones)-1);
            for($i=1;$i<=count($direcciones)-1;$i++){
                $templateWord->setValue('direcciónSucursal#'.$i,$direcciones[$i]->sucursal-1 .'.- '.$direcciones[$i]->direccion);
            }
        }else{
            $templateWord->setValue('sucursal','');
            $templateWord->setValue('direcciónSucursal','');
        }
//        PREGUNTAS
        $templateWord->setValue('comite',$si_no[$empresa->comiteSH]);
        $templateWord->setValue('unidad',$si_no[$empresa->unidadSeg]);
        $templateWord->setValue('servicio',$si_no[$empresa->servicioMed]);
        $templateWord->setValue('capacitacion',$si_no[$empresa->capacitacionRiesgo]);
        $templateWord->setValue('plan',$si_no[$empresa->contingentcia]);
        $templateWord->setValue('estadistico',$si_no[$empresa->registroEstadist]);
        $templateWord->setValue('morbilidad',$si_no[$empresa->registroMorbilidad]);
        $templateWord->setValue('examen',$si_no[$empresa->examenMedico]);
//      OBJETIVOS
        $templateWord->cloneRow('objetivos',count($objetivos));
        $i = 0;
        foreach($objetivos as $obj){
            $i++;
            $templateWord->setValue('objetivos#'.$i,$obj->objetivo->descripcion);
        }
//      AMBITOS
        $amb_aux = null;
        foreach($ambitos as $amb){
            $amb_aux = $amb_aux.', '.$amb->ambitos->descripcion;
        }
        $templateWord->setValue('ambitos',$amb_aux);
//      POLITICAS
        $templateWord->cloneRow('politicas',count($politicas));
        $i = 0;
        foreach($politicas as $poli){
            $i++;
            $templateWord->setValue('politicas#'.$i,$poli->politicas->descripcion);
        }
        $templateWord->setValue('representante',$reprecentante->nombre);
//        FIRMA
        if($reprecentante->firma != '')
            $templateWord->setImg('firma_rep',['src'=>storage_path('app/'.$reprecentante->firma),'swh'=>150]);
        else
            $templateWord->setValue('firma_rep','');
        $templateWord->setValue('cedularepresenta',$reprecentante->cedula);

//      GUARDAR DOCUMENTO
        $templateWord->saveAs($documento->titulo.'.docx');
        return response()->download($documento->titulo.'.docx');
        }catch (\Exception $e){
            Session::flash('danger','Error al Generar el Documento. Es posible que la plantilla este mal configurada');
            return Redirect::to('/home');
        }
    }
    public function getExportarmatriz(){
        $userId = Session::get('userId');
        $documentos = Documento::where('estado','<>',0)
             ->where('usuario_id',$userId)
             ->get();
        return view('documento.matrizRiesgos.exportarMatriz',compact('documentos'));
    }
    public function getExportmatrizpdf(){
        $tipoRiesgo = TipoRiesgos::orderBy('id','asc')->pluck('riesgo','id');;
        $numTipo = Riesgos::select(DB::raw('count(tipoRiesgo_id) as numero, tipoRiesgo_id'))
             ->groupBy('tipoRiesgo_id')
             ->get();
        $riesgos = Riesgos::orderBy('tipoRiesgo_id','asc')->get();
        $empresa = null;
        $pdf  = App::make('dompdf.wrapper');
        $view = View::make('documento.matrizRiesgos.pdfMatriz',compact('riesgos','tipoRiesgo','numTipo','empresa'))->render();
//      portrait - landscape
        $pdf->setPaper('A4', 'landscape');
        $pdf->loadHTML($view);

        return $pdf->stream('Matriz Riesgos.pdf');
    }
    public function  getExportmatrizemppdf($id){
        $tipoRiesgo = TipoRiesgos::leftjoin('riesgo','riesgo.tipoRiesgo_id','=','tiporiesgo.id')
             ->leftjoin('riesgo_empresa','riesgo.id','=','riesgo_empresa.riesgo_id')
             ->where('riesgo_empresa.empresa_id',$id)
             ->orderBy('id','asc')
             ->pluck('riesgo.riesgo','riesgo.id');
        $numTipo = Riesgos::leftjoin('riesgo_empresa','riesgo_empresa.riesgo_id','=','riesgo.id')
             ->select(DB::raw('count(tipoRiesgo_id) as numero, tipoRiesgo_id'))
             ->where('empresa_id',$id)
             ->groupBy('tipoRiesgo_id')
             ->get();
        $riesgos = Riesgos::leftjoin('riesgo_empresa','riesgo.id','=','riesgo_empresa.riesgo_id')
             ->where('empresa_id',$id)
             ->orderBy('riesgo.tipoRiesgo_id','asc')
             ->select('riesgo.id','riesgo.tipoRiesgo_id','riesgo.riesgo','riesgo_empresa.empresa_id','riesgo_empresa.probabilidad','riesgo_empresa.consecuencia','riesgo_empresa.estimacion','riesgo_empresa.control','riesgo_empresa.observacion','riesgo_empresa.seguimiento')
             ->get();
        $empresa = Empresa::find($id);
        $pdf  = App::make('dompdf.wrapper');
        $view = View::make('documento.matrizRiesgos.pdfMatriz',compact('riesgos','tipoRiesgo','numTipo','empresa'))->render();
        $pdf->setPaper('A4', 'landscape');
        $pdf->loadHTML($view);

        return $pdf->stream('Matriz Riesgos.pdf');
    }
}