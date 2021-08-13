<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;
use sispg\Http\Requests;
use sispg\TipoTema;
use sispg\Grupo;
use sispg\Carrera;
use sispg\Persona;
use sispg\Estudiante;
use sispg\TipoAsesor;
use sispg\Docente;
use sispg\GrupoDocente;
use sispg\nuevaetapa;
use sispg\EstudianteGrupos;
use sispg\Solicitud;
use sispg\grupo_solicitud;
use sispg\Rol_carrera;
use sispg\cambioTema;
use sispg\Prorrogai;
use sispg\Prorrogajd;
use sispg\DocenteSolicitud;
use sispg\solicitud_reprobacion;
use sispg\etapas_grupos;
use sispg\solicitudc;
use sispg\Rol;
use sispg\Notas;
use sispg\Periodo;
    
use sispg\Ponderacion;
use sispg\notificacion_inasistencia;
use sispg\Fecha;
use sispg\User;
use sispg\renuncia;
use sispg\Departamento;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sispg\Http\Requests\GrupoFormRequest;
use sispg\Http\Requests\TipotemaFormRequest;
use sispg\Http\Requests\EstudianteFormRequest;
use Illuminate\Support\Collection;
use DB;
use Validator;
use Exception;
use Response;
use Dark\Dummy\Gantt\Gantt;

use sispg\{
  GrupoAsistencia,
  AlumnoAsistencia
};

class gruposoffController extends Controller
{
  public function __construct(){

  }

    ////// index
  public function index(Request $request ){

    $estudiantes=Estudiante::all();
    $tiproceso=TipoTema::all();
    $docentes = Docente::all();
    $carreras = Carrera::all();
    $tipoasesor=TipoAsesor::all();
    $mostraintegrante=EstudianteGrupos::all();
    $asesores=GrupoDocente::all();

   $grupos=Grupo::all();

    $personas=Persona::all();
    $rol_carrera=rol_carrera::all();
    $cambiotema=cambioTema::all();
    $departamento=Departamento::all();
    $integrantes=DB::table('estudiantes')->select('estudiantes.idestudiante','estudiantes.carnet','estudiantes.idpersona','estudiantes.idcarrera') -> leftjoin ('estudiante_grupos','estudiantes.idestudiante','=','estudiante_grupos.idestudiante')->where ('estudiante_grupos.idestudiante', '=',null)->get();       

    $aniomin = Grupo::min('fecharegistro');
    $fecharegistro = strtotime($aniomin);
    $aniomin = date("Y", $fecharegistro);   
    $anio = Grupo::max('fecharegistro');
    $fecharegistro = strtotime($anio); 
    $anio1 = date("Y", $fecharegistro);
    $nAcuerdos=grupo_solicitud::all();

    return view('ues.gruposoff.index')
    ->with('integrantes',$integrantes)
    ->with('grupos',$grupos)
    ->with('tiproceso',$tiproceso)
    ->with('tipoasesor',$tipoasesor)
    ->with('mostraintegrante',$mostraintegrante)
    ->with('estudiantes',$estudiantes)
    ->with('asesores',$asesores)
    ->with('carreras',$carreras)
    ->with('personas',$personas)
    ->with('rol_carrera',$rol_carrera)
    ->with('cambiotema',$cambiotema)
    ->with('docentes',$docentes)
    ->with('departamentos',$departamento)
    ->with('departamento',$departamento)
    ->with('anio1',$anio1)
     ->with('nAcuerdos',$nAcuerdos)
    ->with('aniomin',$aniomin);
  }



    //////////funcion guardar
  public function store(GrupoFormRequest $request){

    $grupos=new Grupo;
 $nuevaetapa=nuevaetapa::all();
    $grupos->codigoG=$request->get('codigoG');
    $grupos->tema=$request->get('tema');
    $grupos->fecharegistro=$request->get('fecharegistro');
    $grupos->idtipotema=$request->get('idtipoT');
    $grupos->idcarrera=Input::get('idcarrera');
        //$grupos->idcarrera=$request->get('carr');
    $grupos->condicion=true;
    $grupos->save();
        ////propuesta
              // dd($request); 
        if($request->file('propuesta')!=null){
       $file = $request->file('propuesta');
             //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
        $ruta=$grupos->idgrupo;
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('propuestas')->put('/'.$ruta.'/'.$ruta.'-Propuesta.pdf',  \File::get($file));
        $grupos->propuesta=$ruta.'/'.$ruta.'-Propuesta.pdf';
          $grupos->update();
        }
   

   foreach ($request->estudiantes as $esTemp) {

    $ed= new EstudianteGrupos();
    $ed->idgrupo = $grupos->idgrupo;
    $ed->idestudiante=$esTemp;
    $ed->save();
  }

  foreach ($request->asesor as $asesorTemp) {
   DB::table('grupos_docentes')->insert([
    'idgrupo'=> $grupos['idgrupo'],
    'iddocente'=>$asesorTemp['idasesor'],
    'idtipoasesor'=>$asesorTemp['idtipoasesor']
  ]);

   Rol_carrera::firstOrCreate([
            'idrol'=>5,
            'idcarrera'=>Input::get('idcarrera'),
            'iddocente'=>$asesorTemp['idasesor'],
            'condicion'=>true
        ]);
 }

 foreach ($nuevaetapa as $nt) {
  if($nt->idtipotrabajo==$request->get('idtipoT')&&$nt->condicion==true){
  foreach ($request->estudiantes as $esTemp1) {

  $notas= new Notas();
    $notas->idgrupo = $grupos->idgrupo;
    $notas->idestudiante=$esTemp1;
    $notas->condicion=false;
    $notas->nota=0.0;
    $notas->idetapa=$nt->idetapa;
    $notas->save();
}
}
   
  }


 try { 
  $notificacion = array(
    'message' => 'El grupos se ha registrado con éxito.', 
    'alert-type' => 'info'
  );
} catch (Exception $e) { 
  $notificacion = array(
    'message' => 'El grupos No se ha registrado con éxito.', 
    'alert-type' => 'error'
  );
}    
return redirect()->back()->with($notificacion);       
}

    //////ver
public function show($id){

 return view('ues.grupos.show',["grupos"=>Grupo::findOrFail($id)]);
}

    ////// editar
public function edit($id){
 return view("ues.grupos.edit",["grupos"=>Grupo::findOrFail($id)]);

}

 















}
