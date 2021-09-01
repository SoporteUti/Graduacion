<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;
use sispg\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sispg\Http\Requests\solicitudFormRequest;
use DB;
use sispg\Carrera;
use sispg\Solicitud;
use sispg\Departamento;
use sispg\Docente;
use sispg\Estudiante;
use sispg\EstudianteGrupos;
use sispg\nuevaetapa;
use sispg\Facultad;
use sispg\Grupo;
use sispg\Persona;
use sispg\GrupoDocente;
use sispg\TipoTema;
use sispg\TipoAsesor;
use sispg\User;
use sispg\Rol_carrera;
use sispg\DocenteSolicitud;
use sispg\solicitud_reprobacion;
use sispg\Rol;
use sispg\Prorrogai;
use sispg\Prorrogajd;
use sispg\Ratificacion;
use sispg\Enunciado;
////////////////////////////
use sispg\grupo_solicitud;
use sispg\etapas_grupos;
use sispg\notificacion_inasistencia;

use sispg\Notas;
use sispg\Ponderacion;

use sispg\renuncia;
////////////////////bitacora/////
use sispg\Bitacora;
use sispg\solicitudc;
use Auth;
use sispg\Utils\UtilFunctions;

//IMPORT NOTIFICACIONES
use sispg\Notifications\{
    SolicitudAprobacionTema,
    SolicitudIrorrogaInterna,
    SolicitudRatificacionResultados,
    SolicitudRatificacionTribunal,
    SolicitudReprobacionAbandono,
    SolicitudPJD,
    NotificacionInasistencia
};

class solicitudController extends Controller
{
    public function __construc()
    {
    }

    public function index()
    {


        return view('ues.solicitudes.index');
    }

    public function create()
    {
    }

