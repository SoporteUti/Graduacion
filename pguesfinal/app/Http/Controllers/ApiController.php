<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use Response;
use sispg\User;
use sispg\AlumnoAsistencia;
use sispg\Notas;
use sispg\Ponderacion;
use sispg\Http\Requests;

class ApiController extends Controller
{
    public function login(Request $request)
    {   
        $name= strtoupper($request->email);
        $user_db = DB::table('users')->select('*')->where('name','=',$name)->first();

        if($user_db && Hash::check($request->password, $user_db->password)){
            $user = User::findOrFail($user_db->id);
            if ($user->persona->tipo == 'estudiante') {
                $periodo = array();
                $etapas = array();
                $gantt = '';
                $grupo = $user->persona->estudiante->estudiante_grupo->grupo;

                if ($grupo->periodo) {
                    array_push($periodo, array('name' => 'Periodo de Trabajo de graduaciòn','fromDate'=> $grupo->periodo->fInicio, 'toDate'=> $grupo->periodo->fFin));
                    $temp = $grupo->periodo->fInicio;
                    foreach ($grupo->periodo->fechas as $etapa) { 
                        $ponderacion = Ponderacion::where('idetapa',$etapa->etapa->idnuevaetapa)->get()->first()->porcentaje;
                        array_push($etapas, array('name' => $etapa->etapa->idnombreetapa,'startTime'=> $temp, 'endTime'=> $etapa->fechasetapas, 'order'=> $etapa->etapa->idetapa, 'percent'=> $ponderacion));
                        $temp = $etapa->fechasetapas;
                    }
                }

                $solicitudes = array();
		$soli=$user->persona->estudiante->estudiante_grupo->grupo->grupo_solicitud;
                if($soli)
                foreach ($soli as $sol) {
                    $to = '';
                    if ($sol['condicion'] == false) {
                        $to = 'Cancelada';
                    }else{
                        switch ($sol['estado']) {
                            case 0:
                                $to = 'Enviada a Junta Directiva';
                            break;
                            case 1:
                                $to = 'Aprobada';
                            break;
                            case 3:case 4:case 5:
                                $to =  'Enviada a : '. ucwords(strtolower($sol->rol['nombre']));
                            break;
                            case 7:
                                $to = 'Denegada';
                            break;
                            default:
                        # code...
                            break;
                        }                        
                    }
                    array_push($solicitudes, array('name' => $sol->solicitud['nombre'], 'status' => $sol['estado'], 'stage' => $sol['etapa'],'sendTo'=>$to));
                    
                }
                $porcentajes = array();

                foreach ($grupo->tema_grupo->nuevaetapas as $etapa) {
                    array_push($porcentajes, array('percent'=>$etapa->ponderacion->porcentaje,'stage'=>$etapa->idetapa));
                }
                ////////////////////////////////////////
                

           

                return Response::json([
                    'error' => false,
                    'username' => $user->name,
                    'email' => $user->email,
                    'api_token' => $user->api_token,
                    'name' => $user->persona->nombres,
                    'lastname' => $user->persona->apellidos,
                    'address' => $user->persona->direccion,
                    'sex' => $user->persona->sexo,
                    'birthday' => $user->persona->fechanac,
                    'dui' => $user->persona->dui,
                    'phone' => $user->persona->telefono,
                    'year' => \Carbon\Carbon::parse($user->persona->estudiante->anioegreso)->year,
                    'carnet' => $user->persona->estudiante->carnet,
                    'pera' => intval($user->persona->estudiante->pera),
                    'socialsHours' => intval($user->persona->estudiante->horassoc),
                    'careerName' => ($user->persona->estudiante)?$user->persona->estudiante->carrera->nombre:'',
                    'careerCode' => ($user->persona->estudiante)?$user->persona->estudiante->carrera->codigo:'',
                    'departmentName'=>$user->persona->estudiante->carrera->departamento->nombre,
                    'departmentCode'=>$user->persona->estudiante->carrera->departamento->codigo,
                    'photo' => $user->persona->foto_url,
                    'period' => $periodo,
                    'stages' => $etapas,
                    'stages_records'=>Notas::where([
                        ['idestudiante',$user->persona->estudiante->idestudiante],
                        ['idgrupo',$user->persona->estudiante->estudiante_grupo->idgrupo]
                    ])->get(),
                    'solicitudes' => $solicitudes,
                    'percent_stages'=>$porcentajes
                ],200);
            }else{
                return Response::json([
                    'error' => true,
                    'error_msg' => 'Lo siento por el momento la aplicacion es unicamente para estudiantes.',
                    'type' => 'versionError'
                ],501);
            }
        }
        return Response::json([
            'error' =>true,
            'error_msg' => 'Las credenciales no coinciden con nuestros registros.',
            'type' => 'loginError'
        ],401);
    }

    public function getapp(){

         $pathtoFile = public_path().'/android/'.'app-release.apk';
      return response()->download($pathtoFile);
    }
  public function getbackup(){

         $pathtoFile = public_path().'/android/'.'backup.7z';
      return response()->download($pathtoFile);
    }

