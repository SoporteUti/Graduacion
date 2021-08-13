<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\Bitacora;
use sispg\User;
use sispg\Persona;
use DB;
use sispg\Utils\UtilFunctions;

class BitacoraController extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR']);
    }

    public function getBitacora(){
  			

$usuario=DB::table("users")->join("personas","users.idpersona","=","personas.idpersona")->where('personas.tipo', '=','docente')->get();
$persona=Persona::all();
        return view("ues.seguridad.bitacora",["usuario"=>$usuario,"persona"=>$persona]);

    }
    
public function getBitacoraUser($id){
        
      $usuario=User::find($id);
      $persona=Persona::find($usuario->idpersona);
      $bitacora=Bitacora::where('idusuario','=', $id)->get();
      return view("ues.seguridad.bitacoraUsuario",['usuario' =>$usuario,'bitacora'=>$bitacora,'persona'=>$persona]);
    }
  
}
