<?php 

namespace sispg\Utils;


use Auth;
use DB;
use Carbon\Carbon;

use sispg\{
	Docente,
	Rol_carrera,
	Carrera,
	Rol,
	Grupo,
	Fecha,
	Periodo,
	Estudiante
};

use sispg\Notifications\{
	NotificacionCalidadEgresadoPorCaducar,
	NotificacionCalidadEgresadoPorCaducarDocente,
	NotificacionDefensa,
	NotificacionDefensaAlumno,
	NotificacionVencimientoPeriodoTesis,
	NotificacionVencimientoPeriodoTesisAlumno
};

class UtilFunctions
{
	const ASESOR 				= 0;	
	const COORDINADOR_GENERAL 	= 1;	
	const DIRECTOR_GENERAL 		= 2;	
	const ESTUDIANTE 			= 3;

	
	function __construct()
	{
		# code...
	}

	public static function authorizeRoles($roles)
	{
		if(Auth::user()){
		switch (Auth::user()->persona->tipo) {
			case 'docente':
			Auth::user()->persona->docente->authorizeRoles($roles);
				break;
			case 'estudiante':
				Auth::user()->persona->estudiante->authorizeRoles($roles);
				break;
			default:
				abort(401);
				break;
		}
}


	}

	public static function humanFilesize($size, $precision = 2) {
    $units = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $step = 1024;
    $i = 0;

    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    
    return round($size, $precision).$units[$i];
}


	public static function hasRole($rol)
	{
		switch (Auth::user()->persona->tipo) {
			case 'docente':
			Auth::user()->persona->docente->authorizeRoles($roles);
				break;
			case 'estudiante':
				Auth::user()->persona->estudiante->authorizeRoles($roles);
				break;
			default:
				abort(401);
				break;
		}
	}

	public static function getUserNotify($rol_name,$idgrupo)
	{
		$grupo = Grupo::find($idgrupo);
		if($rol_name === 'ASESOR'){
			return Docente::find($grupo->grupo_docente->iddocente)->persona->user;
		}elseif ($rol_name === 'ALUMNO') {
			return static::getUserAlumns($idgrupo);
		}else{
			return static::getUserByRolAndCarrera($rol_name,$grupo->carrera->nombre,$grupo->year_registry); 
		}
	}

	public static function getUserAlumns($idgrupo)
	{
		$grupo = Grupo::find($idgrupo);
		$users_alumns = [];
		foreach ($grupo->estudiantes_grupo as $alumno) {
			$users_alumns[] = $alumno->estudiante->persona->user;
		}
		return $users_alumns;
	}

	protected static function getUserByRolAndCarrera($rol_name,$carrera_name,$year)
	{
		$rol= Rol::where('nombre',$rol_name)->get()->first();
		$carrera = Carrera::where('nombre',$carrera_name)->get()->first();
		$rol_carrera= ($rol_name === 'DIRECTOR GENERAL')?  DB::table('rol_carreras')->where('idrol','=',$rol->idrol)->get():DB::table('rol_carreras')->where('idrol','=',$rol->idrol)->where('idcarrera','=',$carrera->idcarrera)->where('anio','=',$year)->get();
		$rol_carrera = array_values($rol_carrera)[0];
		return Docente::find($rol_carrera->iddocente)->persona->user;
	}

	protected static function sendNotificationIntegrantesGrupo($idgrupo, $type,$period = null){
		//$idgrupo = (is_array($obj)) ?$obj->grupo->idgrupo:$obj;
		foreach (static::getUserAlumns($idgrupo) as $integrante) {
			switch ($type) {
				// case '0':
				// 	$integrante->notify(new NotificacionCalidadEgresadoPorCaducar($integrante->persona->estudiante,self::ESTUDIANTE));
    //         		static::getUserNotify('COORDINADOR GENERAL',$periodo->grupo->idgrupo)->notify(new NotificacionCalidadEgresadoPorCaducarDocente($integrante->persona->estudiante,self::COORDINADOR_GENERAL));
				// 	break;
				case '1':
					$integrante->notify(new NotificacionDefensa($period,self::ESTUDIANTE));
					break;
				case '2':
					$integrante->notify(new NotificacionVencimientoPeriodoTesis($period,self::ESTUDIANTE));
					break;
			}
        }
	}

	//estudiantes y coordinador
	public static function sendNotificationCalidadEgresado()
	{
		$estudiantes = Estudiante::where('anioegreso','=',Carbon::now()->addMonth()->subYears(3)->toDateString())->get();
        foreach ($estudiantes as $estudiante) {
        	//dd($estudiante->alumno_asistencia->grupo_asistencia->grupo);
        	$estudiante->persona->user->notify(new NotificacionCalidadEgresadoPorCaducar($estudiante,self::ESTUDIANTE));
        	static::getUserNotify('COORDINADOR GENERAL',$estudiante->estudiante_grupo->idgrupo)->notify(new NotificacionCalidadEgresadoPorCaducar($estudiante,self::COORDINADOR_GENERAL));
        }
	}


	//estudiante coordinador y asesor
	public static function sendNotificationPeriodoTesis()
	{
		$periodos = Periodo::where('fFin','=',Carbon::now()->addMonth()->toDateString())->get();
		foreach ($periodos as $periodo) {
			static::getUserNotify('ASESOR',$periodo->grupo->idgrupo)->notify(new NotificacionVencimientoPeriodoTesis($periodo,UtilFunctions::ASESOR));
			static::getUserNotify('DIRECTOR GENERAL',$periodo->grupo->idgrupo)->notify(new NotificacionVencimientoPeriodoTesis($periodo,UtilFunctions::DIRECTOR_GENERAL));
			static::getUserNotify('COORDINADOR GENERAL',$periodo->grupo->idgrupo)->notify(new NotificacionVencimientoPeriodoTesis($periodo,UtilFunctions::COORDINADOR_GENERAL));
			static::sendNotificationIntegrantesGrupo($periodo->grupo->idgrupo,2,$periodo);
		}
	}

	//estudiante coordinador y asesor
	public static function sendTiempoDefensa()
	{
		$fechas = Fecha::where('fechasetapas','=',Carbon::now()->addWeek()->toDateString())->get();
		foreach ($fechas as $fecha) {
			static::getUserNotify('ASESOR',$fecha->periodo->grupo->idgrupo)->notify(new NotificacionDefensa($fecha,UtilFunctions::ASESOR));
			static::getUserNotify('DIRECTOR GENERAL',$fecha->periodo->grupo->idgrupo)->notify(new NotificacionDefensa($fecha,UtilFunctions::DIRECTOR_GENERAL));
			static::getUserNotify('COORDINADOR GENERAL',$fecha->periodo->grupo->idgrupo)->notify(new NotificacionDefensa($fecha,UtilFunctions::COORDINADOR_GENERAL));
			static::sendNotificationIntegrantesGrupo($fecha->periodo->grupo->idgrupo,1,$fecha);
		}
	}
}