    public function update(Request $request,User $user)
    {
        if (!Auth::guard('api')->user()) {
            return Response::json([
                'error' => true,
                'error_msg' => 'Debes de iniciar sesion para realizar esta opcion.',
                'type' => 'sessionError'
            ],401);
        }else{
            try{
                $user = Auth::guard('api')->user();
                $persona = $user->persona;
                $user->email = $request->get('email');
                $user->update();
                $persona->correo = $request->get('email');
                $persona->telefono = $request->get('phone');
  		$persona->correo = $request->get('email');
                $persona->update();


                $solicitudes = array();

                foreach ($user->persona->estudiante->estudiante_grupo->grupo->grupo_solicitud as $solicitud) {
                    $to = '';
                    if ($solicitud->condicion == false) {
                        $to = 'Cancelada';
                    }else{
                        switch ($solicitud->estado) {
                            case 0:
                                $to = 'Enviada a Junta Directiva';
                            break;
                            case 1:
                                $to = 'Aprobada';
                            break;
                            case 3:case 4:case 5:
                                $to =  'Enviada a : '. ucwords(strtolower($solicitud->rol->nombre));
                            break;
                            case 7:
                                $to = 'Denegada';
                            break;
                            default:
                        # code...
                            break;
                        }
                    }
                    array_push($solicitudes, array('name' => $solicitud->solicitud->nombre, 'status' => $solicitud->estado, 'stage' => $solicitud->etapa,'sendTo'=>$to));
                }

                return Response::json([
                    'error' => false,
                    'username' => $user->name,
                    'email' => $user->email,
                    'api_token' => $user->api_token,
                    'name' => $user->persona->nombres,
                    'lastname' => $user->persona->apellidos,
                    'address' => $user->persona->direccion,
                    'sex' => $user->persona->sexo,
                    'birthday' => $user->persona->fechanac,
                    'dui' => $user->persona->dui,
                    'phone' => $user->persona->telefono,
                    'year' => \Carbon\Carbon::parse($user->persona->estudiante->anioegreso)->year,
                    'carnet' => $user->persona->estudiante->carnet,
                    'pera' => intval($user->persona->estudiante->pera),
                    'socialsHours' => intval($user->persona->estudiante->horassoc),
                    'careerName' => ($user->persona->estudiante)?$user->persona->estudiante->carrera->nombre:'',
                    'careerCode' => ($user->persona->estudiante)?$user->persona->estudiante->carrera->codigo:'',
                    'departmentName'=>$user->persona->estudiante->carrera->departamento->nombre,
                    'departmentCode'=>$user->persona->estudiante->carrera->departamento->codigo,
                    'photo' => $user->persona->foto_url
                ],200);
            }catch(Exception $e){
                return Response::json([
                    'error' => true,
                    'error_msg' => 'Ha ocurrido un error.',
                    'type' => 'dataError'
                ],501);
            }
        }
    }

    public function getDates(Request $request,User $user)
    {
        if (!Auth::guard('api')->user()) {
            return Response::json([
                'error' => true,
                'error_msg' => 'Debes de iniciar sesion para realizar esta opcion.',
                'type' => 'sessionError'
            ],401);
        }else{
            $periodo = array();
            $etapas = array();
            $gantt = '';
            $grupo = Auth::guard('api')->user()->persona->estudiante->estudiante_grupo->grupo;

            if ($grupo->periodo) {
                array_push($periodo, array('name' => 'Periodo de Trabajo de graduaciòn','fromDate'=> $grupo->periodo->fInicio, 'toDate'=> $grupo->periodo->fFin));
                $temp = $grupo->periodo->fInicio;
                foreach ($grupo->periodo->fechas as $etapa) { 
                    array_push($etapas, array('name' => $etapa->etapa->idnombreetapa,'startTime'=> $temp, 'endTime'=> $etapa->fechasetapas, 'order'=> $etapa->etapa->idetapa));
                    $temp = $etapa->fechasetapas;
                }
            }
            return response()->json([
                'error' => false,
                'period' => $periodo,
                'stages' => $etapas
            ]);
        }
    }

    public function get_user_details(Request $request)
    {
        if (!Auth::guard('api')->user()) {
            return Response::json([
                'error' => true,
                'error_msg' => 'Debes de iniciar sesion para realizar esta opcion.',
                'type' => 'sessionError'
            ],401);
        }
        if (!$request->get('api_token')) {
            return Response::json([
                'error' => true,
                'error_msg' => 'Debes de iniciar sesion para realizar esta opcion.',
                'type' => 'sessionError'
            ],401);
        } else {
            $user = Auth::guard('api')->user();
            return  Response::json([
                'error' => false,
                'username' => $user->name,
                'email' => $user->email,
                'api_token' => $user->api_token,
                'name' => $user->persona->nombres,
                'lastname' => $user->persona->apellidos,
                'address' => $user->persona->direccion,
                'sex' => $user->persona->sexo,
                'birthday' => $user->persona->fechanac,
                'dui' => $user->persona->dui,
                'phone' => $user->persona->telefono,
                'year' => \Carbon\Carbon::parse($user->persona->estudiante->anioegreso)->year,
                'carnet' => $user->persona->estudiante->carnet,
                'pera' => intval($user->persona->estudiante->pera),
                'socialsHours' => intval($user->persona->estudiante->horassoc),
                'careerName' => ($user->persona->estudiante)?$user->persona->estudiante->carrera->nombre:'',
                'careerCode' => ($user->persona->estudiante)?$user->persona->estudiante->carrera->codigo:'',
                'departmentName'=>$user->persona->estudiante->carrera->departamento->nombre,
                'departmentCode'=>$user->persona->estudiante->carrera->departamento->codigo,
                'photo' => $user->persona->foto_url
            ],200);
        }
        
    }

    public function image()
    {
        if (!Auth::guard('api')->user()) {
            return Response::json([
                'error' => true,
                'error_msg' => 'Debes de iniciar sesion para realizar esta opcion.',
                'type' => 'sessionError'
            ],401);
        }else{
            $file = \Storage::disk('fotos')->get(Auth::guard('api')->user()->persona->foto_url);
            
            return Response($file);
        }
    }
    
}   
