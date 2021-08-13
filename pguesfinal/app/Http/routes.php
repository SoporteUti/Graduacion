<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth(); 


Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {
Route::get('/home', 'HomeController@index');
Route::post('users/set/access', 'UsuarioController@setAccess')->name('usuario.set_access');

Route::get('ues/grupos/notasG/{id}', 'GrupoController@notasTot')->name('ues.grupos.notasG');
	//Rutas de Facultades
	Route::resource('ues/facultades','FacultadController');
	Route::post('/usuValid','FacultadController@postUserValid');
	Route::post('/telefonoValid','FacultadController@postTelefonoValid');

	//Rutas de departamento
	Route::resource('ues/departamentos','departamentosController');
	Route::post('/codigoDeptoValid','departamentosController@postCodigoDeptoValid');

	//Rutas de Carrera
	Route::resource('ues/carreras','CarreraController');
	Route::post('/codigoCarreraValid','CarreraController@postCodigoCaValid');
	Route::post('/nombreCarreraValid','CarreraController@postNombreCaValid');

	//Rutas de docente
	Route::resource('ues/docentes','docentesController');
	Route::post('/telefonoDocValid','docentesController@postTelefonoDocValid');
	Route::post('/correoDocValid','docentesController@postCorreoDocValid');
	Route::post('/duiDocValid','docentesController@postDuiDocValid');

	//Rutas de Estudiante
	Route::resource('ues/estudiantes','EstudianteController');
	Route::post('/telefonoEstValid','EstudianteController@postTelefonoEstValid');
	Route::post('/correoEstValid','EstudianteController@postCorreoEstValid');
	Route::post('/duiEstValid','EstudianteController@postDuiEstValid');
	Route::post('/carnetEstValid','EstudianteController@postCarnetEstValid');

	Route::post('grupos/pdfestadistico', 'GrupoController@pdfEstadisticos')->name('ues.grupos.pdfestadistico');
	Route::post('grupos/pdfestudiantes', 'EstudianteController@pdfEstudiantes')->name('ues.estudiantes.pdfestudiantes');
	
	Route::get('grupos/filtros/departamentos/carreras/{departamento}','GrupoController@get_carreras_departamentos')->name('get_carreras_departamentos');
	Route::get('grupos/filtros/carreras/years/trabajos/{carrera}','GrupoController@get_years_trabajos')->name('get_years_trabajos');

	Route::resource('ues/tipoTemas','TipotemaController');
	Route::resource('ues/tipoAsesores','TipoasesorController');
	Route::resource('ues/estudiantesPera','EstudiantePeraController');
	Route::resource('ues/estudiantesHS','EstudianteHSController');
	Route::resource('ues/categorias','categoriasController');
	Route::resource('ues/etapas','etapasnombreController');
	Route::resource('ues/nombreetapas','nombreetapasController');
	Route::resource('ues/nuevaetapa','nuevaetapaController');
	Route::resource('ues/ponderacion','PonderacionController');
	Route::resource('ues/actividades','ActividadController');
	Route::resource('ues/solis','solisController');

	//rutas de grupos
	Route::resource('ues/grupos','GrupoController');
	Route::resource('ues/gruposoff','gruposoffController');
	Route::post('/codigoGrupoValid','GrupoController@postCodigoGrupoValid');
	Route::post('/temaValid','GrupoController@postTemaValid');

	Route::get('ues/grupos/steps/{id}' , 'GrupoController@llenargrupos')->name('ues.grupos.steps');
	Route::get('ues/grupos/stepsAsesoria/{id}', 'GrupoController@llenargruposAsesoria')->name('ues.grupos.stepsAsesoria');

	////modificar notas
	Route::post('ues/getnotas/grupos/','GrupoController@getnotas')->name('ues.getnotas');

	Route::post('ues/grupos/editarnotas', 'GrupoController@editarnotas')->name('ues.grupos.editarnotas');



//vista asesor
	Route::get('ues/grupos/vista_asesor/{id}', 'GrupoController@llenargruposasesor')->name('ues.grupos.vista_asesor');

//vista ESTUDIANTES
	Route::get('ues/grupos/vista_estudiante/{id}', 'GrupoController@llenargruposasesor')->name('ues.grupos.vista_asesor');

	//esta es la mera mera vista estudiantes
	Route::get('ues/grupos/vista_estudiante/{id}', 'GrupoController@llenargrupoestudiante')->name('ues.grupos.vista_estudiante');

//vista asesor
	Route::get('ues/grupos/control_asesoria/{id}', 'GrupoController@llenargruposasesoria')->name('ues.asesoria.control_asesoria');

	Route::resource('ues/usuarios','UsuarioController');

	//Route::put('ues/usuarios')

	Route::resource('ues/solicitudes','solicitudController');
	Route::resource('ues/solicitudesconta','solicitudpicController');

	Route::resource('ues/solicitudesSys','SolicitudSysController');


	//cambio tema
	Route::post('ues/solicitudesconta/spiconta', 'solicitudpicController@spiconta')->name('ues.solicitudesconta.spiconta');

	Route::post('ues/solicitudesconta/prorrogaiCoordinador', 'solicitudpicController@spicontaCoordinador')->name('ues.solicitudesconta.spicontaCoordinador');

	Route::post('ues/solicitudesconta/spicontaDirector', 'solicitudpicController@spicontaDirector')->name('ues.solicitudesconta.spicontaDirector');
	
	Route::post('ues/solicitudesconta/spicontaAsesor', 'solicitudpicController@spicontaAsesor')->name('ues.solicitudesconta.spicontaAsesor');

//cancelar solicitudes
	Route::post('ues/solicitudes/cancelar', 'solicitudController@cancelar')->name('ues.solicitudes.cancelar');

	//Aprobacion de tema
	Route::post('ues/solicitudes/aprovaciont', 'solicitudController@aprovaciont')->name('ues.solicitudes.aprovaciont');
	Route::post('ues/solicitudes/imprimiraprovaciontd', 'solicitudController@imprimiraprovaciontd')->name('ues.solicitudes.imprimiraprovaciontd');

	//02022020
	Route::post('ues/solicitudes/eliminars', 'solicitudController@eliminars')->name('ues.solicitudes.eliminars');

	Route::post('ues/solicitudes/imprimiraprovaciont', 'solicitudController@imprimiraprovaciont')->name('ues.solicitudes.imprimiraprovaciont');
	Route::post('ues/solicitudes/registrardocenviados', 'solicitudController@registrardocenviados')->name('ues.solicitudes.registrardocenviados');

	// ratificacion de tribunal
	Route::post('ues/solicitudesconta/RatificaciondeTribunal', 'solicitudpicController@sRatificaciondeTribunal')->name('ues.solicitudesconta.sRatificaciondeTribunal');
	Route::post('ues/solicitudesconta/tribunalCoordinador', 'solicitudpicController@sRatificaciondeTribunalCoordinador')->name('ues.solicitudesconta.sRatificaciondeTribunalCoordinador');
	Route::post('ues/solicitudesconta/tribunalDirector', 'solicitudpicController@sRatificaciondeTribunalDirector')->name('ues.solicitudesconta.sRatificaciondeTribunalDirector');
	Route::post('ues/solicitudesconta/tribunalAsesor', 'solicitudpicController@sRatificaciondeTribunalAsesor')->name('ues.solicitudesconta.sRatificaciondeTribunalAsesor');

	Route::post('ues/solicitudes/ratificacionResul', 'solicitudController@ratiResul')->name('ues.solicitudes.ratiResul');

	////impugnación de resultados

	Route::post('ues/solicitudes/impugnacionResultados', 'solicitudController@impugnacionResultados')->name('ues.solicitudes.impugnacionResultados');


	//reprobacion por abandono
	Route::post('ues/solicitudes/repabandono', 'solicitudController@repabandono')->name('ues.solicitudes.repabandono');

	Route::post('ues/solicitudes/reprobacionxabandono', 'solicitudController@imprepabandonoCoordinador')->name('ues.solicitudes.imprepabandonoCoordinador');
	Route::post('ues/solicitudes/reproDirector', 'solicitudController@imprepabandonoDirector')->name('ues.solicitudes.imprepabandonoDirector');





	Route::post('ues/impsolicitudesA', 'solicitudController@impspsistemasA')->name('ues.solicitudes.impspsistemasA');
	Route::post('ues/impsolicitudesC', 'solicitudController@impspsistemasC')->name('ues.solicitudes.impspsistemasC'); 
	Route::post('ues/impsolicitudesD', 'solicitudController@impspsistemasD')->name('ues.solicitudes.impspsistemasD');
	

	//ratificacion de resultados
	Route::post('ues/solicitudes/ratificacionResul', 'solicitudController@ratiResul')->name('ues.solicitudes.ratiResul');
	Route::post('ues/solicitudes/impratificacionResulC', 'solicitudController@impratiResulC')->name('ues.solicitudes.impratiResulC');
	Route::post('ues/solicitudes/impratificacionResulD', 'solicitudController@impratiResulD')->name('ues.solicitudes.impratiResulD');


Route::post('ues/solicitudes/registrarcoor', 'solicitudController@registrarcoor')->name('ues.solicitudes.registrarcoor');
Route::post('ues/solicitudes/registrarase', 'solicitudController@registrarase')->name('ues.solicitudes.registrarase');


	Route::post('ues/solicitudes', 'solicitudController@spsistemas')->name('ues.solicitudes.spsistemas');
	Route::post('ues/solicitudesconta', 'solicitudpicController@spiconta')->name('ues.solicitudesconta.spiconta');
	Route::post('ues/emails/', 'EstudianteController@store')->name('ues.emails.confirmation_code');

	Route::post('ues/usuarios/user', 'UsuarioController@user')->name('ues.usuarios.user');
	Route::post('ues/usuarios/storerca', 'UsuarioController@storerca')->name('ues.usuarios.storerca');



	Route::post('ues/nuevaetapa/getnum/{idtipotrabajo}', 'nuevaetapaController@getCountEtapas')->name('ues.nuevaetapa.numetapas');
	Route::post('ues/nuevaetapa/getetapas/{idtipotrabajo}', 'nuevaetapaController@getEtapas')->name('ues.nuevaetapa.getetapas');
	Route::post('ues/usuario/roles/{iddocente}', 'UsuarioController@getDocenteRoles')->name('ues.usuario.getdocenteroles');
	Route::delete('ues/usuario/deleterol/{idrol}', 'UsuarioController@deleteRol')->name('ues.usuario.deleterol');
	Route::post('ues/usuario/addrol/', 'UsuarioController@addrols')->name('ues.usuario.addrols');
	Route::post('ues/usuario/removerol/', 'UsuarioController@removeRol')->name('ues.usuario.removerol');
	Route::post('ues/usuarios/loadData/{iddocente}','UsuarioController@listRols')->name('ues.usuarios.loaddata');
	Route::post('ues/reload/roles/{idcarrera}','UsuarioController@reloadRoles')->name('ues.reloadroles');


//Bitacora

	Route::get('ues/seguridad/bitacora','BitacoraController@getBitacora');
	//Route::get('/seguridad/bitacRep/{id}','BitacoraController@getBitacoraUser');
	Route::get('/bitacRep/{id}','BitacoraController@getBitacoraUser');

	Route::get('/bitacRepImp/{id}','BitacoraController@getBitacoraUserImp');


	Route::get('ues/grupos/vista_director/{id}', 'GrupoController@llenargruposdirector')->name('ues.grupos.vista_director');

	Route::post('ues/solicitudes/solicitudesemitidas/{idgrupo}', 'solicitudController@getsolicitudes')->name('ues.solicitudes.getsolicitudes');
	//	RUTAS NOTIFICACIONES
	Route::get('users/notifications', 'NotificationController@notifications');
	Route::get('users/notifications/read/{id}', 'NotificationController@mark_as_read');

	
Route::get('grupos/integrantes/{id}', 'EstudianteController@getAlumns')->name('grupo.integrantes');

Route::post('grupos/asistencia/{idgrupo}', 'GrupoController@asistencia')->name('ues.grupos.asistencia');







		Route::get('ues/backups', 'BackupController@index');
        Route::get('backup/create', 'BackupController@create');
        Route::get('backup/download/{file_name}', 'BackupController@download');
        Route::get('backup/delete/{file_name}', 'BackupController@delete');
        Route::post('ues/backup/deleteDB', 'BackupController@deleteDB')->name('ues.backups.deleteDB');



        ///////////////////// reg doc modificar tema
Route::post('ues/solicitudes/registrardoctemamod', 'solicitudpicController@registrardocmodtema')->name('ues.solicitudes.registrardocmodtema');
//////////// reg doc aprobar tema
Route::post('ues/solicitudes/registrardocenviadosCO', 'solicitudController@registrardocenviadosCO')->name('ues.solicitudes.registrardocenviadosCO');
/////// reg doc tribunal
Route::post('ues/solicitudes/registrardoctribunal', 'solicitudpicController@registrardoctribcal')->name('ues.solicitudes.registrardoctribcal');
////////// reg doc prorrpga interna
Route::post('ues/solicitudes/registrardocpinterna', 'solicitudController@registrardocpintGrerna')->name('ues.solicitudes.registrardocpinterna');
//////////  reg doc ratif resultados
Route::post('ues/solicitudes/registrardocratresula', 'solicitudController@registrardocratiresul')->name('ues.solicitudes.registrardocratiresul');
Route::post('ues/solicitudes/registrarimp', 'solicitudController@registrardocratiresulimp')->name('ues.solicitudes.registrarimp');


Route::post('ues/grupos/gnotas', 'GrupoController@gnotas')->name('ues.grupos.gnotas');

//steps datos del estudiante.
Route::get('ues/estudiantes/stepsEst/{id}', 'EstudianteController@llenarEstudiantes')->name('ues.estudiantes.stepsEst');

Route::get('ues/estudiantes/stepsEstUpdate/{id}', 'EstudianteController@updateEstudiantes')->name('ues.estudiantes.stepsEstUpdate');

Route::post('ues/estudiantes/stepsEstUpdate/{id}', 'EstudianteController@actDatosEstudiante')->name('ues.estudiantes.stepsEstUpdate');

//lista de estudiantes
Route::get('/listaEst', 'EstudianteController@pdflistaEstudiantes');
Route::get('/listaEstI', 'EstudianteController@pdflistaEstudiantesI');
// perfil estudiantes pdf
Route::get('ues/estudiantes/perfilEst/{id}', 'EstudianteController@pdfPerfilEst')->name('ues.estudiantes.perfilEst');
//estudiantes en PERA
Route::get('/listaEstPera', 'EstudiantePeraController@pdflistaEstudiantesPera');
//estudiantes en HORAS SOCIALES
Route::get('/listaEstHS', 'EstudianteHSController@pdflistaEstudiantesHS');
//pdf docentes 
Route::get('/listaDoc', 'docentesController@pdflistaDocentes');
Route::get('/listaDocI', 'docentesController@pdflistaDocentesI');
// perfil docente pdf
Route::get('ues/docentes/perfilDoc/{id}', 'docentesController@pdfPerfilDoc')->name('ues.docentes.perfilDoc');

//pdf facultades
Route::get('/listaFac', 'FacultadController@pdflistaFacultades');
Route::get('/listaFacI', 'FacultadController@pdflistaFacultadesI');

//pdf departamentos
Route::get('/listaDepto', 'departamentosController@pdflistaDepartamentos');
Route::get('/listaDeptoI', 'departamentosController@pdflistaDepartamentosI');
//pdf Carreras
Route::get('/listaCar', 'CarreraController@pdflistaCarreras');
Route::get('/listaCarI', 'CarreraController@pdflistaCarrerasI');
//pdf usuarios
Route::post('/listaUser', 'UsuarioController@pdflistaUser')->name('ues.usuarios.listauser');
// pdf perfil usuario
Route::get('ues/usuarios/perfilUser/{id}', 'UsuarioController@pdfPerfilUser')->name('ues.usuarios.perfilUser');
//pdf grupos
Route::get('/listaGrup', 'GrupoController@pdflistaGrup');
Route::get('/listaGrupI', 'GrupoController@pdflistaGrupI');
//pdf perfil grupo
Route::get('ues/grupos/steps/perfilGrup/{id}', 'GrupoController@pdfPerfilGrup')->name('ues.grupos.steps.perfilGrup');
///pdfestadisctico
	Route::post('grupos/pdfestadistico', 'GrupoController@pdfEstadisticos')->name('ues.grupos.pdfestadistico');

////reporte de notas
///imprimir notas
Route::post('ues/grupos/impNotas', 'GrupoController@pdfNotas')->name('ues.grupos.impNotas');

//prororogajd
Route::post('ues/solicitudes/prorrogajd', 'solicitudController@prorrogajd')->name('ues.solicitudes.prorrogajd');

Route::post('ues/solicitudes/imprimir3asesor', 'solicitudController@imprimir3asesor')->name('ues.solicitudes.imprimir3asesor');
Route::post('ues/solicitudes/imprimir3coordinador', 'solicitudController@imprimir3coordinador')->name('ues.solicitudes.imprimir3coordinador');
Route::post('ues/solicitudes/imprimir3director', 'solicitudController@imprimir3director')->name('ues.solicitudes.imprimir3director');

Route::post('ues/solicitudes/registrarprorrogajd', 'solicitudController@registrarprorrogajd')->name('ues.solicitudes.registrarprorrogajd');


////notificacion inasistencia
Route::post('ues/solicitudes/imprimir7asesor', 'solicitudController@imprimir7asesor')->name('ues.solicitudes.imprimir7asesor');

///////////////////enviado por ovidio 28_03_19
	Route::post('ues/solicitudes/imprimir7coordinador', 'solicitudController@imprimir7coordinador')->name('ues.solicitudes.imprimir7coordinador');


/////////////enviado por ovidio 29_03_19
Route::post('ues/solicitudes/registrar7director', 'solicitudController@registrar7director')->name('ues.solicitudes.registrar7director');
Route::post('ues/solicitudes/registrar8director', 'solicitudController@registrar8director')->name('ues.solicitudes.registrar8director');
Route::post('ues/solicitudes/registrar9director', 'solicitudController@registrar9director')->name('ues.solicitudes.registrar9director');
//renuncia al proceso de graduacion 

Route::post('ues/solicitudes/renuncia', 'solicitudController@renuncia')->name('ues.solicitudes.renuncia');
Route::post('ues/solicitudes/imprimir9coordinador', 'solicitudController@imprimir9coordinador')->name('ues.solicitudes.imprimir9coordinador');
Route::post('ues/solicitudes/imprimir9director', 'solicitudController@imprimir9director')->name('ues.solicitudes.imprimir9director');

Route::post('ues/solicitudes/imprimir10coordinador', 'solicitudController@imprimir10coordinador')->name('ues.solicitudes.imprimir10coordinador');
Route::post('ues/solicitudes/imprimir10director', 'solicitudController@imprimir10director')->name('ues.solicitudes.imprimir10director');
Route::post('ues/solicitudes/registrar10director', 'solicitudController@registrar10director')->name('ues.solicitudes.registrar10director');





});


Route::post('fill/','SelectFillController@fill')->name('fill');
Route::post('fillroles/','SelectFillController@fillroles')->name('fillroles');
/*Route::auth();

Route::get('/home', 'HomeController@index');
*/
Route::post('grupos/cronograma/{idgrupo}', 'GrupoController@periodos_fechas')->name('ues.grupos.cronograma');
//Route::post('grupos/cronograma/{idperiodo}', 'GrupoController@periodos_fechasup')->name('ues.grupos.cronogramaup');



Route::group(['middleware' => ['cors'],'prefix' => 'api/v1'], function () {
	Route::get('login', 'ApiController@login');
    // Route::get('login', 'ApiController@login');
    Route::group(['middleware' => ['api']], function() {
    	Route::get('get_user_details', 'ApiController@get_user_details');
    	Route::get('update_user_details', 'ApiController@update');
    	Route::get('get_dates', 'ApiController@getDates');
    	Route::get('photo', 'ApiController@image');
    });
});


Route::get('getapp','ApiController@getapp')->name('getapp');