    public function store()
    {
    }
    public function show($id)
    {
    }
    public function edit()
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
    //Cancelar solicitud
    public function cancelar()
    {
        $sc = new solicitudc();
        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        $gs->condicion = false;
        $gs->update();

        $sc->idgrupsol = Input::get('idsolicitud');
        $sc->motivo = Input::get('motivo');
        $sc->condicion = true;
        $sc->save();
        $notificacion = array(
            'message' => 'Solicitud Cancelada con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }


    ///////////////////////////////////////creada por el corrdinador y enviada a director//////////////////////////////////////////////////////////////
    public function aprovaciont()
    {
        $time1 = date('d-m-Y');
        $gs = new grupo_solicitud();
        $time = strtotime(Input::get('fechar'));

        $newformat = date('d-m-Y', $time);

        echo $newformat;

        $idgrupo = Input::get('idgrupo');

        $gs->idsolicitud = Input::get('idsolicitud');
        $netapas = Input::get('netapas');
        $abc = false;
        $consulta0 = etapas_grupos::all();
        foreach ($consulta0 as $c0) {
            if ($c0->idgrupo == $idgrupo) {
                $abc = true;
            }
        }

        if ($abc == false) {
            for ($i = 1; $i <= $netapas; $i++) {
                if ($i == 1) {
                    DB::table('etapas_grupos')->insert([
                        'idgrupo' => Input::get('idgrupo'),
                        'idnuevaetapa' => $i,
                        'estado' => 1,
                        'condicion' => true
                    ]);
                } else {
                    DB::table('etapas_grupos')->insert([
                        'idgrupo' => Input::get('idgrupo'),
                        'idnuevaetapa' => $i,
                        'estado' => 0,
                        'condicion' => true
                    ]);
                }
            }
        }

        $consulta = etapas_grupos::all();
        $gs->fecha = $newformat;
        $gs->idgrupo = Input::get('idgrupo');
        $gs->estado = 4;
        $gs->fechaenv = $time1;
        $gs->idpersona = \Auth::user()->idpersona;
        foreach ($consulta as $c) {
            if ($c->idgrupo == $idgrupo && $c->estado == 1) {
                $gs->etapa = $c->idnuevaetapa;
            }
        }
        $gs->condicion = true;
        $gs->save();


        ////bitacora/////////



        $notificacion = array(
            'message' => 'La solicitud ha sido creada con éxito.',
            'alert-type' => 'info'
        );
        UtilFunctions::getUserNotify('DIRECTOR GENERAL', $gs->idgrupo)->notify(new SolicitudAprobacionTema($gs, UtilFunctions::DIRECTOR_GENERAL));

        return Redirect()->back()->with($notificacion);
        
    }
    // 02022020
    public function eliminars()
    {


        grupo_solicitud::findOrFail(Input::get('idsolicitud'))->delete();
        $notificacion = array(
            'message' => 'La solicitud ha sido eliminada con éxito.',
            'alert-type' => 'info'
        );


        return Redirect()->back()->with($notificacion);
    }


    public function imprimiraprovaciont()
    {
        $query = Input::get('codigo');
        $motivo = Input::get('motivo');
        $idgrupoJc = Input::get('idgrupo');
        //echo dd($query);
        // echo dd($idgrupoJc);
        $fi = date("d/m/Y", strtotime(Input::get('fechai')));
        $ff = date("d/m/Y", strtotime(Input::get('fechaf')));
        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $tipoasesor = TipoAsesor::all();
        $enunciado = Enunciado::all();

        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        //aqui manda todos los datos para la nota
        $pdf = \PDF::loadview('ues.solicitudes.aprobaciont', ["codigo" => $query, "fechai" => $fi, "fechaf" => $ff, "motivo" => $motivo], compact('departamento', 'rol', 'carrera', 'tipoasesor', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'enunciado'));
        return $pdf->download('Aprobacion_modalidad_Coordinador_' . $query . '.pdf');
    }
    public function imprimiraprovaciontd()
    {
        $query = Input::get('codigo');
        $motivo = Input::get('motivo');
        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gs->estado == 4) {
            $gs->estado = 0;
            $gs->update();
        }
        $enunciado = Enunciado::all();
        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $pdf = \PDF::loadview('ues.solicitudes.aprobaciontd', ["codigo" => $query], compact('departamento', 'rol', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'enunciado'));
        return $pdf->download('Aprobacion_Modalidad_Director_' . $query . '.pdf');
    }


    ///////renuncia al proceso de graduacion
    public function renuncia()
    {

        $time1 = date('d-m-Y');
        $renuncia = new renuncia();

        $gs = new grupo_solicitud();
        $time = strtotime(Input::get('fechar'));

        $newformat = date('d-m-Y', $time);

        $gs->idsolicitud = 9;
        $gs->idgrupo = Input::get('idgrupo');
        $gs->estado = 4;
        $gs->fechaenv = $time1;
        $gs->idpersona = \Auth::user()->idpersona;

        $gs->condicion = true;


        $gs->etapa = Input::get('idetapa');
        $gs->fecha = $newformat;
        $gs->save();


        $renuncia->idgrupsol = $gs->idgrupsol;
        $renuncia->idestudiante = Input::get('estudianterenuncia');
        $renuncia->condicion = true;
        $renuncia->save();
        $notificacion = array(
            'message' => 'La solicitud ha sido creada con éxito.',
            'alert-type' => 'info'
        );


        return Redirect()->back()->with($notificacion);
    }
//*******************PARA IMPRIMIR LA SOLICITUD DE RENUNUNCIA
    public function imprimir9coordinador()
    {
        $query = Input::get('codigo');
        $estudianteR = Input::get('estudianteR');



        $idgrupo = Input::get('idgrupo');
        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $enunciado = Enunciado::all();
        $gs1 = grupo_solicitud::where('idgrupo', '=', $idgrupo)->where('nacuerdo', '!=', ' ')->orderBy('idgrupsol', 'desc')->first();
        $pdf = \PDF::loadview('ues.solicitudes.renunciaC', ["codigo" => $query, "estudianteR" => $estudianteR], compact('departamento', 'rol', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'gs1', 'enunciado'));
        return $pdf->download('Solicitud_Renuncia_Coordinador ' . $estudianteR . '.pdf');
    }

    public function imprimir9director()
    {
        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gs->estado == 4) {
            $gs->estado = 0;
            $gs->update();
        }

        $query = Input::get('codigo');
        $estudianteR = Input::get('estudianteR');
        $idgrupo = Input::get('idgrupo');
        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $enunciado = Enunciado::all();
        $gs1 = grupo_solicitud::where('idgrupo', '=', $idgrupo)->where('nacuerdo', '!=', ' ')->orderBy('idgrupsol', 'desc')->first();
        $pdf = \PDF::loadview('ues.solicitudes.renunciaD', ["codigo" => $query, "estudianteR" => $estudianteR], compact('departamento', 'rol', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'gs1', 'enunciado'));
        return $pdf->download('Solicitud_Renuncia_Director ' . $estudianteR . '.pdf');
    }
//***********FIN DE IMPRIMIR SOLICITUD DE RENUNCIA */
    public function registrar9director(Request $request)
    {

        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        $eg = EstudianteGrupos::where('idestudiante', '=', Input::get('estudianterenuncia'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-renuncia al proceso' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-renuncia al proceso' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('solicituddir') != null) {
            $file = $request->file('solicituddir');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('solicituddir')->put('/' . $ruta . '/' . $ruta . '-solicitud-renuncia' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->solicituddir = $ruta . '/' . $ruta . '-solicitud-renuncia' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            //pdfrecibido es un campo en la base de datos.....
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-renuncia al proceso' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-renuncia al proceso' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];

            $gs->update();
        }
        if ($request['aprobado'] == 0) {

            $gs->estado = 1;
            $gs->update();
            $eg->delete();
        }

        if ($request['aprobado'] == 1) {

            $gs->estado = 7;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }

    public function registrarcoor(Request $request)
    {

        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        if ($request->file('solicitudcoor') != null) {
            $file = $request->file('solicitudcoor');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('solicitudcoor')->put('/' . $ruta . '/' . $ruta . '-solicitud-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->solicitudcoor = $ruta . '/' . $ruta . '-solicitud-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-documento-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-documento-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }




        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }

    public function registrarase(Request $request)
    {
        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gs->estado == 0 || $gs->estado == 1) {



            if ($request->file('dcrecibidos') != null) {
                $file = $request->file('dcrecibidos');
                //obtenemos el nombre del archivo
                $nombre = $file->getClientOriginalName();
                $ruta = $request->get('idgrupo');
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-Acuerdo' . $gs->idgrupsol . '.pdf',  \File::get($file));
                $gs->pdfrecibido = $ruta . '/' . $ruta . '-Acuerdo' . $gs->idgrupsol . '.pdf';
                $gs->update();
            }
            if ($request['nacuerdo'] != null) {
                $gs->nacuerdo = $request['nacuerdo'];

                $gs->update();
            }
            if ($request['aprobado'] == 0) {

                $gs->estado = 1;
                $gs->update();
            }

            if ($request['aprobado'] == 1) {

                $gs->estado = 7;
                $gs->update();
            }




            $notificacion = array(
                'message' => 'Documentos almacenados con éxito.',
                'alert-type' => 'info'
            );
        } else {


            $notificacion = array(
                'message' => 'Documentos no almacenados.',
                'alert-type' => 'warning'
            );
        }
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }

    //// recibidos//

    public function registrardocenviados(Request $request)
    {
        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-aprobaciontema-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-aprobaciontema-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-aprobaciontema-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-aprobaciontema-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }


        if ($request->file('solicituddir') != null) {
            $file = $request->file('solicituddir');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('solicituddir')->put('/' . $ruta . '/' . $ruta . '-aprobaciontema-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->solicituddir = $ruta . '/' . $ruta . '-aprobaciontema-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];

            $gs->update();
        }
        if ($request['aprobado'] == 0) {

            $gs->estado = 1;
            $gs->update();
        }

        if ($request['aprobado'] == 1) {

            $gs->estado = 7;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }

    ///////////////////////////////////////////////////////////////////////

    /* public function spsistemas(){
    	$query=Input::get('codigo');
    	$motivo=Input::get('motivo');
    	
        $fi = date("d/m/Y", strtotime(Input::get('fechai')));
        $ff = date("d/m/Y", strtotime(Input::get('fechaf')));
            $estudianteg=EstudianteGrupos::all();
            $estudiante=Estudiante::all();
            $asesores=GrupoDocente::all();
            $personas=Persona::all();
            $docentes=Docente::all();
            $tipotema=TipoTema::all();
            $user=User::all();
            $departamento=departamento::all();
        	$grupo=Grupo::all();
            $carrera=Carrera::all();
            $rol=Rol::all();
            $rol_carrera=rol_carrera::all();
        	$pdf=\PDF::loadview('ues.solicitudes.prorrogai',["codigo"=>$query,"fechai"=>$fi,"fechaf"=>$ff,"motivo"=>$motivo],compact('departamento','rol','carrera','rol_carrera','grupo','estudianteg','estudiante','tipotema','personas','asesores','docentes','user'));
            		return $pdf->download('Solicitud.pdf');
            	
                }*/
    //////////////////////por abandono/////////////////////////
    public function repabandono()
    {
        $time1 = date('d-m-Y');
        $date = new \DateTime();
        $idgrupo = Input::get('idgrupo');
        $consulta = etapas_grupos::all();
        $srepro = new solicitud_reprobacion;
        $gruposol = new grupo_solicitud;
        $gruposol->idgrupo = Input::get('idgrupo');
        $gruposol->idsolicitud = Input::get('idsolicitud');
        $gruposol->condicion = true;
        $gruposol->fecha = $date->format('d-m-Y');
        foreach ($consulta as $c) {
            if ($c->idgrupo == $idgrupo && $c->estado == 1) {
                $gruposol->etapa = $c->idnuevaetapa;
            }
        }

        $gruposol->estado = 3; //coorodinador
        $gruposol->fechaenv = $time1;
        $gruposol->idpersona = \Auth::user()->idpersona;
        $gruposol->save();

        $srepro->idgrupsol = $gruposol->idgrupsol;
        $srepro->idestudiante = Input::get('estudianteselec');
        $srepro->motivo = Input::get('motivo');
        $srepro->save();

        ////bitacora/////////
        $personas = Persona::all();
        $estudiante = Estudiante::all();


        ////bitacora/////////
        $personas = Persona::all();
        $estudiante = Estudiante::all();
        $gru = Grupo::all();



        $grup = Grupo::all();
        foreach ($grup as $gru) {
            if ($gru->idgrupo == $gruposol->idgrupo) {

                foreach ($estudiante as $est) {

                    if ($est->idestudiante == $srepro->idestudiante) {
                        foreach ($personas as $per) {
                            if ($per->idpersona == $est->idpersona) {
                                $na = $per->nombres;
                                $ape = $per->apellidos;
                                $car = $est->carnet;
                            }
                        }
                    }
                }
            }
        }

        $bitacora = new Bitacora;
        $bitacora->idusuario = Auth::user()->id;
        $bitacora->accion = "Generó una nueva solicitud de Reprobacion por abandono";
        $bitacora->fecha = $date->format('d-m-Y h:i:s');
        $bitacora->datos = "Para el alumno $car $na $ape";

        $bitacora->save();
        ////bitacora/////////


        UtilFunctions::getUserNotify('DIRECTOR GENERAL', $gruposol->idgrupo)->notify(new SolicitudReprobacionAbandono($gruposol, UtilFunctions::DIRECTOR_GENERAL));



        $notificacion = array(
            'message' => 'La solicitud ha sido creada con éxito.',
            'alert-type' => 'info'
        );

        return Redirect()->back()->with($notificacion);
    }

    public function imprepabandonoCoordinador()
    {


        $time1 = date('d-m-Y');
        $query = Input::get('codigo');
        $estudianteselec = Input::get('estudianteselec');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gruposol->estado == 3) {
            $gruposol->estado = 4;
            $gruposol->fechaenv = $time1;
            $gruposol->idpersona = \Auth::user()->idpersona;
            $gruposol->update();
        }

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $gso = grupo_solicitud::all();

        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $dt = DocenteSolicitud::all();

        $tipoasesor = TipoAsesor::all();
        $enunciado = Enunciado::all();

        $pdf = \PDF::loadview('ues.solicitudes.reprobacionxabandono', ["tipoasesor" => $tipoasesor, "codigo" => $query, "gso" => $gso, "estudianteselec" => $estudianteselec, "motivo" => $motivo], compact('departamento', 'rol', 'estudianteselec', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'personas', 'asesores', 'docentes', 'dt', 'user', 'enunciado'));
        return $pdf->download('Solicitud_Reprobacion_por_Abandono_Coordinador ' . $estudianteselec . '.pdf');
    }

    ///////////////////////////////////////////////
    public function imprepabandonoDirector()
    {


        $query = Input::get('codigo');
        $estudianteselec = Input::get('estudianteselec');
        $idgrupo = Input::get('idgrupo');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gruposol->estado == 4) {
            $gruposol->estado = 0;
            $gruposol->update();
        }

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $gso = grupo_solicitud::all();

        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $dt = DocenteSolicitud::all();
        $enunciado = Enunciado::all();
        $gs1 = grupo_solicitud::where('idgrupo', '=', $idgrupo)->where('nacuerdo', '!=', ' ')->orderBy('idgrupsol', 'desc')->first();
        $pdf = \PDF::loadview('ues.solicitudes.reproDirector', ["codigo" => $query, "gso" => $gso, "estudianteselec" => $estudianteselec, "motivo" => $motivo], compact('departamento', 'rol', 'estudianteselec', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'personas', 'asesores', 'docentes', 'dt', 'user', 'gs1', 'enunciado'));
        return $pdf->download('Solicitud_Reprobacion_por_Abandono_Director ' . $estudianteselec . '.pdf');
    }




