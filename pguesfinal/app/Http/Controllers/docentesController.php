<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;


use sispg\Docente;
use sispg\Categoria;
use sispg\Persona;
use sispg\Carrera;
use sispg\Departamento;
use sispg\Facultad;
use Illuminate\Support\Facades\Redirect;
use sispg\Http\Requests\docentesFormRequest;
use DB;
use PDF;
use Validator;
use Exception;
use Illuminate\Support\Facades\Input;
use Response;
use sispg\Utils\UserCredentialGenerator;
use sispg\UserCredentials;
use Illuminate\Support\Facades\Mail;
use sispg\Bitacora;
use sispg\User;
use Auth;

class docentesController extends Controller
{
    //
    public function __construct(){


    }


    public function index(Request $request){
        $categorias=Categoria::all();
        /*if($request){
            $query=trim($request->get('searchText'));
            $docentes=DB::table('docentes')->where('nombre','LIKE','%'.$query.'%')
            //->where('condicion','=','1')
            ->orderBy('iddocente','desc')
            ->paginate(160);
            return view('ues.docentes.index',["docentes"=>$docentes,"searchText"=>$query],compact('categorias'));
        }*/
        /* $personas = DB::table('personas')
        ->join('docentes','docentes.idpersona','=','personas.idpersona')
        ->join('categorias','docentes.idcategoria','=','categorias.idcategoria')
        ->select('docentes.iddocente','docentes.titulo','docentes.idcategoria','docentes.lugar','docentes.idpersona','personas.idpersona','personas.nombres','personas.apellidos','personas.telefono','personas.correo')
        ->where('personas.condicion',1)
        ->where('categorias.condicion',1)
        ->get();
*/
       $docentes=Docente::all();
        $personas=Persona::all();
        return view('ues.docentes.index',["docentes"=>$docentes,"personas"=>$personas],compact('categorias'));
    }

    public function create(){

        return  view("ues.docentes.create");
    }

    public function store(docentesFormRequest $request){

         $ucg = new UserCredentialGenerator();

       $user= new UserCredentials;
       $temp = $ucg->generateE('Docente');
       $user->password = bcrypt($temp->password);
            $user->name=  $request->get('nombres');
                $user->email=  $request->get('correo'); 



        $docente =new Docente;
        $persona =new Persona;

        $persona->nombres=$request->get('nombres');
        $persona->apellidos=$request->get('apellidos');
        $persona->telefono=$request->get('telefono');
        $persona->correo=$request->get('correo');
        $persona->condicion=true;
        $persona->tipo='docente';
        $persona->dui=$request->get('dui');
        $persona->fechanac=$request->get('fechanac');
        $persona->direccion=$request->get('direccion');
        $persona->sexo=$request->get('sexo');
        $docente->idcategoria=$request->get('categoria');
        $docente->titulo=$request->get('titulo');
        $docente->lugar=$request->get('lugar');

        //este para insertar debe de ir antes de persona->update

//FOTO
if($request->file('foto')){
  $foto = $request->file('foto');
  $ruta=$request->get('correo');
  $extension = $foto->getClientOriginalExtension();
  \Storage::disk('fotos')->put("/$ruta/$ruta-foto.$extension",  \File::get($foto));
  $persona->foto_url =  "$ruta/$ruta-foto.$extension";
}

        

   $persona->save();
  $docente->idpersona=$persona->idpersona;
  $docente->save();

  $user->idpersona=$persona->idpersona;
  $user->save();
  $docente->save();
  Mail::send('ues.emails.confirmation_code', ['user' => $user, 'temp' =>$temp, 'persona'=>$persona], function ($m) use ($user) { $m->from(' apg.ues2018@gmail.com ', 'Apg.Ues'); $m->to($user->email, $user->name)->subject('Apg.UES Usuario Registrado!!'); });
    $notificacion = array(
            'message' => 'El Docente se ha registrado con éxito.', 
            'alert-type' => 'info'
        );


////bitacora/////////
      $date = new \DateTime();
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Registró un nuevo Docente";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Nombre: ".$persona->nombres." , "." Apellidos: ".$persona->apellidos." , "."Correo:".$persona->correo;
        $bitacora->save();
        ////bitacora/////////


       return redirect()->back()->with($notificacion);

    }

    public function show($id){

        return view("ues.docentes.show",["docentes"=>Docente::findOrFail($id)]);
    }

