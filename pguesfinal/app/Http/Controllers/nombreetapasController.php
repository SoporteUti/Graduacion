<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\TipoTema;
use sispg\nombreetapas;
use Illuminate\Support\Facades\Redirect;
use sispg\Http\Requests\nombreetapasFormRequest;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class nombreetapasController extends Controller
{
    public function __construct(){


    }

     public function index(){


     	$tipotrabajo=TipoTema::all();
    		$nombreetapa=DB::table('nombreetapas')
    		->orderBy('idnombreetapa','desc')
    		->paginate(60);
            return view('ues.nombreetapas.index',["nombreetapa"=>$nombreetapa], compact('tipotrabajo'));
    }

    public function create(){


    	return  view("ues.nombreetapas.create");

     }

      public function store(nombreetapasFormRequest $request){


    	$nombreetapa=new nombreetapas;

    	$nombreetapa->nombreetapa=$request->get('nombreetapa');
    	$nombreetapa->idtipotrabajo=$request->get('idtipotrabajo');
    	$nombreetapa->condicion=1;
    	$nombreetapa->save();
            $notificacion = array(
            'message' => 'El nombre de etapa se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

    public function show($id){

    	return view("ues.nombreetapas.show",["nombreetapa"=>nombreetapa::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.nombreetapas.edit",["nombreetapa"=>nombreetapa::findOrFail($id)]);

    }

     public function update(nombreetapasFormRequest $request, $id){

    	$nombreetapa=nombreetapa::findOrFail($id);
       $nombreetapa->nombreetapa=$request->get('nombreetapa');
    	$nombreetapa->idtipotrabajo=$request->get('idtipotrabajo');
    	$nombreetapa->condicion=1;

    	$nombreetapa->update();

         $notificacion = array(
            'message' => 'El nombre etapa se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/nombreetapas')->with($notificacion);
    }

    public function destroy($id){

    	$nombreetapa=nombreetapa::findOrFail($id);
        if ($nombreetapa->condicion==false) {
            $nombreetapa->condicion=true;

  $notificacion = array(
            'message' => 'El nombreetapa se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $nombreetapa->condicion=false;
              $notificacion = array(
            'message' => 'El nombreetapa se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$nombreetapa->update();
       
    	return Redirect::to('ues/nombreetapas')->with($notificacion);;

    }


}