    ///////////prorroga interna////////////////
    ///////////////////////////////////////////////////////////////////////

    public function spsistemas()
    {

        $time = strtotime(Input::get('fechar'));
        $time1 = date('d-m-Y');

        $newformat = date('d-m-Y', $time);

        $gruposol = new grupo_solicitud;
        $prorrogai = new Prorrogai;
        $idgrupo = Input::get('idgrupo');
        $consulta = etapas_grupos::all();
        $gruposol->idgrupo = Input::get('idgrupo');
        $gruposol->idsolicitud = Input::get('idsolicitud');
        foreach ($consulta as $c) {
            if ($c->idgrupo == $idgrupo && $c->estado == 1) {
                $gruposol->etapa = $c->idnuevaetapa;
            }
        }
        $gruposol->estado = 3;
        $gruposol->idpersona = Auth::user()->idpersona;
        $gruposol->fechaenv = $time1;
        $gruposol->condicion = true;
        $gruposol->fecha = $newformat;
        $gruposol->save();

        $prorrogai->idgrupsol = $gruposol->idgrupsol;

        $prorrogai->fechaInicio = Input::get('fechai');
        $prorrogai->fechaFinal = Input::get('fechaf');
        $prorrogai->motivo = Input::get('motivo');

        $prorrogai->save();

        $notificacion = array(
            'message' => 'La Solicitud se ha registrado con éxito.',
            'alert-type' => 'info'
        );



        UtilFunctions::getUserNotify('COORDINADOR GENERAL', $gruposol->idgrupo)->notify(new SolicitudIrorrogaInterna($gruposol, UtilFunctions::COORDINADOR_GENERAL));
        return redirect()->back()->with($notificacion);
    }


