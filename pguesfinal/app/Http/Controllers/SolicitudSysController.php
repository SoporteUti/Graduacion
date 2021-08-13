<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;
use sispg\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sispg\Http\Requests\SolicitudSysFormRequest;
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


class SolicitudSysController extends Controller
{
    public function __construc(){

    }

    public function index(Request $request ){

    $solicitude=Solicitud::all();
    if($request){
        $query=trim($request->get('searchText'));
        $solicitude=DB::table('solicitudes')->where('nomSolicitud','LIKE','%'.$query.'%')          
        ->orderBy('nomSolicitud','asc')
        ->paginate(60);
            return view('ues.solicitudesSys.index',["solicitude"=>$solicitude,"searchText"=>$query]);
        }

	//return view('ues.solicitudes.index');
    }

    public function create(){

    }

    public function store(SolicitudSysFormRequest $request){

        $solicitud=new Solicitud;
        $solicitud->nomSolicitud=$request->get('nombre');
        $solicitud->condicion=true;
        $solicitud->save();
            $notificacion = array(
            'message' => 'El Nombre se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);


    }
    public function show($id){
        return view("ues.solicitudesSys.show",["solicitude"=>Solicitud::findOrFail($id)]);

    }
    public function edit($id){
        return view("ues.solicitudesSys.edit",["solicitude"=>Solicitud::findOrFail($id)]);

    }
    public function update(SolicitudSysFormRequest $request, $id){
        $solicitud=Solicitud::findOrFail($id);
        $solicitud->nomSolicitud=$request->get('nombre');      
        $solicitud->condicion=true;

        $solicitud->update();

         $notificacion = array(
            'message' => 'El Nombre se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/solicitudesSys')->with($notificacion);

    }
    public function destroy($id){ 
        $solicitud=Solicitud::findOrFail($id);
        if ($solicitud->condicion==false) {
            $solicitud->condicion=true;

            $notificacion = array(
            'message' => 'La Solicitud se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $solicitud->condicion=false;
              $notificacion = array(
            'message' => 'La Solicitud se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
        
        $solicitud->update();
       
        return Redirect::to('ues/solicitudesSys')->with($notificacion);

    }

    public function spsistemas(){
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
            $grupo=Grupo::all();
            $pdf=\PDF::loadview('ues.solicitudesSys.prorrogai',["codigo"=>$query,"fechai"=>$fi,"fechaf"=>$ff,"motivo"=>$motivo],compact('grupo','estudianteg','estudiante','tipotema','personas','asesores','docentes'));
                    return $pdf->download('Solicitud.pdf');
                
    }
   
}
