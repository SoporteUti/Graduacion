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
use sispg\Rol;
use sispg\Enunciado;
use sispg\DocenteSolicitud;
use sispg\grupo_solicitud;
use sispg\cambioTema;
use sispg\etapas_grupos;
use sispg\Utils\UtilFunctions;


use sispg\Notifications\{
    SolicitudAprobacionTema,
    SolicitudIrorrogaInterna,
    SolicitudRatificacionResultados,
    SolicitudRatificacionTribunal,
    SolicitudReprobacionAbandono,
    SolicitudCambioTema
};

class solicitudpicController extends Controller
{
 public function __construc(){
    $this->middleware('auth');
    
    UtilFunctions::authorizeRoles(['ESTUDIANTE','ADMINISTRADOR','JEFE DE DEPARTAMENTO',
        'COORDINADOR GENERAL','ASESOR','DIRECTOR GENERAL']);

}

public function index(){


    return view('ues.solicitudesconta.index');
    
}

public function create(){

}

public function store(){

}
public function show(){

}
public function edit(){

}
public function update(){

}
public function destroy(){ 

}



//////////////////////////////////////////////////////////
public function spiconta(){

     $time = strtotime(Input::get('fechar'));
      $time1= date('d-m-Y');

$newformat = date('d-m-Y',$time);
    $idgrupo=Input::get('idgrupo'); 
    $consulta = etapas_grupos::all();
    $cambiotema=new cambioTema;
    $gruposol=new grupo_solicitud;
    $gruposol->idgrupo=Input::get('idgrupo');
    $gruposol->idsolicitud=Input::get('idsolicitud');
    $gruposol->condicion=true;
    $gruposol->fecha=$newformat;
        $gruposol->estado=3;//coorodinador
         $gruposol->fechaenv=$time1;
    $gruposol->idpersona=\Auth::user()->idpersona;

        foreach ($consulta as $c) {
           if ($c->idgrupo==$idgrupo && $c->estado==1) {
             $gruposol->etapa=$c->idnuevaetapa;
         }
     }
     $gruposol->save();
     
     $cambiotema->idgrupsol= $gruposol->idgrupsol;
     $cambiotema->nuevotema=Input::get('nuevotema');
     $cambiotema->motivo=Input::get('motivo');
     
     $cambiotema->save();
     $notificacion = array(
        'message' => 'La solicitud ha sido creada con éxito.', 
        'alert-type' => 'info'
    );



     return Redirect()->back()->with($notificacion);
 }

 public function spicontaAsesor(){

    $gruposol=grupo_solicitud::findOrFail(Input::get('idsolicitud'));

    $cambiotema=new cambioTema; 
    $query=Input::get('codigo');
    $nuevotema=Input::get('nuevotema');
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
    $enunciado=Enunciado::all();
    $carrera=Carrera::all();
    $rol=Rol::all();
    $rol_carrera=rol_carrera::all();
     $gso=grupo_solicitud::all();
    foreach($grupo as $gru){
       if($gru->codigoG==$query){
        $nombre=$gru->codigoG;
    }

}

UtilFunctions::getUserNotify('COORDINADOR GENERAL',$gruposol->idgrupo)->notify(new SolicitudCambioTema($gruposol,UtilFunctions::COORDINADOR_GENERAL));

$pdf=\PDF::loadview('ues.solicitudesconta.prorrogaiAsesor',["codigo"=>$query,"motivo"=>$motivo,"nuevotema"=>$nuevotema],compact('departamento','rol','carrera','rol_carrera','grupo','estudianteg','estudiante','tipotema','personas','asesores','docentes','user','gso','enunciado'));
return $pdf->download('Solicitud_Cambio_Tema_Grupo '.$query.'.pdf');
}
    ////////////////////////////////////////////

public function spicontaCoordinador(){
    $cambiotema=new cambioTema;
$time1= date('d-m-Y');
    $query=Input::get('codigo');
    $nuevotema=Input::get('nuevotema');
    $motivo=Input::get('motivo');       
    
    
    $gruposol=grupo_solicitud::findOrFail(Input::get('idsolicitud'));
    if($gruposol->estado!=0)
      {$gruposol->estado=4;
      	$gruposol->fechaenv=$time1;
    $gruposol->idpersona=\Auth::user()->idpersona;
         $gruposol->update();
     }
     

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
     $enunciado=Enunciado::all();
     $rol_carrera=rol_carrera::all();
       $gso=grupo_solicitud::all();
     UtilFunctions::getUserNotify('DIRECTOR GENERAL',$gruposol->idgrupo)->notify(new SolicitudCambioTema($gruposol,UtilFunctions::DIRECTOR_GENERAL));
     

   $pdf= \PDF::setOptions([
            'images' => true
        ])->loadView('ues.solicitudesconta.prorrogaiCoordinador',["codigo"=>$query,"motivo"=>$motivo,"nuevotema"=>$nuevotema],compact('departamento','rol','carrera','rol_carrera','grupo','estudianteg','estudiante','tipotema','personas','asesores','docentes','user','gso','enunciado'));
     return $pdf->download('Solicitud_Cambio_Tema_Coordinador '.$query.'.pdf');
 }