    ////////////Prorroga Junta Directiva
    public function prorrogajd()
    {
        $time = strtotime(Input::get('fechar'));
        $time1 = date('d-m-Y');

        $newformat = date('d-m-Y', $time);
        $gruposol = new grupo_solicitud;
        $prorrogajd = new Prorrogajd;
        $idgrupo = Input::get('idgrupo');
        $consulta = etapas_grupos::all();
        $gruposol->idgrupo = Input::get('idgrupo');
        $gruposol->idsolicitud = Input::get('idsolicitud');
        foreach ($consulta as $c) {
            if ($c->idgrupo == $idgrupo && $c->estado == 1) {
                $gruposol->etapa = $c->idnuevaetapa;
            }
        }

        $gruposol->estado = 3;
        $gruposol->fechaenv = $time1;
        $gruposol->idpersona = \Auth::user()->idpersona;
        $gruposol->condicion = true;
        $gruposol->fecha = $newformat;
        $gruposol->save();

        $prorrogajd->idgrupsol = $gruposol->idgrupsol;
        $prorrogajd->motivo = Input::get('motivo');
        $prorrogajd->save();

        $notificacion = array(
            'message' => 'La Solicitud se ha registrado con éxito.',
            'alert-type' => 'info'
        );




        return redirect()->back()->with($notificacion);
    }

    //imprimir3asesor
    public function imprimir3asesor()
    {

        $query = Input::get('codigo');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        $numerosoli = 0;

        $forgs = grupo_solicitud::all()->sortBy('idgrupsol');
        $idgrupo = Input::get('idgrupo');
        $bandera = true;

        foreach ($forgs as $forgs) {
            if ($bandera == true && $forgs->idgrupo == $idgrupo && $forgs->idsolicitud == 3 && $forgs->condicion == true) {
                $numerosoli = $numerosoli + 1;

                if ($forgs->idgrupsol == Input::get('idsolicitud')) {
                    $bandera = false;
                }
            }
        }

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $enunciado = Enunciado::all();
        $gso = grupo_solicitud::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        UtilFunctions::getUserNotify('COORDINADOR GENERAL', $gruposol->idgrupo)->notify(new SolicitudPJD($gruposol, UtilFunctions::COORDINADOR_GENERAL));

        $pdf = \PDF::loadview('ues.solicitudes.prorrogajdasesor', ["codigo" => $query, "motivo" => $motivo, "numerosoli" => $numerosoli], compact('departamento', 'rol', 'gso', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'enunciado'));
        return $pdf->download('Solicitud_Prorroga_JD_Asesor ' . $query . '.pdf');
    }

