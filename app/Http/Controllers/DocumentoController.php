<?php

namespace App\Http\Controllers;

use App\Models\Ambito;
use App\Models\DocumentoAmbito;
use App\Models\DocumentoObjetivo;
use App\Models\DocumentoPolitica;
use App\Models\EmpresaDireccion;
use App\Models\Representante;
use App\Models\Objetivo;
use App\Models\Politica;
use App\Models\Riesgos;
use App\Models\RiesgosEmpresa;
use App\Models\TipoRiesgos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Input;
use App\Models\Empresa;
use App\Models\Documento;

class DocumentoController extends Controller
{
    //
    public function getDatosgenerales($ver=0){
        $documento = Documento::find($ver);
        $empresa = new Empresa();
        if($documento != null)
            $empresa = Empresa::find($documento->empresa_id);
        $direcciones = EmpresaDireccion::where('empresa_id',$empresa->id)
             ->where('sucursal','<>',1)
             ->get();
        return view('documento.datosGenerales.form', compact('empresa','direcciones'));
    }
    public function postDatosgenerales(){
        $data = Input::all();
        if (Input::hasFile('logo')) {
            $file = Input::file('logo');
            $nombre = str_replace(' ','_',$file->getClientOriginalName());
            $nombre = date('ymdhis').'_'.$nombre;
            Storage::disk('local')->put($nombre,  File::get($file));
            $data['logo'] = 'public/logos_empresas/'.$nombre;
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
        $riesgoEmpresa = RiesgosEmpresa::where('empresa_id',$data['empresa_id'])
             ->get();
        if(count($riesgoEmpresa) > 0)
            foreach ($riesgoEmpresa as $rEmp){ $rEmp->delete(); }
        foreach ($inputRiesgos as $irgs){
            $data['riesgo_id'] = $irgs;
            RiesgosEmpresa::create($data);
        }
        $documento = Documento::where('empresa_id',$data['empresa_id'])->first();
        $documento->update(['estado' => 2]);
        return Redirect::to('/home');
    }
    public function getExportplantilla($doc=0){
        $arrTamaño = [1=>"Microempresa",2=>"Pequeña empresa",3=>"Mediana empresa A",4=>"Mediana empresa B",5=>"Gran empresa"];
        $si_no = ['No','Si'];
        $documento = Documento::find($doc);
        $empresa = Empresa::find($documento->empresa_id);
        $direcciones = EmpresaDireccion::where('empresa_id',$empresa->id)->get();
        $objetivos = DocumentoObjetivo::where('documento_id',$documento->id)->get();
        $ambitos = DocumentoAmbito::where('documento_id',$documento->id)->get();
        $politicas = DocumentoPolitica::where('documento_id',$documento->id)->get();
        $reprecentante =Representante::where('empresa_id',$empresa->id)->first();
        $poblacion = $empresa->hombres + $empresa->mujeres + $empresa->menores + $empresa->vulnerables;

//      CREA INSTANCIA DE PLANTILLA
        $templateWord = new TemplateProcessor(asset('/storage/plantilla_Word/REG_HIG_Y_SEGURIDAD_MED.docx'));

//      VARIABLES SEGUN N° TRABAJADORES
        if($poblacion >= 10)
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
        $templateWord->cloneRow('direcciónSucursal',count($direcciones)-1);
        for($i=1;$i<=count($direcciones)-1;$i++){
            $templateWord->setValue('direcciónSucursal#'.$i,$direcciones[$i]->sucursal-1 .'.- '.$direcciones[$i]->direccion);
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

//      GUARDAR DOCUMENTO
        $templateWord->saveAs($documento->titulo.'.docx');
        
        return response()->download($documento->titulo.'.docx');
    }
    public function getExportar($doc=0){
        $arrTamaño = [1=>"Microempresa",2=>"Pequeña empresa",3=>"Mediana empresa A",4=>"Mediana empresa B",5=>"Gran empresa"];
        
        $documento = Documento::find($doc);
        $empresa = Empresa::find($documento->empresa_id);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section1 = $phpWord->addSection();
//      STILOS DE LOS TEXTOS
        $phpWord->setDefaultFontName('Calibri');
        $phpWord->setDefaultFontSize(11);
        $phpWord->addTitleStyle(1, array('size' => 14,'bold'=>true,'name'=>'Calibri'), array('alignment'=>'center'));
        $phpWord->addFontStyle('subtitulos',['size'=> 12,'bold'=>true]);
        $phpWord->addFontStyle('titulos1',['size'=> 28,'bold'=>true]);
        $phpWord->addFontStyle('titulos2',['size'=> 21,'bold'=>true]);
        $phpWord->addParagraphStyle('titulos',['alignment'=>'center']);
//      INGRESO DE TEXTO
        $section1->addTextBreak(10);
        $section1->addText($empresa->nombre,'titulos1','titulos');
        $section1->addText('REGLAMENTO INTERNO DE HIGIENE Y SEGURIDAD','titulos2','titulos');
        $section1->addTextBreak(1);
        $section1->addPageBreak();

        $section2 = $phpWord->addSection();
        $section2->addTOC();

        $section3 = $phpWord->addSection();
        $section3->getStyle()->setPageNumberingStart(5);
//        DATOS GENERALES
        $section3->addTitle('DATOS GENERALES DE LA EMPRESA',1);
        $dg1 = $section3->addText('Registro Único de Contribuyentes (RUC): '.$empresa->ruc);
        $section3->addText('Razón Social: '.$empresa->razonSocial);
        $section3->addText('Actividad Económica: '.$empresa->actiEconomica);
        $section3->addText('Tamaño de la Empresa: '.$arrTamaño[$empresa->tamaño]);
//        OBJETIVOS Y AMBITO
        $section3->addTitle('OBJETO Y ÁMBITO DE APLICACIÓN',1);
//        POLITICAS
        $section3->addTitle('POLÍTICA DE SEGURIDAD Y SALUD EN EL TRABAJO',1);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path($documento->titulo.'.docx'));
        } catch (Exception $e) {

        }
//        return response()->download(storage_path($documento->titulo.'.docx'));
    }
}
