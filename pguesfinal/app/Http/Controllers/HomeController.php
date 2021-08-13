<?php

namespace sispg\Http\Controllers;

use sispg\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use sispg\Persona;
use sispg\Rol;
use sispg\Grupo;
use  sispg\Periodo;
use sispg\Utils\UtilFunctions;
use Dark\Dummy\Gantt\Gantt;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        UtilFunctions::authorizeRoles(['ESTUDIANTE','ADMINISTRADOR','JEFE DE DEPARTAMENTO',
            'COORDINADOR GENERAL','ASESOR','DIRECTOR GENERAL']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $gsol = \sispg\grupo_solicitud::find(190);

         //dd($gsol->grupo, $gsol->grupo->year_registry);
         //dd(UtilFunctions::getUserNotify('COORDINADOR GENERAL',8));
        //$array = array_unique($array);
        //dd(Auth::user()->persona);

        // $grupo = Grupo::findOrFail(18);
        // $fechas = array();
        // array_push($fechas, array('label' => 'Periodo de Trabajo de graduaciòn','start'=> $grupo->periodo->fInicio, 'end'=> $grupo->periodo->fFin));
        // $temp = $grupo->periodo->fInicio;
        // foreach ($grupo->periodo->fechas->sortBy('fechasetapas') as $etapa) {
        //     array_push($fechas, array('label' => $etapa->etapa->idnombreetapa,'start'=> $temp, 'end'=> $etapa->fechasetapas));
        //     $temp = $etapa->fechasetapas;
        // }
        //dd($fechas,$grupo->periodo->fechas);
        //$gantt = new Gantt($fechas);
        // $periodos = Periodo::where('fFin','=',Carbon::now()->addMonth()->toDateString())->get();
        // dd($periodos, Carbon::now()->addMonth()->toDateString());
        //UtilFunctions::sendNotificationCalidadEgresado();
        //dd(Carbon::now()->addWeek()->toDateString());
        $personas=Persona::all();
        return view('plantillas.admin',["personas"=>$personas]);

    }
}