    public function imprimir3coordinador()
    {
        $time1 = date('d-m-Y');
        $query = Input::get('codigo');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        if ($gruposol->estado == 3) {
            $gruposol->estado = 4;
            $gruposol->fechaenv = $time1;
            $gruposol->idpersona = \Auth::user()->idpersona;
            $gruposol->update();
        }



        $numerosoli = 0;

        $forgs = grupo_solicitud::all()->sortBy('idgrupsol');
        $idgrupo = Input::get('idgrupo');
        $bandera = true;

        foreach ($forgs as $forgs) {
            if ($bandera == true && $forgs->idgrupo == $idgrupo && $forgs->idsolicitud == 3 && $forgs->condicion == true) {
                $numerosoli = $numerosoli + 1;

                if ($forgs->idgrupsol == Input::get('idsolicitud')) {
                    $bandera = false;
                }
            }
        }

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $enunciado = Enunciado::all();
        $gso = grupo_solicitud::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        UtilFunctions::getUserNotify('DIRECTOR GENERAL', $gruposol->idgrupo)->notify(new SolicitudPJD($gruposol, UtilFunctions::DIRECTOR_GENERAL));
        $pdf = \PDF::loadview('ues.solicitudes.prorrogajdcoordinador', ["codigo" => $query, "motivo" => $motivo, "numerosoli" => $numerosoli], compact('departamento', 'rol', 'gso', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'enunciado'));
        return $pdf->download('Solicitud_Prorroga_JD_Coordinador ' . $query . '.pdf');
    }
    //prorroga a junta directiva director
    public function imprimir3director()
    {

        $query = Input::get('codigo');
        $idgrupo = Input::get('idgrupo');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        $numerosoli = 0;

        $forgs = grupo_solicitud::all()->sortBy('idgrupsol');
        $idgrupo = Input::get('idgrupo');
        $bandera = true;

        foreach ($forgs as $forgs) {
            if ($bandera == true && $forgs->idgrupo == $idgrupo && $forgs->idsolicitud == 3 && $forgs->condicion == true) {
                $numerosoli = $numerosoli + 1;

                if ($forgs->idgrupsol == Input::get('idsolicitud')) {
                    $bandera = false;
                }
            }
        }

        if ($gruposol->estado == 4) {
            $gruposol->estado = 0;
            $gruposol->update();
        }

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $enunciado = Enunciado::all();
        $gso = grupo_solicitud::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $gs1 = grupo_solicitud::where('idgrupo', '=', $idgrupo)->where('nacuerdo', '!=', ' ')->orderBy('idgrupsol', 'desc')->first();


        $pdf = \PDF::loadview('ues.solicitudes.prorrogajddirector', ["codigo" => $query, "motivo" => $motivo, "numerosoli" => $numerosoli], compact('departamento', 'rol', 'gso', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'gs1', 'enunciado'));
        return $pdf->download('Solicitud_Prorroga_JD_Director ' . $query . '.pdf');
    }

    public function registrarprorrogajd(Request $request)
    {
        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-prorrogajd-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-Prorrogajd-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }


        if ($request->file('solicituddir') != null) {
            $file = $request->file('solicituddir');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('solicituddir')->put('/' . $ruta . '/' . $ruta . '-prorrogajd-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->solicituddir = $ruta . '/' . $ruta . '-Prorrogajd-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-prorrogajd-' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-Prorrogajd-' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];

            $gs->update();
        }
        if ($request['aprobado'] == 0) {

            $gs->estado = 1;
            $gs->update();
        }

        if ($request['aprobado'] == 1) {

            $gs->estado = 7;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }
    ///notificacion inasistencia

    public function imprimir7asesor()
    {
        $time1 = date('d-m-Y');
        $query = Input::get('codigo');
        $numero = Input::get('numero');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        if ($gruposol->estado == 5) {
            $gruposol->estado = 3;
            $gruposol->fechaenv = $time1;
            $gruposol->idpersona = \Auth::user()->idpersona;
            $gruposol->update();
        }

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $enunciado = Enunciado::all();
        $gso = grupo_solicitud::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $ni = notificacion_inasistencia::all();

        //UtilFunctions::getUserNotify('ASESOR',$al->grupo_asistencia->idgrupo)->notify(new NotificacionInasistencia($al,UtilFunctions::ASESOR));

        //UtilFunctions::getUserNotify('COORDINADOR GENERAL',$gruposol->idgrupo)->notify(new NotificacionInasistencia($gruposol,UtilFunctions::COORDINADOR_GENERAL));
        $pdf = \PDF::loadview('ues.solicitudes.notificacion_inasistencia', ["codigo" => $query, "numero" => $numero, "gruposol" => $gruposol], compact('departamento', 'rol', 'gso', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'ni', 'enunciado'));
        return $pdf->download('Solicitud_Notificacion_Inasistencia_Asesor ' . $query . '.pdf');
    }


