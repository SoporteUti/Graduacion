<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;

use sispg\Persona;
use sispg\User;
use sispg\Carrera;
use sispg\Rol;
use sispg\Rol_carrera;
use sispg\Grupo;
use DB;
use Auth;

class SelectFillController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function fill(Request $request)
    {
        $carreras = collect();
        $roles = collect();

        // return response()->json([
        //     'user' => Auth::user()
        // ]);
        
        try {
            $persona =null;
            // $persona = Persona::join('users','users.idpersona','=','personas.idpersona')->select('personas.*')->where('users.email',$request->email)->get()->first();
            $user = User::where('email','=',$request->email)->get()->first();
            if(!$user){
                return response()->json([
                    'carreras' => json_encode($carreras),
                    'roles' => json_encode($roles)
                ]);
            }
            switch ($user->persona->tipo) {
                case 'estudiante':
                $carreras = Carrera::where('idcarrera',$user->persona->estudiante->idcarrera)->get();
                $roles=Rol::where('nombre','ESTUDIANTE')->get();
                break;
                case 'docente':
                // $carreras = Rol_carrera::join('carreras','rol_carreras.idcarrera','=','carreras.idcarrera')
                // ->join('docentes','rol_carreras.iddocente','=','docentes.iddocente')
                // ->select('carreras.nombre','carreras.idcarrera')
                // ->where('docentes.iddocente',$user->persona->docente->iddocente)
                // ->get()->unique('idcarrera');
                $tmp = collect();
                foreach ($user->persona->docente->rolCarreras as $element) {
                        $tmp->push($element->carrera);
                }
                $tmp = $tmp->unique();
                foreach ($tmp as $element) {
                        $carreras->push($element);
                }
                $roles = Rol_carrera::join('roles','rol_carreras.idrol','=','roles.idrol')
                ->join('docentes','rol_carreras.iddocente','=','docentes.iddocente')
                ->select('roles.nombre','roles.idrol')
                ->where('docentes.iddocente',$user->persona->docente->iddocente)
                ->get()->unique('idrol');
                break;
                default:
                $carreras = '';
                $roles;
                break;
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'carreras' => $carreras,
            'roles' => $roles
        ]);
    }


    
    public function fillroles(Request $request)
    {
        $carreras = '';
        $roles = '';
        try {
            $persona = Persona::join('users','users.idpersona','=','personas.idpersona')->select('personas.*')->where('users.email',$request->email)->get()->first();
            switch ($persona->tipo) {
                case 'estudiante':
                $carreras = Carrera::where('idcarrera',$persona->estudiante->idcarrera)->get();
                $roles=Rol::where('nombre','ESTUDIANTE')->get();
                break;
                case 'docente':
                $carreras = Rol_carrera::join('carreras','rol_carreras.idcarrera','=','carreras.idcarrera')
                ->join('docentes','rol_carreras.iddocente','=','docentes.iddocente')
                ->select('carreras.nombre','carreras.idcarrera')
                ->where('docentes.iddocente',$persona->docente->iddocente)
                ->get()->unique('idcarrera');
                $roles = Rol_carrera::join('roles','rol_carreras.idrol','=','roles.idrol')
                ->join('docentes','rol_carreras.iddocente','=','docentes.iddocente')
                ->select('roles.nombre','roles.idrol')
                ->where('rol_carreras.iddocente',$persona->docente->iddocente)
                ->where('rol_carreras.idcarrera',$request->idcarrera)
                ->get()->unique('idrol');
                break;
                default:
                $carreras = '';
                $roles;
                break;
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'roles' => $roles
        ]);
    }

    
}