 public function spicontaDirector(){

    $query=Input::get('codigo');
    $nuevotema=Input::get('nuevotema');
    $motivo=Input::get('motivo');   

    
    $gruposol=grupo_solicitud::findOrFail(Input::get('idsolicitud'));
    $gruposol->estado=0;
    $gruposol->update();
    
    
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
  $gso=grupo_solicitud::all();
  $enunciado=Enunciado::all();
    
    $pdf=\PDF::loadview('ues.solicitudesconta.prorrogaiDirector',["codigo"=>$query,"motivo"=>$motivo,"nuevotema"=>$nuevotema],compact('departamento','rol','carrera','rol_carrera','grupo','estudianteg','estudiante','tipotema','personas','asesores','docentes','user','gso','enunciado'));
    return $pdf->download('Solicitud_Cambio_Tema_Director '.$query.'.pdf');
}

/////////////////////////////////////////////////////////////////////////////////////////

public function sRatificaciondeTribunal(Request $request){
    

   $time = strtotime(Input::get('fechar'));
   $time1= date('d-m-Y');

$newformat = date('d-m-Y',$time);
    $gruposol=new grupo_solicitud;
    $idgrupo=Input::get('idgrupo'); 
    $consulta = etapas_grupos::all();
    $gruposol->idgrupo=Input::get('idgrupo');
    $gruposol->idsolicitud=Input::get('idsolicitud');
    $gruposol->estado=4;
    $gruposol->fechaenv=$time1;
    $gruposol->idpersona=\Auth::user()->idpersona;
    $gruposol->condicion=true;
    $gruposol->fecha=$newformat;
    $netapas=Input::get('netapas');

 $gruposol->etapa=$netapas;

    /*foreach ($consulta as $c) {
       if ($c->idgrupo==$idgrupo && $c->estado==1) {
         $gruposol->etapa=$c->idnuevaetapa;
     }
 }*/

 $gruposol->save();


 $query=Input::get('codigo');
 $nuevotema=Input::get('nuevotema');
 $motivo='';        

 $grupo = Grupo::where(['codigoG'=>$query])->get()->first();
 
 foreach ($request['docentes'] as $docente) {
    $docentes_tribunal = DocenteSolicitud::create(['iddocente'=>$docente,'idgrupsol'=>$gruposol->idgrupsol]);
}


$notificacion = array(
    'message' => 'La solicitud ha sido creada con éxito.', 
    'alert-type' => 'info'
);

UtilFunctions::getUserNotify('COORDINADOR GENERAL',$gruposol->idgrupo)->notify(new SolicitudRatificacionTribunal($gruposol,UtilFunctions::COORDINADOR_GENERAL));
return Redirect()->back()->with($notificacion);

}


public function sRatificaciondeTribunalCoordinador(Request $request){
    
    $gruposol=new grupo_solicitud;
    $gruposol->idgrupo=Input::get('idgrupo');
    $gruposol->idsolicitud=Input::get('idsolicitud');

    $gruposol=grupo_solicitud::findOrFail(Input::get('idsolicitud'));
    if($gruposol->estado==3)
      {$gruposol->estado=4;
         $gruposol->update();}

         $query=Input::get('codigo');
         $nuevotema=Input::get('nuevotema');
         $motivo='';        

         $grupo = Grupo::where(['codigoG'=>$query])->get()->first();
         
    /*foreach ($request['docentes'] as $docente) {
        $docentes_tribunal = DocenteSolicitud::create(['iddocente'=>$docente,'idgrupsol'=>$gruposol->idgrupsol]);
    }
 */
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
    $dt=DocenteSolicitud::all();
    $enunciado=Enunciado::all();
    $carrera=Carrera::all();
    $rol=Rol::all();
    $rol_carrera=rol_carrera::all();
      UtilFunctions::getUserNotify('DIRECTOR GENERAL',$gruposol->idgrupo)->notify(new SolicitudRatificacionTribunal($gruposol,UtilFunctions::DIRECTOR_GENERAL));
    $pdf=\PDF::loadview('ues.solicitudesconta.tribunalCoordinador',["codigo"=>$query,"motivo"=>$motivo,"nuevotema"=>$nuevotema],compact('gruposol','departamento','rol','carrera','rol_carrera','grupo','estudianteg','estudiante','tipotema','personas','asesores','docentes','user','dt','enunciado'));
    return $pdf->download('Solicitud_Tribunal_Coordinador '. $query.'.pdf');

  


}
///////////////////////////////////////////////////////////////
public function sRatificaciondeTribunalAsesor(Request $request){
   
  return Redirect()->back();

}
////////////////////////////////////////////////////////////////

public function sRatificaciondeTribunalDirector(Request $request){
    
 $gruposol=new grupo_solicitud;
 $gruposol->idgrupo=Input::get('idgrupo');
 $gruposol->idsolicitud=Input::get('idsolicitud');

 $gruposol=grupo_solicitud::findOrFail(Input::get('idsolicitud'));
 if ($gruposol->estado==4) {
 	$gruposol->estado=0;
 $gruposol->update();
 }
 

 $query=Input::get('codigo');
 $nuevotema=Input::get('nuevotema');
 $motivo='';        

 $grupo = Grupo::where(['codigoG'=>$query])->get()->first();
 
    /*foreach ($request['docentes'] as $docente) {
        $docentes_tribunal = DocenteSolicitud::create(['iddocente'=>$docente,'idgrupsol'=>$gruposol->idgrupsol]);
    }*/
    
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
    $dt=DocenteSolicitud::all();
    $enunciado=Enunciado::all();
    $carrera=Carrera::all();
    $rol=Rol::all();
    $rol_carrera=rol_carrera::all();
    $pdf=\PDF::loadview('ues.solicitudesconta.tribunalDirector',["codigo"=>$query,"motivo"=>$motivo,"nuevotema"=>$nuevotema],compact('gruposol','departamento','rol','carrera','rol_carrera','grupo','estudianteg','estudiante','tipotema','personas','asesores','docentes','user','dt','enunciado'));
    return $pdf->download('Solicitud_Tribunal_Director '. $query.'.pdf');

}



////////////////////
/////registro de documentos cambio de tema 
public function registrardocmodtema(Request $request){

            


             $gs=grupo_solicitud::findOrFail(Input::get('idsolicitud'));
            $grupos=Grupo::findOrFail(Input::get('idgrupo'));
            // $grupos=new Grupo;
            $solicitud=Solicitud::all();
           
            
            if($request->file('dcenviados')!=null){
            $file = $request->file('dcenviados');
                 //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta=$request->get('idgrupo');
           //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/'.$ruta.'/'.$ruta.'-solicitud-modificaciontema'.$gs->idgrupsol.'.pdf',  \File::get($file));
            $gs->pdf=$ruta.'/'.$ruta.'-solicitud-modificaciontema'.$gs->idgrupsol.'.pdf';
            $gs->update();
            }


                if($request->file('solicituddir')!=null){
        $file = $request->file('solicituddir');
                 //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        $ruta=$request->get('idgrupo');
           //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('solicituddir')->put('/'.$ruta.'/'.$ruta.'-solicitud-modificaciontema'.$gs->idgrupsol.'.pdf',  \File::get($file));
        $gs->solicituddir=$ruta.'/'.$ruta.'-solicitud-modificaciontema'.$gs->idgrupsol.'.pdf';
        $gs->update();
    }

            if($request->file('dcrecibidos')!=null){
           $file = $request->file('dcrecibidos');
                 //obtenemos el nombre del archivo
           $nombre = $file->getClientOriginalName();
            $ruta=$request->get('idgrupo');
           //indicamos que queremos guardar un nuevo archivo en el disco local
           \Storage::disk('documentosrecibidos')->put('/'.$ruta.'/'.$ruta.'-modificaciontema'.$gs->idgrupsol.'.pdf',  \File::get($file));
            $gs->pdfrecibido=$ruta.'/'.$ruta.'-modificaciontema'.$gs->idgrupsol.'.pdf';
            $gs->update();
            }
            if($request['nacuerdo']!=null){
            $gs->nacuerdo=$request['nacuerdo'];
            
            $gs->update();
            }
             if($request['aprobado']==0){
            $gs->aprobado=$request['aprobado'];
           $gs->estado=1;
           $nuevotema=Input::get('nuevotema');
        
           $grupos->tema=$nuevotema;

           $grupos->update();
            $gs->update();
            }else{
                $gs->estado=7;
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

         ///////////////7regsitras doc tribunal
 public function registrardoctribcal(Request $request){

            


            $gs=grupo_solicitud::findOrFail(Input::get('idsolicitud'));
            if($request->file('dcenviados')!=null){
            $file = $request->file('dcenviados');
                 //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $ruta=$request->get('idgrupo');
           //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('documentosenviados')->put('/'.$ruta.'/'.$ruta.'-solicitud-tribunalcalificador'.$gs->idgrupsol.'.pdf',  \File::get($file));
            $gs->pdf=$ruta.'/'.$ruta.'-solicitud-tribunalcalificador'.$gs->idgrupsol.'.pdf';
            $gs->update();
            }


                if($request->file('solicituddir')!=null){
        $file = $request->file('solicituddir');
                 //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        $ruta=$request->get('idgrupo');
           //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('solicituddir')->put('/'.$ruta.'/'.$ruta.'-solicitud-tribunal-calificador'.$gs->idgrupsol.'.pdf',  \File::get($file));
        $gs->solicituddir=$ruta.'/'.$ruta.'-solicitud-tribunal-calificador'.$gs->idgrupsol.'.pdf';
        $gs->update();
    }

            if($request->file('dcrecibidos')!=null){
           $file = $request->file('dcrecibidos');
                 //obtenemos el nombre del archivo
           $nombre = $file->getClientOriginalName();
            $ruta=$request->get('idgrupo');
           //indicamos que queremos guardar un nuevo archivo en el disco local
           \Storage::disk('documentosrecibidos')->put('/'.$ruta.'/'.$ruta.'-tribunalcalificador'.$gs->idgrupsol.'.pdf',  \File::get($file));
            $gs->pdfrecibido=$ruta.'/'.$ruta.'-tribunalcalificador'.$gs->idgrupsol.'.pdf';
            $gs->update();
            }
            if($request['nacuerdo']!=null){
            $gs->nacuerdo=$request['nacuerdo'];
            $gs->estado=1;
            $gs->update();
            }

///////////////////////////


             if($request['aprobado']==0){
            $gs->aprobado=$request['aprobado'];
           $gs->estado=1;
            $gs->update();
            }else{
                $gs->estado=7;
            $gs->update();
            }



            ////////////////
            $notificacion = array(
                'message' => 'Documentos almacenados con éxito.', 
                'alert-type' => 'info'
            );
           //return redirect()->back()->with($notificacion);
            return Redirect()->back()->with($notificacion);
            // ->with($periodos)
            }




}