    public function registrar8director(Request $request)
    {


        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        $eg = EstudianteGrupos::where('idestudiante', '=', Input::get('estudianteselec'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-reprobacion por abandono' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-reprobacion por abandono' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('solicituddir') != null) {
            $file = $request->file('solicituddir');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('solicituddir')->put('/' . $ruta . '/' . $ruta . '-solicitud-reprobacion' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->solicituddir = $ruta . '/' . $ruta . '-solicitud-reprobacion' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-reprobacion por abandono' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-reprobacion por abandono' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];

            $gs->update();
        }
        if ($request['aprobado'] == 0) {

            $gs->estado = 1;
            $gs->update();
            $eg->delete();
        }

        if ($request['aprobado'] == 1) {

            $gs->estado = 7;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }

    public function impspsistemasA()
    {



        $query = Input::get('codigo');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        $numerosoli = 0;

        $forgs = grupo_solicitud::all()->sortBy('idgrupsol');
        $idgrupo = Input::get('idgrupo');
        $bandera = true;
        $idsolicitud = Input::get('idsolicitud');
        $etapa = $gruposol->etapa;
        foreach ($forgs as $forgs) {

            if ($bandera == true && $forgs->idgrupo == $idgrupo && $forgs->idsolicitud == 2 && $forgs->condicion == true && $forgs->etapa == $gruposol->etapa) {
                $numerosoli = $numerosoli + 1;
                if ($forgs->idgrupsol == $idsolicitud) {
                    $bandera = false;
                }
            }
        }


        $fi = date("d/m/Y", strtotime(Input::get('fechai')));
        $ff = date("d/m/Y", strtotime(Input::get('fechaf')));

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $proint = Prorrogai::all();
        $gso = grupo_solicitud::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $etapaactiva = etapas_grupos::all();
        $etapas = nuevaetapa::all();
        $enunciado = Enunciado::all();
        $pdf = \PDF::loadview('ues.solicitudes.prorrogaiA', ["codigo" => $query, "fechai" => $fi, "fechaf" => $ff, "motivo" => $motivo, "gruposol" => $gruposol, "numerosoli" => $numerosoli, "etapa" => $etapa], compact('departamento', 'rol', 'proint', 'gso', 'etapaactiva', 'etapas', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'enunciado'));
        return $pdf->download('Solicitud_Prorroga_interna_Asesor ' . $query . '.pdf');
    }

    public function impspsistemasC()
    {

        $time = date('d-m-Y');

        $query = Input::get('codigo');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gruposol->estado == 3) {
            $gruposol->estado = 4;
            $gruposol->fechaenv = $time;
            $gruposol->idpersona = Auth::user()->idpersona;
            $gruposol->update();
        }

        $numerosoli = 0;

        $forgs = grupo_solicitud::all();
        $idgrupo = Input::get('idgrupo');
        $bandera = true;
        $etapa = $gruposol->etapa;
        foreach ($forgs as $forgs) {


            if ($bandera == true && $forgs->idgrupo == $idgrupo && $forgs->idsolicitud == 2 && $forgs->condicion == true && $forgs->etapa == $gruposol->etapa) {
                $numerosoli = $numerosoli + 1;
            }

            if ($forgs->idgrupsol == Input::get('idsolicitud')) {
                $bandera = false;
            }
        }


        $fi = date("d/m/Y", strtotime(Input::get('fechai')));
        $ff = date("d/m/Y", strtotime(Input::get('fechaf')));

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $proint = Prorrogai::all();
        $gso = grupo_solicitud::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $enunciado = Enunciado::all();
        $pdf = \PDF::loadview('ues.solicitudes.prorrogaiC', ["codigo" => $query, "fechai" => $fi, "fechaf" => $ff, "motivo" => $motivo, "gruposol" => $gruposol, "numerosoli" => $numerosoli, "etapa" => $etapa], compact('departamento', 'rol', 'proint', 'gso', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'enunciado'));
        return $pdf->download('Solicitud_Prorroga_Interna_Coordinador ' . $query . '.pdf');
    }
    ///
    public function impspsistemasD()
    {



        $query = Input::get('codigo');
        $motivo = Input::get('motivo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gruposol->estado == 4) {
            $gruposol->estado = 0;
            $gruposol->update();
        }

        $fi = date("d/m/Y", strtotime(Input::get('fechai')));
        $ff = date("d/m/Y", strtotime(Input::get('fechaf')));


        $enunciado = Enunciado::all();
        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $proint = Prorrogai::all();
        $gso = grupo_solicitud::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $pdf = \PDF::loadview('ues.solicitudes.prorrogaiD', ["codigo" => $query, "fechai" => $fi, "fechaf" => $ff, "motivo" => $motivo], compact('departamento', 'rol', 'proint', 'gso', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'enunciado'));
        return $pdf->download('Solicitud_Prorroga_Interna_Director ' . $query . '.pdf');
    }



    //////////////ratificacion de resultados//
    public function ratiResul()
    {
        $time1 = date('d-m-Y');
        $gs = new grupo_solicitud();
        $time = strtotime(Input::get('fechar'));

        $newformat = date('d-m-Y', $time);

        $idgrupo = Input::get('idgrupo');

        $gs->idsolicitud = Input::get('idsolicitud');
        $netapas = Input::get('netapas');




        $consulta = etapas_grupos::all();
        $gs->fecha = $newformat;
        $gs->idgrupo = Input::get('idgrupo');
        $gs->estado = 4;
        $gs->fechaenv = $time1;
        $gs->idpersona = \Auth::user()->idpersona;

        $gs->etapa = $netapas;

        $gs->condicion = true;
        $gs->save();


        ////bitacora/////////



        $notificacion = array(
            'message' => 'La solicitud ha sido creada con éxito.',
            'alert-type' => 'info'
        );



        ///////////////////////////


        UtilFunctions::getUserNotify('DIRECTOR GENERAL', $gs->idgrupo)->notify(new SolicitudRatificacionResultados($gs, UtilFunctions::DIRECTOR_GENERAL));


        $grup = Grupo::all();
        foreach ($grup as $gru) {
            if ($gru->idgrupo == $gs->idgrupo) {

                $codi = $gru->codigoG;
            }
        }

        $date = new \DateTime();
        ////bitacora/////////
        $bitacora = new Bitacora;
        $bitacora->idusuario = Auth::user()->id;
        $bitacora->accion = "Solicitó ratificación deresultados";
        $bitacora->fecha = $date->format('d-m-Y h:i:s');
        $bitacora->datos = "Grupo $codi";
        $bitacora->save();
        ////bitacora/////////


        return redirect()->back()->with($notificacion);
    }

    public function impratiResulC()
    {
        ////
        $query = Input::get('codigo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $dt = DocenteSolicitud::all();
        $gruposoli = grupo_solicitud::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();

        $enunciado = Enunciado::all();
        $pdf = \PDF::loadview('ues.solicitudes.ratificacionResulC', ["codigo" => $query], compact('departamento', 'rol', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'personas', 'asesores', 'docentes', 'user', 'dt', 'gruposoli', 'enunciado'));
        return $pdf->download('Solicitud_Ratificación_Resultados_Coordinador ' . $query . '.pdf');
    }
    public function impratiResulD()
    {
        $query = Input::get('codigo');
        $idgrupo = Input::get('idgrupo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gruposol->estado == 4) {
            $gruposol->estado = 0;
            $gruposol->update();
        }
        $mostraintegrante = EstudianteGrupos::all();
        $estudiantes = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $dt = DocenteSolicitud::all();
        $gruposoli = grupo_solicitud::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $porcentaje = Ponderacion::all();
        $notas = Notas::all();
        $tiproceso = TipoTema::all();
        $etapas = nuevaetapa::all();
        $enunciado = Enunciado::all();

        $gs1 = grupo_solicitud::where('idgrupo', '=', $idgrupo)->where('nacuerdo', '!=', ' ')->orderBy('idgrupsol', 'desc')->first();
        $rol_carrera = Rol_carrera::all();
        $pdf = \PDF::loadview(
            'ues.solicitudes.ratificacionResulD',
            ["codigo" => $query],
            compact('departamento', 'rol', 'carrera', 'rol_carrera', 'grupo', 'estudiantes', 'personas', 'asesores', 'docentes', 'user', 'dt', 'gruposoli', 'notas', 'porcentaje', 'tiproceso', 'etapas', 'mostraintegrante', 'gs1', 'enunciado')
        );
        return $pdf->download('Solicitud_Ratificación_Resultados_Director ' . $query . '.pdf');
    }



    public function impugnacionResultados()
    {
        $time1 = date('d-m-Y');
        $gs = new grupo_solicitud();
        $time = strtotime(Input::get('fechar'));

        $newformat = date('d-m-Y', $time);

        $idgrupo = Input::get('idgrupo');
        $consulta = etapas_grupos::all();
        $gs->idsolicitud = Input::get('idsolicitud');
        $netapas = Input::get('netapas');
        $bandera = false;
        foreach ($consulta as $c) {
            if ($c->idgrupo == $idgrupo && $c->estado == 1) {
                $gs->etapa = $c->idnuevaetapa;
            }
        }



        $gs->fecha = $newformat;
        $gs->idgrupo = Input::get('idgrupo');
        $gs->estado = 4;
        $gs->fechaenv = $time1;
        $gs->idpersona = \Auth::user()->idpersona;

        $gs->condicion = true;
        $gs->etapa = $netapas;
        $gs->save();
        $notificacion = array(
            'message' => 'La solicitud ha sido creada con éxito.',
            'alert-type' => 'info'
        );



        return redirect()->back()->with($notificacion);
    }



    public function imprimir10coordinador()
    {
        ////
        $query = Input::get('codigo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $dt = DocenteSolicitud::all();
        $gruposoli = grupo_solicitud::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $enunciado = Enunciado::all();
        $pdf = \PDF::loadview('ues.solicitudes.impugnacion', ["codigo" => $query], compact('departamento', 'rol', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'personas', 'asesores', 'docentes', 'user', 'dt', 'gruposoli', 'enunciado'));
        return $pdf->download('Solicitud_Impugnacion_Resultados_Coordinador ' . $query . '.pdf');
    }



    public function imprimir10director()
    {
        $query = Input::get('codigo');
        $idgrupo = Input::get('idgrupo');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($gruposol->estado == 4) {
            $gruposol->estado = 0;
            $gruposol->update();
        }
        $mostraintegrante = EstudianteGrupos::all();
        $estudiantes = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $dt = DocenteSolicitud::all();
        $gruposoli = grupo_solicitud::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $porcentaje = Ponderacion::all();
        $notas = Notas::all();
        $tiproceso = TipoTema::all();
        $etapas = nuevaetapa::all();
        $enunciado = Enunciado::all();

        $gs1 = grupo_solicitud::where('idgrupo', '=', $idgrupo)->where('nacuerdo', '!=', ' ')->orderBy('idgrupsol', 'desc')->first();

        $rol_carrera = Rol_carrera::all();
        $pdf = \PDF::loadview(
            'ues.solicitudes.impugnacionResultados',
            ["codigo" => $query],
            compact('departamento', 'rol', 'carrera', 'rol_carrera', 'grupo', 'estudiantes', 'personas', 'asesores', 'docentes', 'user', 'dt', 'gruposoli', 'notas', 'porcentaje', 'tiproceso', 'etapas', 'mostraintegrante', 'gs1', 'enunciado')
        );
        return $pdf->download('Solicitud_Impugnacion_Resultados_Director ' . $query . '.pdf');
    }


    public function registrar10director(Request $request)
    {


        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-impugnacion de resultados.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-impugnacion de resultados.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-impugnacion de resultados.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-impugnacion de resultados.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];

            $gs->update();
        }
        if ($request['aprobado'] == 0) {

            $gs->estado = 1;
            $gs->update();
        }

        if ($request['aprobado'] == 1) {

            $gs->estado = 7;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }
    ///////////////
    //// recibidos aprobacion de tema//

    public function registrardocenviadosCO(Request $request)
    {


        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-aprobacionModalidad.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-aprobacionModalidad.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-aprobacionModalidad.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-aprobacionModalidad.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];
            $gs->estado = 1;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
        // ->with($periodos)
    }


    ////////////////////registrar documentcion de prorroga inerna

    public function registrardocpinterna(Request $request)
    {

        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-prorrogainterna' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-prorrogainterna' . $gs->idgrupsol . '.pdf';
            $gs->estado = 1;
            $gs->update();
        }

        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
        // ->with($periodos)
    }

