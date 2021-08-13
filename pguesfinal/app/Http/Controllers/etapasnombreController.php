<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\etapas;
use sispg\Carrera;
use sispg\etapasnombre;
use Illuminate\Support\Facades\Redirect;
use sispg\Http\Requests\etapasNombreFormRequest;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class etapasnombreController extends Controller
{
    public function __construct(){


    }

     public function index(){


     	$carreras=Carrera::all();
     	$etapas=etapas::all();
    		$etapasnombre=DB::table('etapasnombre')
    		->orderBy('idetapanombre','desc')
    		->paginate(60);
            return view('ues.etapas.index',["etapasnombre"=>$etapasnombre], compact('etapas','carreras'));
    }


    public function create(){


    	return  view("ues.etapas.create");

     }

      public function store(etapasNombreFormRequest $request){


    	$etapasnombre=new etapasnombre;

    	$etapasnombre->nombreetapa=$request->get('nombreetapa');
    	$etapasnombre->idetapa=$request->get('idetapa');
    	$etapasnombre->idcarrera=$request->get('idcarrera');
    	$etapasnombre->condicion=1;
    	$etapasnombre->save();
            $notificacion = array(
            'message' => 'La etapa registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

     public function show($id){

    	return view("ues.etapas.show",["etapasnombre"=>etapasnombre::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.etapas.edit",["etapasnombre"=>etapasnombre::findOrFail($id)]);

    }

    public function update(etapasNombreFormRequest $request, $id){

    	$etapasnombre=etapasnombre::findOrFail($id);
        $etapasnombre->nombreetapa=$request->get('nombreetapa');
    	$etapasnombre->idetapa=$request->get('idetapa');
    	$etapasnombre->idcarrera=$request->get('idcarrera');
    	$etapasnombre->condicion=1;

    	$etapasnombre->update();

         $notificacion = array(
            'message' => 'La etapa se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/etapas')->with($notificacion);
    

    }

    public function destroy($id){

    	$etapasnombre=etapasnombre::findOrFail($id);
        if ($etapasnombre->condicion==false) {
            $etapasnombre->condicion=true;

  $notificacion = array(
            'message' => 'La etapa se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $etapasnombre->condicion=false;
              $notificacion = array(
            'message' => 'La etapa se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$etapasnombre->update();
       
    	return Redirect::to('ues/etapas')->with($notificacion);;

    }




}