    public function edit($id){

        return view("ues.docentes.edit",["docentes"=>Docente::findOrFail($id)]);

    }

    public function update(docentesFormRequest $request, $id){

        
        $persona=Persona::findOrFail($id);
        $persona->nombres=$request->get('nombres');
        $persona->apellidos=$request->get('apellidos');
        $persona->telefono=$request->get('telefono');
        $persona->correo=$request->get('correo');
        $persona->condicion='1';
        $persona->tipo='docente';
        $persona->sexo=$request->get('sexo');
        $persona->dui=$request->get('dui');
        $persona->fechanac=$request->get('fechanac');
        $persona->direccion=$request->get('direccion');



//FOTO
if($request->file('foto')){
  $foto = $request->file('foto');
  $ruta=$request->get('correo');
  $extension = $foto->getClientOriginalExtension();
  \Storage::disk('fotos')->put("/$ruta/$ruta-foto.$extension",  \File::get($foto));
  $persona->foto_url =  "$ruta/$ruta-foto.$extension";
}



        
        $persona->update();


        $docente=Docente::findOrFail(Input::get('iddocente'));

        $docente->idcategoria=$request->get('categoria');
        $docente->titulo=$request->get('titulo');
        $docente->lugar=$request->get('lugar');
        
        $docente->update();
////bitacora/////////
      $date = new \DateTime();
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Editó un Docente";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Nombre: ".$persona->nombres." , "." Apellidos: ".$persona->apellidos." , "."Correo:".$persona->correo;
        $bitacora->save();
        ////bitacora/////////
       
    $notificacion = array(
            'message' => 'El Docente se ha modificado con éxito.', 
            'alert-type' => 'info'
        );


       return redirect()->back()->with($notificacion);


    }

    public function destroy($id){

//      $docente=Docente::findOrFail($id);
        $persona=Persona::findOrFail($id);
if ($persona->condicion==false) {
            $persona->condicion=true;

  $notificacion = array(
            'message' => 'El Docente se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $persona->condicion=false;
              $notificacion = array(
            'message' => 'El Docente se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
        
        $persona->update();
        return Redirect::to('ues/docentes')->with($notificacion);;

    }

    /*--Valida Telefono Docente--*/
   public function postTelefonoDocValid(Request $request)
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


 /*--Valida Correo Docente--*/
   public function postCorreoDocValid(Request $request)
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

    /*--Valida Telefono Docente--*/
   public function postDuiDocValid(Request $request)
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

/////PDF Lista de docentes
public function pdflistaDocentes(){
 // $persona=Persona::findOrFail($id); 
     $persona=Persona::all();
        $carreras=Carrera::all();
        $docentes=Docente::all();
        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all();
        
        
  //return view("ues.docentes.listaDoc",array('persona' =>$persona,'carreras' =>$carreras,'docentes' =>$docentes,'user'=>$user,'departamento'=>$departamento,'facultades'=>$facultades));

      $pdf=\PDF::loadview('ues.docentes.listaDoc',  array('carreras'=>$carreras,'persona'=>$persona,'user'=>$user,'docentes'=>$docentes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
      return $pdf->stream('Lista_Docentes_Activos.pdf');
}

public function pdflistaDocentesI(){
 // $persona=Persona::findOrFail($id); 
     $persona=Persona::all();
        $carreras=Carrera::all();
        $docentes=Docente::all();
        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all();
        
        
  //return view("ues.docentes.listaDoc",array('persona' =>$persona,'carreras' =>$carreras,'docentes' =>$docentes,'user'=>$user,'departamento'=>$departamento,'facultades'=>$facultades));

      $pdf=\PDF::loadview('ues.docentes.listaDocI',  array('carreras'=>$carreras,'persona'=>$persona,'user'=>$user,'docentes'=>$docentes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
      return $pdf->stream('Lista_Docentes_Inactivos.pdf');
}
/// pdf perfil docente
public function pdfPerfilDoc($id){

        $personas=Persona::findOrFail($id);
        $categorias=Categoria::all();
        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all();
        $docentes=Docente::all();
        $carreras=Docente::all();
   
         $pdf=\PDF::loadview('ues.docentes.perfilDoc',  array('carreras'=>$carreras,'personas'=>$personas,'user'=>$user,'categorias'=>$categorias,'docentes'=>$docentes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Perfil_Docentes.pdf');
        

    }


}