    ////////////////////registrar documentcion de ratificacion de resultado

    public function registrardocratiresul(Request $request)
    {

        $grup = Grupo::findOrFail($request->get('idgrupo'));
        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-ratificacion de resultados' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-ratificacion de resultados' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('solicituddir') != null) {
            $file = $request->file('solicituddir');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('solicituddir')->put('/' . $ruta . '/' . $ruta . '-solicitud-ratificacion de resultados' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->solicituddir = $ruta . '/' . $ruta . '-solicitud-ratificacion de resultados' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-ratificacion de resultados' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-ratificacion de resultados' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];

            $gs->update();
        }
        if ($request['aprobado'] == 0) {


            $gs->estado = 1;
            $gs->update();
            $grup->condicion = false;
            $grup->update();
        }

        if ($request['aprobado'] == 1) {

            $gs->estado = 7;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }


    public function registrardocratiresulimp(Request $request)
    {


        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-solicitud-impugnacion de resultados' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-solicitud-impugnacion de resultados' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('solicituddir') != null) {
            $file = $request->file('solicituddir');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('solicituddir')->put('/' . $ruta . '/' . $ruta . '-solicitud-impugnacion de resultados' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->solicituddir = $ruta . '/' . $ruta . '-solicitud-impugnacion de resultados' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }

        if ($request->file('dcrecibidos') != null) {
            $file = $request->file('dcrecibidos');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosrecibidos')->put('/' . $ruta . '/' . $ruta . '-imp de resultados' . $gs->idgrupsol . '.pdf',  \File::get($file));
            $gs->pdfrecibido = $ruta . '/' . $ruta . '-imp de resultados' . $gs->idgrupsol . '.pdf';
            $gs->update();
        }
        if ($request['nacuerdo'] != null) {
            $gs->nacuerdo = $request['nacuerdo'];

            $gs->update();
        }
        if ($request['aprobado'] == 0) {

            $gs->estado = 1;
            $gs->update();
        }

        if ($request['aprobado'] == 1) {

            $gs->estado = 7;
            $gs->update();
        }
        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
    }


