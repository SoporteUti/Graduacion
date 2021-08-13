<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;
use sispg\Http\Requests;
use sispg\Usuario;
use sispg\Docente;
use sispg\Carrera;
use sispg\Rol_carrera;
use sispg\Rol;
use sispg\Persona;
use Illuminate\Support\Facades\Redirect;
use sispg\User;
use sispg\Facultad;
use sispg\Departamento;
use DB;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use sispg\Utils\UtilFunctions;

class UsuarioController extends Controller
{
    //
    public function __construct(){
        UtilFunctions::authorizeRoles(['ADMINISTRADOR','ESTUDIANTE','COORDINADOR GENERAL','ASESOR','JEFE DE DEPARTAMENTO','DIRECTOR GENERAL']);
    }


     public function index(Request $request){
        $docentesU = Persona::select('personas.idpersona',DB::raw("personas.nombres as nombre, personas.apellidos as apellidos "))->join('users','personas.idpersona','=','users.idpersona')
        ->where('personas.tipo','=','docente')->get();


       $docentes=Docente::join('rol_carreras','docentes.iddocente','=','rol_carreras.iddocente')-> join('personas','personas.idpersona','=', 'docentes.idpersona')
       ->select('docentes.iddocente','personas.nombres','personas.apellidos','personas.condicion',DB::raw('COUNT(rol_carreras.iddocente) as rol'))->groupBy('personas.idpersona') -> groupBy('docentes.iddocente')->get();


       return  view("ues.usuarios.index")
       ->with('docentes',$docentes)
       ->with('docentesU',$docentesU)
       ->with('roles',Rol::all())
       ->with('roles1',Rol_carrera::all())
       ->with('personas',Persona::all())
       ->with('docen',Docente::all())
       ->with('departamento',Departamento::all())
       ->with('carreras',Carrera::all());
    }


    public function create(){

    	return  view("ues.usuarios.create");
    }

    public function store(Request $request){


    }

    public function user(Request $request){


    }
 public function storerca(Request $request){



    }

    public function show($id){

    	return view("ues.usuarios.show");
    }

    public function edit($id){

    	return view("ues.usuarios.edit",["usuarios"=>Usuario::findOrFail($id)]);

    }

    public function update(Request $request){
         $user = User::findOrFail($request['user_id']);

         if (auth()->attempt(['email' => Auth::user()->email, 'password' => $request->passa]))
        {
             

        $user->name = $request['usuario'];
        $user->password = bcrypt($request['pass']);
        $user->update();
           $notificacion = array(
            'message' => 'Datos Modificados con éxito.', 
            'alert-type' => 'info'
        );
        }else{  $notificacion = array(
            'message' => 'Error en la Contraseña.', 
            'alert-type' => 'info'
        );}

        
        return redirect()->back()->with($notificacion);
    }

    public function destroy($id){


    }


    public function getDocenteRoles($id)
    {
        $personas=persona::findOrFail($id); 
        $roles=Docente::join('personas','personas.idpersona','=','docentes.idpersona')
        ->join('rol_carreras','docentes.iddocente','=','rol_carreras.iddocente')
        ->join('roles','rol_carreras.idrol','=','roles.idrol')
        ->join('carreras','rol_carreras.idcarrera','=','carreras.idcarrera')
        ->select('rol_carreras.idrol_carrera','anio',DB::raw("CONCAT(roles.nombre,' - ',carreras.nombre) as nombre"))->where('docentes.idpersona','=',$id)->get();
       return response()->json([
            'docente' => $personas,
            'roles' => $roles
        ]);
    }

    public function deleteRol($id)
    {
        Rol_carrera::findOrFail($id)->delete();
        $notificacion = array(
            'message' => 'El Rol ha sido eliminado satisfactoriamente.', 
            'alert-type' => 'info',
            'title' => 'Rol'
        );
        return response()->json([
            'notificacion'=> $notificacion
        ]);
    }

    public function listRols($id)
    {
        $docente = persona::findOrFail($id);
       $iddocente=Persona::find($id)->docente->iddocente;
       
        return response()->json([
            'docente'=> $docente,
            'iddocente'=> $iddocente
        ]);
    }

