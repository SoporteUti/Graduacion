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

class GrupoController extends Controller
{
  public function __construct()
  {
  }

  ////// index
  public function index(Request $request)
  {

    $estudiantes = Estudiante::all();
    $tiproceso = TipoTema::all();
    $docentes = Docente::all();
    $carreras = Carrera::all();
    $tipoasesor = TipoAsesor::all();
    $mostraintegrante = EstudianteGrupos::all();
    $asesores = GrupoDocente::all();
    $grupos = Grupo::all();
    $personas = Persona::all();
    $rol_carrera = rol_carrera::all();
    $cambiotema = cambioTema::all();
    $departamento = Departamento::all();
    $integrantes = DB::table('estudiantes')->select('estudiantes.idestudiante', 'estudiantes.carnet', 'estudiantes.idpersona', 'estudiantes.idcarrera')->leftjoin('estudiante_grupos', 'estudiantes.idestudiante', '=', 'estudiante_grupos.idestudiante')->where('estudiante_grupos.idestudiante', '=', null)->get();

    $aniomin = Grupo::min('fecharegistro');
    $fecharegistro = strtotime($aniomin);
    $aniomin = date("Y", $fecharegistro);
    $anio = Grupo::max('fecharegistro');
    $fecharegistro = strtotime($anio);
    $anio1 = date("Y", $fecharegistro);
    $nAcuerdos = grupo_solicitud::all();

    return view('ues.grupos.index')
      ->with('integrantes', $integrantes)
      ->with('grupos', $grupos)
      ->with('tiproceso', $tiproceso)
      ->with('tipoasesor', $tipoasesor)
      ->with('mostraintegrante', $mostraintegrante)
      ->with('estudiantes', $estudiantes)
      ->with('asesores', $asesores)
      ->with('carreras', $carreras)
      ->with('personas', $personas)
      ->with('rol_carrera', $rol_carrera)
      ->with('cambiotema', $cambiotema)
      ->with('docentes', $docentes)
      ->with('departamentos', $departamento)
      ->with('departamento', $departamento)
      ->with('anio1', $anio1)
      ->with('nAcuerdos', $nAcuerdos)
      ->with('aniomin', $aniomin);
  }

