<?php

namespace sispg\Http\Controllers;



use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\Estudiante;
use sispg\Persona;
use sispg\Facultad;
use sispg\Departamento;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use sispg\Http\Requests\EstudianteFormRequest;
use sispg\Utils\UserCredentialGenerator;
use DB;
use Validator;
use Exception;
use sispg\Carrera;
use sispg\UserCredentials;
use Response;
use sispg\Utils\UtilFunctions;
use sispg\Bitacora;
use sispg\Grupo;
use sispg\User;
use Auth;

class EstudianteController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR','JEFE DE DEPARTAMENTO',
            'COORDINADOR GENERAL','ESTUDIANTE','ASESOR']);
    }
    
   
    public function index(Request $request ){
$carreras=Carrera::all();
   $persona=Persona::all(); 
   $user=  UserCredentials::all();
        $estudiante=Estudiante::all();
        $ciclo=DB::table('estudiantes')->select('ciclo')->where('ciclo','!=',null)->groupBy('ciclo')->get();
        
        return view('ues.estudiantes.index',["ciclo"=>$ciclo,"estudiante"=>$estudiante, "persona"=>$persona, "user"=>$user], compact('carreras'));          }

        public function pdfEstudiantes(){
$ciclo=Input::get('ciclo');
          $persona=Persona::all();
        $carreras=Carrera::all();
        $estudiantes=Estudiante::all();
        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all();

        $pdf=\PDF::loadview('ues.estudiantes.pdfestudiantes',  array('ciclo'=>$ciclo,'carreras'=>$carreras,'persona'=>$persona,'user'=>$user,'estudiantes'=>$estudiantes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Estudiantes_ciclo.pdf');
        }


    public function show($id){

      return view("ues.estudiantes.show", ["estudiante"=>estudiante::findOrFail($id)]);
    }
    public function edit($id){
  return view("ues.estudiantes.edit", ["estudiante"=>estudiante::findOrFail($id)]);
      
    }
    public function create(){
        
return  view("ues.estudiantes.create");
      
    }
    public function destroy($id){

      $persona=Persona::findOrFail($id);
      if ($persona->condicion==false) {
            $persona->condicion=true;

  $notificacion = array(
            'message' => 'El Estudiante se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $persona->condicion=false;
              $notificacion = array(
            'message' => 'El Estudiante se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
        $persona->update();

       return redirect()->back()->with($notificacion);
    }

    
    public function update(EstudianteFormRequest $request,$id){

      $persona=persona::findOrFail($id);
      
        $persona->nombres=$request->get('nombres');
        $persona->apellidos=$request->get('apellidos');
        $persona->sexo=$request->get('sexo');
        $persona->fechanac=$request->get('fechanac');
        
        $persona->condicion=true;
         $persona->direccion=$request->get('direccion');
          $persona->dui=$request->get('dui');
          $persona->correo=$request->get('correo');
          $persona->telefono=$request->get('telefono');



          //FOTO
if($request->file('foto')){
  $foto = $request->file('foto');
  $ruta=$request->get('carnet');
  $extension = $foto->getClientOriginalExtension();

  \Storage::disk('fotos')->put("$ruta/$ruta-foto.$extension",  \File::get($foto));
  
  $persona->foto_url = "$ruta/$ruta-foto.$extension"; 
}


   $persona->update();


           
$estudiante=estudiante::findOrFail(Input::get('idestudiante'));

          $estudiante->anioegreso=$request->get('anioegreso');
          $estudiante->ciclo=Input::get('ciclo')."-".Input::get('anio');
            $estudiante->idcarrera=$request->get('carrera');
            if($request->get('pera')==1){
             $estudiante->pera=true;
            }else{$estudiante->pera=false;}
        if($request->get('horassociales')==1){
             $estudiante->horassoc=true;
            }else{$estudiante->horassoc=false;}
            

       ////curriculummmm
        if($request->file('curriculum')!=null){
       $file = $request->file('curriculum');
             //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
        $ruta=$request->get('carnet');
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('curriculums')->put('/'.$ruta.'/'.$ruta.'-Curriculum.pdf',  \File::get($file));
$estudiante->curriculum=$ruta.'/'.$ruta.'-Curriculum.pdf';
        }

        ////partidaaaaa
        if($request->file('partida')!=null){
       $file = $request->file('partida');
             //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
        $ruta=$request->get('carnet');
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('partidas')->put('/'.$ruta.'/'.$ruta.'-Partida.pdf',  \File::get($file));
$estudiante->partida=$ruta.'/'.$ruta.'-Partida.pdf';
        }
  ////carta egreso
        if($request->file('carta')!=null){
       $file = $request->file('carta');
             //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
        $ruta=$request->get('carnet');
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('cartas_egreso')->put('/'.$ruta.'/'.$ruta.'-Carta.pdf',  \File::get($file));
$estudiante->carta=$ruta.'/'.$ruta.'-Carta.pdf';
        }





 $estudiante->update();


$user=UserCredentials::findOrFail(Input::get('idusuario'));
     $user->email=$request->get('correo');
     $user->update();
////bitacora/////////
      $date = new \DateTime();
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Editó un Estudiante";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Carnet:".$estudiante->carnet.","."Nombre: ".$persona->nombres." , "." Apellidos: ".$persona->apellidos." , "."Correo:".$persona->correo;
        $bitacora->save();
        ////bitacora/////////
      $notificacion = array(
            'message' => 'El Estudiante se ha Actualizado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);
    }

    public function store(EstudianteFormRequest $request){
            $estudiante=new Estudiante;
            $persona =new Persona;

$ucg = new UserCredentialGenerator();

       $user= new UserCredentials;
       $temp = $ucg->generateE('Estudiante');
       $user->password = bcrypt($temp->password);
            $user->name=  $request->get('carnet');
                $user->email=  $request->get('correo');  
                 $user->api_token=sha1(uniqid());
               


        $estudiante->carnet=$request->get('carnet');

        $persona->nombres=$request->get('nombres');
        $persona->apellidos=$request->get('apellidos');
        $persona->sexo=$request->get('sexo');
        $persona->fechanac=$request->get('fechanac');
        $estudiante->idcarrera=$request->get('carrera');
        $estudiante->ciclo=Input::get('ciclo')."-".Input::get('anio');
        $persona->condicion=true;
        $persona->direccion=$request->get('direccion');
        $persona->dui=$request->get('dui');
        $estudiante->anioegreso=$request->get('anioegreso');
        $persona->tipo='estudiante';
        
        if($request->get('pera')==1){
        $estudiante->pera=true;
        }elseif($request->get('pera')==0){$estudiante->pera=false;}
        if($request->get('horassociales')==1){
        $estudiante->horassoc=true;
        }elseif($request->get('horassociales')==0)
        {$estudiante->horassoc=false;}
        $persona->correo=$request->get('correo');
        $persona->telefono=$request->get('telefono');

 ////carta egreso
        if($request->file('carta')!=null){
       $file = $request->file('carta');
             //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
        $ruta=$request->get('carnet');
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('cartas_egreso')->put('/'.$ruta.'/'.$ruta.'-Carta.pdf',  \File::get($file));
$estudiante->carta=$ruta.'/'.$ruta.'-Carta.pdf';
        }


 
       ////curriculummmm
        if($request->file('curriculum')!=null){
       $file = $request->file('curriculum');
             //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
        $ruta=$request->get('carnet');
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('curriculums')->put('/'.$ruta.'/'.$ruta.'-Curriculum.pdf',  \File::get($file));
$estudiante->curriculum=$ruta.'/'.$ruta.'-Curriculum.pdf';
        }

        ////partidaaaaa
        if($request->file('partida')!=null){
       $file = $request->file('partida');
             //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();
        $ruta=$request->get('carnet');
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('partidas')->put('/'.$ruta.'/'.$ruta.'-Partida.pdf',  \File::get($file));
$estudiante->partida=$ruta.'/'.$ruta.'-Partida.pdf';
        }


//este para insertar debe de ir antes de persona->update

//FOTO
if($request->file('foto')){
  $foto = $request->file('foto');
  $ruta=$request->get('carnet');
  $extension = $foto->getClientOriginalExtension();
  \Storage::disk('fotos')->put("/$ruta/$ruta-foto.$extension",  \File::get($foto));
  $persona->foto_url =  "$ruta/$ruta-foto.$extension";
}


try { 
  $persona->save();
  $estudiante->idpersona=$persona->idpersona;
  $estudiante->save();
  $user->idpersona=$persona->idpersona;
  $user->save();

 
Mail::send('ues.emails.confirmation_code', ['user' => $user, 'temp' =>$temp, 'persona'=>$persona], function ($m) use ($user) { $m->from(' apg.ues2018@gmail.com ', 'Apg.Ues'); $m->to($user->email, $user->name)->subject('Apg.UES Usuario Registrado!!'); });

////bitacora/////////
      $date = new \DateTime();
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Registró un nuevo Estudiante";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Carnet:".$estudiante->carnet.","."Nombre: ".$persona->nombres." , "." Apellidos: ".$persona->apellidos." , "."Correo:".$persona->correo;
        $bitacora->save();
        ////bitacora/////////
    $notificacion = array(
            'message' => 'El Estudiante se ha registrado con éxito.', 
            'alert-type' => 'info'
        );
} catch (Exception $e) { 
 $notificacion = array(
            'message' => 'El Estudiante No se ha registrado con éxito.', 
            'alert-type' => 'error'
        );
}

        
   return redirect()->back()->with($notificacion);    
      
}


   /*--Valida Telefono Estudiante--*/
  public function postTelefonoEstValid(Request $request)
  {

      $id=$request->input('id');
     
      if(isset($id)){
            $usuR=$request->input('telefono');
            $isAvailable=true;
            $resultado = Persona::where('telefono','=',$usuR)->where('id','!=',$id)->count();
               if($resultado==1){
                    $isAvailable=false;
                }
           echo json_encode(array(
           'valid' => $isAvailable,
      ));
    
      }
      else{
      $usuR=$request->input('telefono');
      $isAvailable=true;
      $resultado = Persona::where('telefono','=',$usuR)->count();
      if($resultado==1){
      $isAvailable=false;
      }
      echo json_encode(array(
      'valid' => $isAvailable,
      ));

      }        
  }


/*--Valida Correo Estudiante--*/
  public function postCorreoEstValid(Request $request)
  {

      $id=$request->input('id');
     
      if(isset($id)){
            $usuR=$request->input('correo');
            $isAvailable=true;
            $resultado = Persona::where('correo','=',$usuR)->where('id','!=',$id)->count();
               if($resultado==1){
                    $isAvailable=false;
                }
           echo json_encode(array(
           'valid' => $isAvailable,
      ));
    
      }
      else{
      $usuR=$request->input('correo');
      $isAvailable=true;
      $resultado = Persona::where('correo','=',$usuR)->count();
      if($resultado==1){
      $isAvailable=false;
      }
      echo json_encode(array(
      'valid' => $isAvailable,
      ));

      }        
  }

   /*--Valida Dui Estudiante--*/
  public function postDuiEstValid(Request $request)
  {

      $id=$request->input('id');
     
      if(isset($id)){
            $usuR=$request->input('dui');
            $isAvailable=true;
            $resultado = Persona::where('dui','=',$usuR)->where('id','!=',$id)->count();
               if($resultado==1){
                    $isAvailable=false;
                }
           echo json_encode(array(
           'valid' => $isAvailable,
      ));
    
      }
      else{
      $usuR=$request->input('dui');
      $isAvailable=true;
      $resultado = Persona::where('dui','=',$usuR)->count();
      if($resultado==1){
      $isAvailable=false;
      }
      echo json_encode(array(
      'valid' => $isAvailable,
      ));

      }        
  }

  /*--Valida carnet Estudiante--*/
  public function postCarnetEstValid(Request $request)
  {

      $id=$request->input('id');
     
      if(isset($id)){
            $usuR=$request->input('carnet');
            $isAvailable=true;
            $resultado = Estudiante::where('carnet','=',$usuR)->where('id','!=',$id)->count();
               if($resultado==1){
                    $isAvailable=false;
                }
           echo json_encode(array(
           'valid' => $isAvailable,
      ));
      
      }
      else{
      $usuR=$request->input('carnet');
      $isAvailable=true;
      $resultado = Estudiante::where('carnet','=',$usuR)->count();
      if($resultado==1){
      $isAvailable=false;
      }
      echo json_encode(array(
      'valid' => $isAvailable,
      ));

      }        
  }



public function getAlumns($id)
  {
    $grupo = Grupo::findOrFail($id);

    $alumnos = array();
    //dd($grupo->estudiantes_grupo);
    foreach ($grupo->estudiantes_grupo as $integrante) {
      array_push($alumnos,array('id'=>$integrante->estudiante->idestudiante,'nombre'=>$integrante->estudiante->persona->full_name));
    }

    return response()->json([
      'alumnos'=> $alumnos
    ]);
  }

////////stepsEst
  public function llenarEstudiantes($id){

  //$persona=Persona::all();
  $persona=Persona::findOrFail($id); 
  $carreras=Carrera::all();
  $estudiantes=Estudiante::all();
   
  return  view("ues.estudiantes.stepsEst")
  ->with('estudiantes',$estudiantes)
  ->with('carreras',$carreras)
  ->with('persona',$persona);
  }

  ////reporte de lisatdo de estudiantes

public function pdflistaEstudiantes(){
 // $persona=Persona::findOrFail($id); 
     $persona=Persona::all();
        $carreras=Carrera::all();
        $estudiantes=Estudiante::all();
        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all();

        $pdf=\PDF::loadview('ues.estudiantes.listaEst',  array('carreras'=>$carreras,'persona'=>$persona,'user'=>$user,'estudiantes'=>$estudiantes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Estudiantes_Activos.pdf');

}

public function pdflistaEstudiantesI(){
 // $persona=Persona::findOrFail($id); 
     $persona=Persona::all();
        $carreras=Carrera::all();
        $estudiantes=Estudiante::all();
        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all();

       $pdf=\PDF::loadview('ues.estudiantes.listaEstI',  array('carreras'=>$carreras,'persona'=>$persona,'user'=>$user,'estudiantes'=>$estudiantes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Estudiantes_Inactivos.pdf');

}

///////////////// pdf perfil estudiante


public function pdfPerfilEst($id){

  //$persona=Persona::all();
  $persona=Persona::findOrFail($id); 
  $carreras=Carrera::all();
  $estudiantes=Estudiante::all();
  $user=user::all();
   $departamento=Departamento::all();
        $facultades=Facultad::all();
   
   $pdf=\PDF::loadview('ues.estudiantes.perfilEst',  array('carreras'=>$carreras,'persona'=>$persona,'user'=>$user,'estudiantes'=>$estudiantes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Perfil_Estudiante.pdf');
  }




/////////////actualizar los datos del estudiante
 public function updateEstudiantes($id){
 $persona=Persona::findOrFail($id); 
  $carreras=Carrera::all();
  $estudiantes=Estudiante::all();
  
  return  view("ues.estudiantes.stepsEstUpdate")
  ->with('estudiantes',$estudiantes)
  ->with('carreras',$carreras)
  ->with('persona',$persona);
}

public function actDatosEstudiante(Request $request, $id){
  $persona=persona::findOrFail($id);
  $persona->direccion=$request->get('direccion');
  $persona->correo=$request->get('correo');
  $persona->telefono=$request->get('telefono');

  $persona->update();

return redirect ()->route("ues.estudiantes.stepsEst",$id);
}

}