    public function reloadRoles($idcarrera)
    {

        $roles = Rol::all();
        $carrera = Carrera::findOrFail($idcarrera);

        $anio =date('Y');
        $num_rol_jefe=DB::table('rol_carreras')->join('roles','roles.idrol','=','rol_carreras.idrol')
        ->join('carreras','rol_carreras.idcarrera','=','carreras.idcarrera')
        ->join('departamentos','departamentos.iddepartamento','=','carreras.iddepartamento')
        ->where('roles.nombre','=','JEFE DE DEPARTAMENTO')
        ->where('departamentos.iddepartamento','=',[$carrera->iddepartamento])->count();

        $num_rol_director=DB::table('rol_carreras')->join('roles','roles.idrol','=','rol_carreras.idrol')
        ->whereIn('roles.nombre',['DIRECTOR GENERAL'])
        ->count();

      
        $num_rol_coordinador=DB::table('rol_carreras')->join('roles','roles.idrol','=','rol_carreras.idrol')
        ->whereIn('roles.nombre',['COORDINADOR GENERAL'])
        ->where('rol_carreras.anio','=',[$anio])
        ->where('rol_carreras.idcarrera','=',[$idcarrera])
        ->count();

        $rol_jefe= Rol::where('roles.nombre',['JEFE DE DEPARTAMENTO'])->first()->toArray();
        $rol_jefe['num']=$num_rol_jefe;

        $rol_director= Rol::where('roles.nombre',['DIRECTOR GENERAL'])->first()->toArray();
        $rol_director['num']=$num_rol_director;

      

        $rol_coordinador= Rol::where('roles.nombre',['COORDINADOR GENERAL'])->first()->toArray();
        $rol_coordinador['num']=$num_rol_coordinador;

        $roles = Rol::select('roles.idrol','roles.nombre')->get();

        return response()->json([
            'roles'=> $roles,
            'rol_jefe' => $rol_jefe,
            'rol_director' => $rol_director,
            'rol_coordinador' => $rol_coordinador
        ]);   
    }

    public function addrols(Request $request)
    {
        $anioo =date('Y');
        if($request['idrol']==3){
Rol_carrera::firstOrCreate([
            'idrol'=>$request['idrol'],
            'idcarrera'=>$request['idcarrera'],
            'iddocente'=>$request['iddocente'],
            'anio'=>$anioo,
            'condicion'=>true
        ]);


        }else{

        Rol_carrera::firstOrCreate([
            'idrol'=>$request['idrol'],
            'idcarrera'=>$request['idcarrera'],
            'iddocente'=>$request['iddocente'],
            'condicion'=>true
        ]);
    }
        $notificacion = array(
            'message' => 'El Rol han sido agregado satisfactoriamente.', 
            'alert-type' => 'success',
            'title' => 'Rol'
        );
        return response()->json([
            'notificacion'=> $notificacion
        ]);
    }

    public function removeRol(Request $request)
    {
        try {
                $rol_carrera = Rol_carrera::where([
                    ['idrol','=', $request->iddrol],
                    ['iddocente','=', $request->iddocente],
                    ['idcarrera','=', $request->idcarrera],
                ]);
                $rol_carrera->delete();
                $notificacion = array(
                    'message' => 'El Rol ha sido eliminado satisfactoriamente.', 
                    'alert-type' => 'success',
                    'title' => 'Rol'
                );

                return response()->json([
                    'notificacion'=> $notificacion
                ]);
            } catch (Exception $e) {
               return response()->json([
                    'error'=> $e->getMessage()
                ]); 
            }    
    }

    private function filter($object,$collection)
    {
        $tem = $collection->filter(function($rol_carrera)
        {
            if($rol_carrera->idrol==$object->idrol && $object->num == 0){
                return $rol_carrera;
            }
        });
        return $tem;
    }

/////PDF Lista de usuarios
public function pdflistaUser(Request $request){
 $iddepto=Input::get('dept');

        $docentesU = Persona::select('personas.idpersona',DB::raw("personas.nombres as nombre, personas.apellidos as apellidos "))->join('docentes','personas.idpersona','=','docentes.idpersona')->join('rol_carreras','docentes.iddocente','=','rol_carreras.iddocente')->join('carreras','rol_carreras.idcarrera','=','carreras.idcarrera')->where('carreras.iddepartamento','=',$iddepto)->groupBy('personas.idpersona')->get();
        
        $roles = Rol::select('roles.idrol','roles.nombre')->get();
        $carreras = Carrera::all();
        $docentes=Docente::all();
        $departamento=Departamento::all();
        
       $rol_carreras=Rol_carrera::all();
        //dd($roles);
        

         $pdf=\PDF::loadview('ues.usuarios.listaUser',  array('iddepto'=>$iddepto,'departamento'=>$departamento,'docentes'=>$docentes,'docentesU'=>$docentesU,'roles'=>$roles, 'carreras'=>$carreras,'rol_carreras'=>$rol_carreras))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Usuarios.pdf');
        
      

}
public function setAccess(Request $request)
{
    $user = Auth::user();
    $user->idcarrera=$request->get('select-carrera');
    $user->idrol=$request->get('select-rol');
    $user->update();
    return redirect('/home');
}
}
