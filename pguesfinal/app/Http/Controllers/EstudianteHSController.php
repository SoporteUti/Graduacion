<?php

namespace sispg\Http\Controllers;



use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\Estudiante;
use Illuminate\Support\Facades\Redirect;
use sispg\Http\Requests\EstudianteFormRequest;
use DB;
use Validator;
use Exception;
use sispg\Carrera;
use sispg\Persona;
use Response;
use sispg\User;

use sispg\Facultad;
use sispg\Departamento;

class EstudianteHSController extends Controller
{
    public function __construct(){


    }

    
   
    public function index(Request $request ){
$carreras=Carrera::all();
$persona=Persona::all();
            $estudiante=Estudiante::all();
        return view('ues.estudiantesHS.index',["estudiante"=>$estudiante, "persona"=>$persona], compact('carreras'));
    }

    public function show($id){

        return view("ues.estudiantesHS.show", ["estudiante"=>estudiante::findOrFail($id)]);
    }


public function pdflistaEstudiantesHS(){
 // $persona=Persona::findOrFail($id); 
     $persona=Persona::all();
        $carreras=Carrera::all();
        $estudiantes=Estudiante::all();
        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all();
        
      $pdf=\PDF::loadview('ues.estudiantesHS.listaEstHS',  array('carreras'=>$carreras,'persona'=>$persona,'user'=>$user,'estudiantes'=>$estudiantes,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Estudiantes_HS.pdf');

}

}