  //////////funcion guardar
  public function store(GrupoFormRequest $request)
  {
   // echo dd($request);
    $grupos = new Grupo;
    $nuevaetapa = nuevaetapa::all();
    $grupos->codigoG = $request->get('codigoG');
    $grupos->tema = $request->get('tema');
    $grupos->institucion = $request->get('institucion');
    $grupos->fecharegistro = $request->get('fecharegistro');
    $grupos->idtipotema = $request->get('idtipoT');
    $grupos->idcarrera = Input::get('idcarrera');
    //$grupos->idcarrera=$request->get('carr');
    $grupos->condicion = true;
    $grupos->save();
    ////propuesta
    // dd($request); 
    if ($request->file('propuesta') != null) {
      $file = $request->file('propuesta');
      //obtenemos el nombre del archivo
      $nombre = $file->getClientOriginalName();
      $ruta = $grupos->idgrupo;
      //indicamos que queremos guardar un nuevo archivo en el disco local
      \Storage::disk('propuestas')->put('/' . $ruta . '/' . $ruta . '-Propuesta.pdf',  \File::get($file));
      $grupos->propuesta = $ruta . '/' . $ruta . '-Propuesta.pdf';
      $grupos->update();
    }


    foreach ($request->estudiantes as $esTemp) {

      $ed = new EstudianteGrupos();
      $ed->idgrupo = $grupos->idgrupo;
      $ed->idestudiante = $esTemp;
      $ed->save();
    }

    foreach ($request->asesor as $asesorTemp) {
      DB::table('grupos_docentes')->insert([
        'idgrupo' => $grupos['idgrupo'],
        'iddocente' => $asesorTemp['idasesor'],
        'idtipoasesor' => $asesorTemp['idtipoasesor']
      ]);

      Rol_carrera::firstOrCreate([
        'idrol' => 5,
        'idcarrera' => Input::get('idcarrera'),
        'iddocente' => $asesorTemp['idasesor'],
        'condicion' => true
      ]);
    }

    foreach ($nuevaetapa as $nt) {
      if ($nt->idtipotrabajo == $request->get('idtipoT') && $nt->condicion == true) {
        foreach ($request->estudiantes as $esTemp1) {

          $notas = new Notas();
          $notas->idgrupo = $grupos->idgrupo;
          $notas->idestudiante = $esTemp1;
          $notas->condicion = false;
          $notas->nota = 0.0;
          $notas->idetapa = $nt->idetapa;
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
  public function show($id)
  {

    return view('ues.grupos.show', ["grupos" => Grupo::findOrFail($id)]);
  }

  ////// editar
  public function edit($id)
  {
    return view("ues.grupos.edit", ["grupos" => Grupo::findOrFail($id)]);
  }

  ////////
  public function llenargrupos($id)
  {

    $nAcuerdos = grupo_solicitud::all();
    $gsol = grupo_solicitud::all()->sortBy('idgrupsol');
    $etapas = nuevaetapa::all();
    $tiproceso = TipoTema::all();
    $grupos = Grupo::findOrFail($id);
    $Solicitudes = Solicitud::all();
    $progai = Prorrogai::all();
    $progajd = Prorrogajd::all();
    $estudiantes = Estudiante::all();
    $mostraintegrante = EstudianteGrupos::all();
    $personas = Persona::all();
    $asesores = GrupoDocente::all();
    $docentes = Docente::all();
    $tipoasesor = TipoAsesor::all();
    $roles = Rol::all();
    $pers = Periodo::all();
    $fechas = Fecha::all();
    $cambiotema = cambioTema::all();
    $rol_carrera = rol_carrera::all();
    $tribunal = DocenteSolicitud::all();
    $solirepro = solicitud_reprobacion::all();
    $solicitudc = solicitudc::all();
    //enviado por ovidio 28_03_19
    $ni = notificacion_inasistencia::all();
    $re = renuncia::all();
    $ni1 = notificacion_inasistencia::all();
    $pocentaje = Ponderacion::all();
    $notas = Notas::all();
    $departamento = Departamento::all();
    $consulta1 = grupo_solicitud::where('idgrupo', '=', $id)->where('idsolicitud', '=', 1)->where('condicion', '=', true)->count();
    $consulta2 = etapas_grupos::where('idgrupo', '=', $id)->where('estado', '=', 1)->where('condicion', '=', true)->count();
    $etapaactiva = etapas_grupos::all();
    //dd($grupos->tema_grupo->nuevaetapas->sortBy('idetapa'));
    /*dd($grupos);*/
    $fechas = array();
    $gantt = '';
    if ($grupos->periodo) {
      $grupos->periodo->fFin;
      $temp = $grupos->periodo->fInicio;
      array_push($fechas, array('label' => 'Periodo de Trabajo de graduaciòn', 'start' => $grupos->periodo->fInicio, 'end' => $grupos->periodo->fFin));
      foreach ($grupos->periodo->fechas->sortBy('fechasetapas') as $etapa) {
        if ($etapa->etapa->condicion == true)
          array_push($fechas, array('label' => $etapa->etapa->idnombreetapa, 'start' => $temp, 'end' => $etapa->fechasetapas));
        $temp = $etapa->fechasetapas;
      }
      $gantt = new Gantt($fechas);
    }

    $idetapa = Notas::where('idgrupo', '=', $id)->where('condicion', '=', true)->orderBy('idetapa', 'desc')->first();
    $idetapa1 = Notas::where('idgrupo', '=', $id)->where('condicion', '=', true)->orderBy('idetapa', 'desc')->first();

    return view("ues.grupos.steps")
      ->with('grupos', $grupos)
      ->with('gantt', $gantt)
      ->with('tiproceso', $tiproceso)
      ->with('etapas', $etapas)
      ->with('Solicitudes', $Solicitudes)
      ->with('estudiantes', $estudiantes)
      ->with('mostraintegrante', $mostraintegrante)
      ->with('personas', $personas)
      ->with('asesores', $asesores)
      ->with('docentes', $docentes)
      ->with('tipoasesor', $tipoasesor)
      ->with('roles', $roles)
      ->with('progai', $progai)
      ->with('progajd', $progajd)
      ->with('cambiotema', $cambiotema)
      ->with('rol_carrera', $rol_carrera)
      ->with('gsol', $gsol)
      ->with('fechas', $fechas)
      ->with('tribunal', $tribunal)
      ->with('solirepro', $solirepro)
      ->with('consulta1', $consulta1)
      ->with('consulta2', $consulta2)
      ->with('etapaactiva', $etapaactiva)
      ->with('pers', $pers)
      ->with('ni', $ni)
      ->with('ni1', $ni1)
      ->with('solicitudc', $solicitudc)
      ->with('porc', $pocentaje)
      ->with('notas', $notas)
      ->with('idetapa', $idetapa)
      ->with('idetapa1', $idetapa1)
      ->with('re', $re)
      ->with('nAcuerdos', $nAcuerdos)
      ->with('departamento', $departamento);
  }


  public function llenargruposAsesoria($id)
  {




    $gsol = grupo_solicitud::all();
    $etapas = nuevaetapa::all();
    $tiproceso = TipoTema::all();
    $grupos = Grupo::findOrFail($id);
    $Solicitudes = Solicitud::all();
    $progai = Prorrogai::all();

    $estudiantes = Estudiante::all();
    $mostraintegrante = EstudianteGrupos::all();
    $personas = Persona::all();
    $asesores = GrupoDocente::all();
    $docentes = Docente::all();
    $tipoasesor = TipoAsesor::all();
    $roles = Rol::all();
    $cambiotema = cambioTema::all();
    $pers = Periodo::all();
    $fechas = Fecha::all();
    $rol_carrera = rol_carrera::all();
    $tribunal = DocenteSolicitud::all();
    $solirepro = solicitud_reprobacion::all();
    $departamento = departamento::all();

    /*dd($grupos);*/
    return view("ues.grupos.stepsAsesoria")
      ->with('grupos', $grupos)
      ->with('tiproceso', $tiproceso)
      ->with('etapas', $etapas)
      ->with('Solicitudes', $Solicitudes)
      ->with('estudiantes', $estudiantes)
      ->with('mostraintegrante', $mostraintegrante)
      ->with('personas', $personas)
      ->with('asesores', $asesores)
      ->with('docentes', $docentes)
      ->with('tipoasesor', $tipoasesor)
      ->with('roles', $roles)
      ->with('progai', $progai)

      ->with('cambiotema', $cambiotema)
      ->with('rol_carrera', $rol_carrera)
      ->with('gsol', $gsol)
      ->with('fechas', $fechas)
      ->with('pers', $pers)
      ->with('tribunal', $tribunal)
      ->with('solirepro', $solirepro)
      ->with('departamento', $departamento);
  }


  public function llenargruposasesor($id)
  {




    $gsol = grupo_solicitud::all()->sortBy('idgrupsol');
    $etapas = nuevaetapa::all();
    $tiproceso = TipoTema::all();
    $grupos = Grupo::findOrFail($id);
    $Solicitudes = Solicitud::all();
    $progai = Prorrogai::all();
    $progajd = Prorrogajd::all();
    $estudiantes = Estudiante::all();
    $mostraintegrante = EstudianteGrupos::all();
    $personas = Persona::all();
    $asesores = GrupoDocente::all();
    $docentes = Docente::all();
    $tipoasesor = TipoAsesor::all();
    $roles = Rol::all();
    $pers = Periodo::all();
    $fechas = Fecha::all();
    $cambiotema = cambioTema::all();
    $rol_carrera = rol_carrera::all();
    $tribunal = DocenteSolicitud::all();
    $solirepro = solicitud_reprobacion::all();
    $departamento = departamento::all();
    $etapaactiva = etapas_grupos::all();
    $ni = notificacion_inasistencia::all();
    $ni1 = notificacion_inasistencia::all();
    /*dd($grupos);*/
    return view("ues.grupos.vista_asesor")
      ->with('grupos', $grupos)
      ->with('tiproceso', $tiproceso)
      ->with('etapas', $etapas)
      ->with('Solicitudes', $Solicitudes)
      ->with('estudiantes', $estudiantes)
      ->with('mostraintegrante', $mostraintegrante)
      ->with('personas', $personas)
      ->with('asesores', $asesores)
      ->with('docentes', $docentes)
      ->with('tipoasesor', $tipoasesor)
      ->with('cambiotema', $cambiotema)
      ->with('roles', $roles)
      ->with('progai', $progai)
      ->with('progajd', $progajd)
      ->with('pers', $pers)
      ->with('fechas', $fechas)
      ->with('rol_carrera', $rol_carrera)
      ->with('tribunal', $tribunal)
      ->with('solirepro', $solirepro)
      ->with('etapaactiva', $etapaactiva)
      ->with('gsol', $gsol)
      ->with('ni', $ni)
      ->with('ni1', $ni1)
      ->with('departamento', $departamento);
  }

  public function llenargrupoestudiante($id)
  {




    $gsol = grupo_solicitud::all()->sortBy('idgrupsol');
    $etapas = nuevaetapa::all();
    $tiproceso = TipoTema::all();
    $grupos = Grupo::findOrFail($id);
    $Solicitudes = Solicitud::all();
    $progai = Prorrogai::all();
    $progajd = Prorrogajd::all();
    $estudiantes = Estudiante::all();
    $mostraintegrante = EstudianteGrupos::all();
    $personas = Persona::all();
    $asesores = GrupoDocente::all();
    $docentes = Docente::all();
    $tipoasesor = TipoAsesor::all();
    $roles = Rol::all();
    $pers = Periodo::all();
    $fechas = Fecha::all();
    $cambiotema = cambioTema::all();
    $rol_carrera = rol_carrera::all();
    $tribunal = DocenteSolicitud::all();
    $solirepro = solicitud_reprobacion::all();

    $etapaactiva = etapas_grupos::all();
    $ni = notificacion_inasistencia::all();
    $ni1 = notificacion_inasistencia::all();
    $pocentaje = Ponderacion::all();
    $notas = Notas::all();
    $departamento = departamento::all();
    /*dd($grupos);*/
    return view("ues.grupos.vista_estudiante")
      ->with('grupos', $grupos)
      ->with('tiproceso', $tiproceso)
      ->with('etapas', $etapas)
      ->with('Solicitudes', $Solicitudes)
      ->with('estudiantes', $estudiantes)
      ->with('mostraintegrante', $mostraintegrante)
      ->with('personas', $personas)
      ->with('asesores', $asesores)
      ->with('docentes', $docentes)
      ->with('tipoasesor', $tipoasesor)
      ->with('cambiotema', $cambiotema)
      ->with('roles', $roles)
      ->with('progai', $progai)
      ->with('progajd', $progajd)
      ->with('pers', $pers)
      ->with('fechas', $fechas)
      ->with('rol_carrera', $rol_carrera)
      ->with('tribunal', $tribunal)
      ->with('solirepro', $solirepro)
      ->with('etapaactiva', $etapaactiva)
      ->with('gsol', $gsol)
      ->with('ni', $ni)
      ->with('porc', $pocentaje)
      ->with('notas', $notas)
      ->with('ni1', $ni1)
      ->with('departamento', $departamento);
  }

  public function llenargruposdirector($id)
  {

    $gsol = grupo_solicitud::all()->sortBy('idgrupsol');
    $etapas = nuevaetapa::all();
    $tiproceso = TipoTema::all();
    $grupos = Grupo::findOrFail($id);
    $Solicitudes = Solicitud::all();
    $progai = Prorrogai::all();
    $progajd = Prorrogajd::all();
    $estudiantes = Estudiante::all();
    $mostraintegrante = EstudianteGrupos::all();
    $personas = Persona::all();
    $cambiotema = cambioTema::all();
    $asesores = GrupoDocente::all();
    $pers = Periodo::all();
    $fechas = Fecha::all();
    $docentes = Docente::all();
    $tipoasesor = TipoAsesor::all();
    $roles = Rol::all();
    $rol_carrera = rol_carrera::all();
    $tribunal = DocenteSolicitud::all();
    $solirepro = solicitud_reprobacion::all();
    $ni = notificacion_inasistencia::all();
    $ni1 = notificacion_inasistencia::all();
    $re = renuncia::all();
    $departamento = Departamento::all();
    /*dd($grupos);*/
    return view("ues.grupos.vista_director")
      ->with('grupos', $grupos)
      ->with('tiproceso', $tiproceso)
      ->with('etapas', $etapas)
      ->with('Solicitudes', $Solicitudes)
      ->with('estudiantes', $estudiantes)
      ->with('mostraintegrante', $mostraintegrante)
      ->with('personas', $personas)
      ->with('asesores', $asesores)
      ->with('docentes', $docentes)
      ->with('tipoasesor', $tipoasesor)
      ->with('roles', $roles)
      ->with('cambiotema', $cambiotema)
      ->with('progai', $progai)
      ->with('progajd', $progajd)
      ->with('rol_carrera', $rol_carrera)
      ->with('tribunal', $tribunal)
      ->with('solirepro', $solirepro)
      ->with('pers', $pers)
      ->with('fechas', $fechas)
      ->with('gsol', $gsol)
      ->with('ni', $ni)
      ->with('ni1', $ni1)
      ->with('re', $re)
      ->with('departamento', $departamento);
  }



  public function pdfEstadisticos(Request $request)
  {

    $anioseleccionado = null;
    $estado = null;
    $carrera = null;
    $departamento = null;
    $grupos = new Collection();


    //dd($grupos, $request->input('estado'));

    if ($request->input('anioselec') != -1 && $request->input('estado') != -1 && $request->input('carrera') != -1) {



      if ($request->get('dept') != -1) {
        $anioseleccionado = $request->input('anioselec');
        $estado = ($request->input('estado')) ? 'Activos' : 'Inactivos';
        $carrera = Carrera::find($request->input('carrera'));
        $departamento = Departamento::find($request->get('dept'));
        $grupos = Grupo::where([
          ['idcarrera', '=', $carrera->idcarrera],
          ['condicion', '=', $request->input('estado')],
          ['fecharegistro', '>=', date("$anioseleccionado-01-01")],
          ['fecharegistro', '<=', date("$anioseleccionado-12-31")],
        ])->get();
        // dd($grupos,'todos los campos');
      }
    } else {
      if ($request->input('anioselec') == -1 && $request->input('estado') == -1 && $request->input('carrera') == -1) {

        $departamento = Departamento::find($request->get('dept'));
        foreach ($departamento->carreras as $carrera_temp) {
          $grupos = $grupos->merge(Grupo::where('idcarrera', '=', $carrera_temp->idcarrera)->get());
        }
        // dd($grupos,$anioseleccionado,$estado,$carrera,'Departamento');
      } else {
        if ($request->input('anioselec') == -1 && $request->input('estado') == -1 && $request->input('carrera') != -1) {
          $carrera = Carrera::find($request->get('carrera'));


          $grupos = $grupos->merge(Grupo::where('idcarrera', '=', $carrera->idcarrera)->get());
        } else {
          if ($request->input('anioselec') != -1 && $request->input('estado') == -1 && $request->input('carrera') == -1) {
            $anioseleccionado = $request->input('anioselec');

            $grupos = $grupos->merge(Grupo::where([
              ['fecharegistro', '>=', date("$anioseleccionado-01-01")],
              ['fecharegistro', '<=', date("$anioseleccionado-12-31")],
            ])->get());
          }
          if ($request->input('anioselec') == -1 && $request->input('estado') != -1 && $request->input('carrera') == -1) {

            $estado = ($request->input('estado') == 1) ? 'Activos' : 'Inactivos';
            $grupos = Grupo::where('condicion', '=', ($request->input('estado') == 1) ? true : false)->get();
            //dd(Grupo::where('condicion','=', ($request->input('estado')))->get());

          } //dd($grupos, $estado);
        }
      } //return redirect()->back();
    }




    $pdf = \PDF::loadview('ues.grupos.pdfestadistico',  array(
      'anioseleccionado' => $anioseleccionado, 'estado' => $estado, 'carrera' => $carrera, 'grupos' => $grupos, 'departamento' => $departamento
    ))->setPaper('letter', 'portrait');
    return $pdf->stream('Informacion.pdf');
  }

  public function get_carreras_departamentos(Departamento $departamento)
  {
    return response()->json([
      'id_depto' => $departamento,
      'carreras' => $departamento->carreras()->where('condicion', true)->get()
    ]);
  }

  public function get_years_trabajos(Carrera $carrera)
  {
    $years = array();
    foreach (Grupo::where('idcarrera', $carrera->idcarrera)->get() as $grupo) {
      array_push($years, \Carbon\Carbon::parse($grupo->fecharegistro)->format('Y'));
    }

    return response()->json([
      'carrera' => $carrera,
      'years' => array_unique($years, SORT_NUMERIC)
    ]);
  }


  /////editar-actualizar
  public function update(GrupoFormRequest $request, $id)
  {

    $grupos = Grupo::findOrFail($id);

    $grupos->codigoG = $request->get('codigoG');
    $grupos->fecharegistro = $request->get('fecharegistro');
    $grupos->tema = $request->get('tema');
    $grupos->idtipotema = $request->get('idtipoT');
    //$grupos->idcarrera=$request->get('carr');
    $grupos->condicion = true;
    ////propuesta

    // dd($request); 
    if ($request->file('propuesta') != null) {
      $file = $request->file('propuesta');
      //obtenemos el nombre del archivo
      $nombre = $file->getClientOriginalName();
      $ruta = $request->get('idgrupo');
      //indicamos que queremos guardar un nuevo archivo en el disco local
      \Storage::disk('propuestas')->put('/' . $ruta . '/' . $ruta . '-Propuesta.pdf',  \File::get($file));
      $grupos->propuesta = $ruta . '/' . $ruta . '-Propuesta.pdf';
    }


    $grupos->update();

    $notificacion = array(
      'message' => 'El Grupo se ha Modificado con éxito.',
      'alert-type' => 'info'
    );

    //return redirect()->back()->with($notificacion);
    return Redirect::to('ues/grupos')->with($notificacion);
  }

  /////////// dar de baja y alta
  public function destroy($id)
  {

    $grupos = Grupo::findOrFail($id);
    if ($grupos->condicion == false) {
      $grupos->condicion = true;
      $notificacion = array(
        'message' => 'El Grupo se ha Dado de Alta.',
        'alert-type' => 'info'
      );
    } else {
      $grupos->condicion = false;
      $notificacion = array(
        'message' => 'El Grupo se ha Dado de Baja.',
        'alert-type' => 'info'
      );
    }
    $grupos->update();

    return Redirect::to('ues/grupos')->with($notificacion);
    //return redirect()->back()->with($notificacion);
    //return Redirect::to('ues/carreras')->with($notificacion);
  }


  /*--Valida Codigo depto--*/
  public function postCodigoGrupoValid(Request $request)
  {

    $id = $request->input('id');

    if (isset($id)) {
      $usuR = $request->input('codigoG');
      $isAvailable = true;
      $resultado = Grupo::where('codigoG', '=', $usuR)->where('id', '!=', $id)->count();
      if ($resultado == 1) {
        $isAvailable = false;
      }
      echo json_encode(array(
        'valid' => $isAvailable,
      ));
    } else {
      $usuR = $request->input('codigoG');
      $isAvailable = true;
      $resultado = Grupo::where('codigoG', '=', $usuR)->count();
      if ($resultado == 1) {
        $isAvailable = false;
      }
      echo json_encode(array(
        'valid' => $isAvailable,
      ));
    }
  }

  //para validar la institucion
   /*--Valida Codigo depto--*/
   public function postInstitucionValid(Request $request)
   {
 
     
    $id = $request->input('id');

    if (isset($id)) {
      $usuR = $request->input('institucion');
      $isAvailable = true;
      $resultado = Grupo::where('institucion', '=', $usuR)->where('id', '!=', $id)->count();
      if ($resultado == 1) {
        $isAvailable = false;
      }
      echo json_encode(array(
        'valid' => $isAvailable,
      ));
    } else {
      $usuR = $request->input('institucion');
      $isAvailable = true;
      $resultado = Grupo::where('institucion', '=', $usuR)->count();
      if ($resultado == 1) {
        $isAvailable = false;
      }
      echo json_encode(array(
        'valid' => $isAvailable,
      ));
    }
   }

  //para validar la institucion fin


  /*--Valida Codigo depto--*/
  public function postTemaValid(Request $request)
  {

    $id = $request->input('id');

    if (isset($id)) {
      $usuR = $request->input('codigoG');
      $isAvailable = true;
      $resultado = Grupo::where('codigoG', '=', $usuR)->where('id', '!=', $id)->count();
      if ($resultado == 1) {
        $isAvailable = false;
      }
      echo json_encode(array(
        'valid' => $isAvailable,
      ));
    } else {
      $usuR = $request->input('codigoG');
      $isAvailable = true;
      $resultado = Grupo::where('codigoG', '=', $usuR)->count();
      if ($resultado == 1) {
        $isAvailable = false;
      }
      echo json_encode(array(
        'valid' => $isAvailable,
      ));
    }
  }

  public function asistencia(Request $request, $idgrupo)
  {
    //dd($request);
    $grupo_asistencia = GrupoAsistencia::create([
      'fecha_asistencia' => $request->fecha_asistencia,
      'hora_inicio' => $request->hora_inicio,
      'hora_final' => $request->hora_final,
      'idgrupo' => $idgrupo
    ]);

    foreach ($request->estudiante as $alumno) {
      AlumnoAsistencia::create([
        'idestudiante' => $alumno['idestudiante'],
        'asistencia' => $alumno['asistencia'],
        'grupo_asistencia_id' => $grupo_asistencia->id
      ]);
    }
    $notificacion = array(
      'message' => 'La Asistencia a la asesoria ha sido guardada.',
      'alert-type' => 'info'
    );
    return redirect()->back()->with($notificacion);
  }
  //////////////////
  public function periodos_fechas(Request $request, $idgrupo)
  {
    //dd($request);
    if (isset($request->idperiodo)) {
      $periodo = Periodo::findOrFail($request->idperiodo);
      $periodo->fInicio = $request->get('fInicioPeriodo');
      $periodo->fFin = $request->get('fFinPeriodo');
      $periodo->update();

      foreach ($request->periodo_fechas as $fecha) {
        $temp_fecha = Fecha::findOrFail($fecha['idfecha']);
        $temp_fecha->fechasetapas = $fecha['fecsetapas'];
        $temp_fecha->update();
      }
    } else {
      $periodo = Periodo::create([
        'fInicio' => $request->get('fInicioPeriodo'),
        'fFin' => $request->get('fFinPeriodo'),
        'idgrupo' => $request->idgrupo
      ]);
      foreach ($request->periodo_fechas as $fecha) {
        Fecha::create([
          'idperiodo' => $periodo->idperiodo,
          'idnuevaetapa' => $fecha['idnuevaetapa'],
          'fechasetapas' => $fecha['fecsetapas'],
          'condicion' => true
        ]);
      }
    }

    try {
      $notificacion = array(
        'message' => 'Las fechas se han registrado con éxito.',
        'alert-type' => 'info'
      );
    } catch (Exception $e) {
      $notificacion = array(
        'message' => 'Las fechas no se han registrado con éxito.',
        'alert-type' => 'error'
      );
    }
    return redirect()->back()->with($notificacion);
  }
  ////////////////


  /////////////////

  //d/m/Y
  //hh:mm A

  public function gnotas(Request $request)
  {

    $estudiantes = Estudiante::all();

    $notas = new Notas();
    $selecnotas = Notas::all();
    $numet = DB::table('etapas_grupos')->where('idgrupo', '=', $request->input('idgrupo'))
      ->count();

    $bandera = false;

    if ($numet == $request->input('idetapa')) {

      $cbandera = grupo_solicitud::where('idgrupo', '=', $request->input('idgrupo'))->where('idsolicitud', '=', 4)->where('estado', '=', 1)->count();
      if ($cbandera > 0) {
        $bandera = true;
      }
    } else {
      $bandera = true;
    }

    if ($bandera == true) {
      foreach ($estudiantes as $est) {
        $idgrupo = $request->input('idgrupo');

        $nota = $request->input($est['idestudiante']);
        if ($nota) {

          foreach ($selecnotas as $notas) {
            if ($notas->idestudiante == $est['idestudiante'] && $notas->idgrupo == $request->input('idgrupo') && $notas->idetapa == $request->input('idetapa')) {
              $notas->nota = $nota;
              $notas->condicion = true;
              $notas->update();
            }
          }
        }
      }

      $etapas_grupos = etapas_grupos::all();


      $cont = 0;

      foreach ($etapas_grupos as $et) {

        if ($et->idgrupo == $idgrupo && $et->estado == 1) {
          $et->estado = 0;
          $et->update();
          $eta = $et->idnuevaetapa;
          $next = $eta + 1;
        }
      }


      foreach ($etapas_grupos as $et) {


        if ($et->idgrupo == $idgrupo && $et->idnuevaetapa == $next) {

          $et->estado = 1;
          $et->update();
        }
      }

      $notificacion = array(
        'message' => 'Notas Registradas con Exito.',
        'alert-type' => 'info'
      );
    } else {

      $notificacion = array(
        'message' => 'Notas no Registradas.',
        'alert-type' => 'warning'
      );
    }

    return redirect()->back()->with($notificacion);
  }



  public function getnotas(Request $request)
  {


    $idgrupo = $request->get('idgrupo');
    $idetapa = $request->get('idetapa');
    $not = Notas::join('estudiante_grupos', 'estudiante_grupos.idestudiante', '=', 'notas.idestudiante')->where('notas.idgrupo', '=', $idgrupo)->where('notas.idetapa', '=', $idetapa)->get();

    return response()->json([
      'not' => $not,
      'idgrupo' => $idgrupo,
      'idetapa' => $idetapa
    ]);
  }

  public function editarnotas(Request $request)
  {



    $estudiantes = Estudiante::all();

    $notas = Notas::all();
    foreach ($estudiantes as $est) {
      $idgrupo = $request->input('idgrupo');
      $etapaselect = $request->input('etapaselect');

      $nota = $request->input("u" . $est['idestudiante']);
      if ($nota) {

        foreach ($notas as $not) {

          if ($not->idestudiante == $est['idestudiante'] && $not->idetapa == $etapaselect) {

            $not->nota = $nota;

            $not->update();
          }
        }
      }
    }

    $notificacion = array(
      'message' => 'Notas Actualizadas con Exito.',
      'alert-type' => 'info'
    );

    return redirect()->back()->with($notificacion);
  }


  ////renuncia al proceso de graduacion






  // pdf lista de grupos
  public function pdflistaGrup()
  {

    $tiproceso = TipoTema::all();
    $grupos = Grupo::all();
    $carreras = Carrera::all();
    $nAcuerdos = grupo_solicitud::all();
    $tg = Grupo::where('condicion', '=', 1)->get();

    //$grupos=Grupo::all();
    $pdf = \PDF::loadview('ues.grupos.listaGrup',  array('tg' => $tg, 'nAcuerdos' => $nAcuerdos, 'carreras' => $carreras, 'tiproceso' => $tiproceso, 'grupos' => $grupos))->setPaper('letter', 'portrait');
    return $pdf->stream('Lista_Grupo_Activos.pdf');

    // return view("ues.grupos.listaGrup",array('tiproceso' =>$tiproceso,'grupos' =>$grupos));
  }

  public function pdflistaGrupI()
  {

    $tiproceso = TipoTema::all();
    $grupos = Grupo::all();
    $carreras = Carrera::all();

    $pdf = \PDF::loadview('ues.grupos.listaGrupI',  array('carreras' => $carreras, 'tiproceso' => $tiproceso, 'grupos' => $grupos))->setPaper('letter', 'portrait');
    return $pdf->stream('Lista_Grupo_Inactivos.pdf');
  }

  public function pdfPerfilGrup($id)
  {
    $tiproceso = TipoTema::all();
    $grupos = Grupo::findOrFail($id);
    $estudiantes = Estudiante::all();
    $carreras = Carrera::all();
    $personas = Persona::all();
    $mostraintegrante = EstudianteGrupos::all();
    $asesores = GrupoDocente::all();
    $docentes = Docente::all();
    $tipoasesor = TipoAsesor::all();
    $gsol = grupo_solicitud::all()->sortBy('idgrupsol');
    $Solicitudes = Solicitud::all();
    $roles = Rol::all();
    $nAcuerdos = grupo_solicitud::all();

    $fechas = array();
    $gantt = '';
    if ($grupos->periodo) {
      array_push($fechas, array('label' => 'Periodo de Trabajo de graduaciòn', 'start' => $grupos->periodo->fInicio, 'end' => $grupos->periodo->fFin));
      $temp = $grupos->periodo->fInicio;
      foreach ($grupos->periodo->fechas->sortBy('fechasetapas') as $etapa) {
        array_push($fechas, array('label' => $etapa->etapa->idnombreetapa, 'start' => $temp, 'end' => $etapa->fechasetapas));
        $temp = $etapa->fechasetapas;
      }
      $gantt = new Gantt($fechas);
    }


    $pdf = \PDF::loadview('ues.grupos.perfilGrup',  array('gantt' => $gantt, 'roles' => $roles, 'gsol' => $gsol, 'Solicitudes' => $Solicitudes, 'tiproceso' => $tiproceso, 'grupos' => $grupos, 'estudiantes' => $estudiantes, 'carreras' => $carreras, 'personas' => $personas, 'mostraintegrante' => $mostraintegrante, 'asesores' => $asesores, 'docentes' => $docentes, 'tipoasesor' => $tipoasesor, 'nAcuerdos' => $nAcuerdos))->setPaper('letter', 'portrait');
    return $pdf->stream('Perfil_Grupo.pdf');

    // return view("ues.grupos.perfilGrup",array('tiproceso' =>$tiproceso,'grupos' =>$grupos,'estudiantes'=>$estudiantes,'carreras'=>$carreras,'personas'=>$personas,'mostraintegrante'=>$mostraintegrante,'asesores'=>$asesores,'docentes'=>$docentes,'tipoasesor'=>$tipoasesor));

  }

  /////notas pdf
  public function pdfNotas()
  {


    $tiproceso = TipoTema::all();
    $grupos = Grupo::findOrFail(Input::get('idgrupo'));
    $estudiantes = Estudiante::all();
    $carreras = Carrera::all();
    $personas = Persona::all();
    $mostraintegrante = EstudianteGrupos::all();
    $asesores = GrupoDocente::all();
    $docentes = Docente::all();
    $docentes = Docente::all();
    $tipoasesor = TipoAsesor::all();
    $seleEtapas = Input::get('etapas');
    $etapas = nuevaetapa::all();
    $etapas_grupos = etapas_grupos::where('idgrupo', '=', Input::get('idgrupo'))->where('estado', '=', 1)->count();


    $notas = Notas::all();

    $dt = DocenteSolicitud::all();
    $gruposoli = grupo_solicitud::all();

    $contador = Input::get('idne');


    $pdf = \PDF::loadview('ues.grupos.impNotas',  array('contador' => $contador, 'dt' => $dt, 'gruposoli' => $gruposoli, 'tiproceso' => $tiproceso, 'seleEtapas' => $seleEtapas, 'tipoasesor' => $tipoasesor, 'estudiantes' => $estudiantes, 'grupos' => $grupos, 'etapas' => $etapas, 'carreras' => $carreras, 'personas' => $personas, 'mostraintegrante' => $mostraintegrante, 'docentes' => $docentes, 'asesores' => $asesores, 'etapas_grupos' => $etapas_grupos, 'notas' => $notas))->setPaper('letter', 'portrait');
    return $pdf->stream('Notas_Etapas.pdf');
  }


  public function notasTot($id)
  {

    $grupos = Grupo::findOrFail($id);

    $tiproceso = TipoTema::all();
    $etapas = nuevaetapa::all();
    $porcentaje = Ponderacion::all();
    $mostraintegrante = EstudianteGrupos::all();
    $estudiantes = Estudiante::all();
    $personas = Persona::all();
    $notas = Notas::all();
    $rol_carrera = rol_carrera::all();
    $carrera = Carrera::all();
    $docentes = Docente::all();
    $rol = Rol::all();

    $pdf = \PDF::loadview('ues.grupos.notasG',  array('rol' => $rol, 'docentes' => $docentes, 'carrera' => $carrera, 'rol_carrera' => $rol_carrera, 'notas' => $notas, 'personas' => $personas, 'estudiantes' => $estudiantes, 'mostraintegrante' => $mostraintegrante, 'porcentaje' => $porcentaje, 'etapas' => $etapas, 'grupos' => $grupos, 'tiproceso' => $tiproceso))->setPaper('letter', 'portrait');

    return $pdf->stream('Nota_Grupo.pdf');
  }

  public function pdfcronograma($id)
  {

    $grupos = Grupo::findOrFail($id);
    $fechas = array();
    $gantt = '';
    if ($grupos->periodo) {
      array_push($fechas, array('label' => 'Periodo de Trabajo de graduaciòn', 'start' => $grupos->periodo->fInicio, 'end' => $grupos->periodo->fFin));
      $temp = $grupos->periodo->fInicio;
      foreach ($grupos->periodo->fechas->sortBy('fechasetapas') as $etapa) {
        array_push($fechas, array('label' => $etapa->etapa->idnombreetapa, 'start' => $temp, 'end' => $etapa->fechasetapas));
        $temp = $etapa->fechasetapas;
      }
      $gantt = new Gantt($fechas);
    }
    //dd($gantt);

    $pdf = \PDF::loadview('ues.grupos.cronogramapdf',  array('gantt' => $gantt, 'grupos' => $grupos))->setPaper('letter', 'landscape');
    return $pdf->stream('Cronograma.pdf');
  }

  // pdf estadisticos



}