    //////////////enviado por ovidio 28_03_19
    public function imprimir7coordinador()
    {
        $time1 = date('d-m-Y');
        $query = Input::get('codigo');
        $numero = Input::get('numero');
        $gruposol = grupo_solicitud::findOrFail(Input::get('idsolicitud'));

        if ($gruposol->estado == 3) {
            $gruposol->estado = 4;
            $gruposol->fechaenv = $time1;
            $gruposol->idpersona = \Auth::user()->idpersona;
            $gruposol->update();
        }

        $estudianteg = EstudianteGrupos::all();
        $estudiante = Estudiante::all();
        $asesores = GrupoDocente::all();
        $personas = Persona::all();
        $docentes = Docente::all();
        $tipotema = TipoTema::all();
        $user = User::all();
        $departamento = departamento::all();
        $grupo = Grupo::all();
        $enunciado = Enunciado::all();
        $gso = grupo_solicitud::all();
        $carrera = Carrera::all();
        $rol = Rol::all();
        $rol_carrera = Rol_carrera::all();
        $ni = notificacion_inasistencia::all();
        $pdf = \PDF::loadview('ues.solicitudes.notificacion_inasistenciaC', ["codigo" => $query, "numero" => $numero, "gruposol" => $gruposol], compact('departamento', 'rol', 'gso', 'carrera', 'rol_carrera', 'grupo', 'estudianteg', 'estudiante', 'tipotema', 'personas', 'asesores', 'docentes', 'user', 'ni', 'enunciado'));
        return $pdf->download('Solicitud_Notificacion_Inasistencia_Coordinador ' . $query . '.pdf');
    }

    //////// enviado ovidio 29_03_19
    public function registrar7director(Request $request)
    {

        $gs = grupo_solicitud::findOrFail(Input::get('idsolicitud'));
        if ($request->file('dcenviados') != null) {
            $file = $request->file('dcenviados');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta = $request->get('idgrupo');
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/' . $ruta . '/' . $ruta . '-notificacion-inasistencia.pdf',  \File::get($file));
            $gs->pdf = $ruta . '/' . $ruta . '-notificacion-inasistencia.pdf';
            if ($gs->estado == 4) {
                $gs->estado = 1;
                $gs->update();
            }
        }



        $notificacion = array(
            'message' => 'Documentos almacenados con éxito.',
            'alert-type' => 'info'
        );
        //return redirect()->back()->with($notificacion);
        return Redirect()->back()->with($notificacion);
        // ->with($periodos)
    }
}
