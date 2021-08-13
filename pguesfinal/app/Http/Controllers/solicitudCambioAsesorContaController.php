<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sispg\Http\Requests\solicitudpicRequest;
use DB;
use sispg\Carrera;
use sispg\Departamento;
use sispg\Docente;
use sispg\Estudiante;
use sispg\EstudianteGrupos;
use sispg\nuevaetapa;
use sispg\Facultad;
use sispg\Grupo;
use sispg\GrupoDocente;
use sispg\TipoTema;
use sispg\TipoAsesor;

class solicitudCambioAsesorContaController extends Controller
{
     public function __construc(){

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
    public function spiconta(){
    	$query=Input::get('codigo');
    	$motivo=Input::get('motivo');
    	
$fi = date("d/m/Y", strtotime(Input::get('fechai')));
$ff = date("d/m/Y", strtotime(Input::get('fechaf')));
    	$estudianteg=EstudianteGrupos::all();
    	$estudiante=Estudiante::all();
    	$tipotema=TipoTema::all();
	$grupo=Grupo::all();
	$pdf=\PDF::loadview('ues.solicitudesconta.prorrogai',["codigo"=>$query,"fechai"=>$fi,"fechaf"=>$ff,"motivo"=>$motivo],compact('grupo','estudianteg','estudiante','tipotema'));
    		return $pdf->download('solicitud.pdf');
    	
    }
}
