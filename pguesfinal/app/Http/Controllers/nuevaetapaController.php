<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\TipoTema;
use sispg\nombreetapas;
use sispg\etapas;
use sispg\nuevaetapa;
use sispg\Carrera;
use sispg\Ponderacion;
use Illuminate\Support\Facades\Redirect;
use sispg\Http\Requests\nuevaetapaFormRequest;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;

class nuevaetapaController extends Controller
{
    //

    public function __construct(){


    }

     public function index(){

        $tipotrabajo = DB::table('tipotemas')
        ->join('carreras','carreras.idcarrera','=','tipotemas.idcarrera')
        ->select('tipotemas.idtipotema','tipotemas.condicion', DB::raw("concat(tipotemas.tema,' - ',carreras.nombre) as tema_carrera"))
        ->where('tipotemas.condicion',1)
        ->where('carreras.condicion',1)
            ->get();

        $etapas = nuevaetapa::join('tipotemas','nuevaetapa.idtipotrabajo','=','tipotemas.idtipotema')
        ->join('carreras','tipotemas.idcarrera','=','carreras.idcarrera')
    		->select('tipotemas.tema','nuevaetapa.idnombreetapa','nuevaetapa.idnuevaetapa','carreras.nombre','carreras.idcarrera','nuevaetapa.idetapa','nuevaetapa.condicion','nuevaetapa.idtipotrabajo')
            ->where('tipotemas.condicion',1)
        ->where('carreras.condicion',1)
            ->get();
            
            return view('ues.nuevaetapa.index')
            ->with('tipotrabajo',$tipotrabajo)
            ->with('etapas',$etapas)
            ->with('carreras',Carrera::all());


    }

    public function create(){


    	return  view("ues.nuevaetapa.create");

     }

      public function store(nuevaetapaFormRequest $request){
        //dd($request);

    	$nuevaetapa=new nuevaetapa;

    	$nuevaetapa->idtipotrabajo=$request->get('idtipotrabajo');
    	$nuevaetapa->idetapa=$request->get('idetapa');
    	$nuevaetapa->idnombreetapa=$request->get('idnombreetapa');
    	$nuevaetapa->condicion=1;
    	$nuevaetapa->save();
        Ponderacion::create(['idetapa'=>$nuevaetapa->idnuevaetapa,'porcentaje'=>0]);
            $notificacion = array(
            'message' => 'El nombre de etapa se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

    public function show($id){
        return response()->json([
            'etapa' => nuevaetapa::findOrFail($id)
        ]);
    }

    public function edit($id){
        return response()->json([
            'etapa' => nuevaetapa::findOrFail($id)
        ]);
    }

     public function update(Request $request, $id){
        //dd($request, $id);
    	$nuevaetapa=nuevaetapa::findOrFail($id);
       $nuevaetapa->idtipotrabajo=$request->get('id_tipotrabajo');
    	$nuevaetapa->idetapa=$request->get('id_etapa');
    	$nuevaetapa->idnombreetapa=$request->get('nombreetapa');
    	$nuevaetapa->condicion=1;

    	$nuevaetapa->update();

         $notificacion = array(
            'message' => 'El nombre etapa se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/nuevaetapa')->with($notificacion);
    }

    public function destroy($id){

    	$nuevaetapa=nuevaetapa::findOrFail($id);
        if ($nuevaetapa->condicion==false) {
            $nuevaetapa->condicion=true;

  $notificacion = array(
            'message' => 'El nombreetapa se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $nuevaetapa->condicion=false;
              $notificacion = array(
            'message' => 'El nombreetapa se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$nuevaetapa->update();
       
    	return Redirect::to('ues/nuevaetapa')->with($notificacion);;

    }

    public function getCountEtapas($idtipotrabajo)
    {
        $etapa_num = nuevaetapa::where('idtipotrabajo','=',$idtipotrabajo)->count() + 1;
        return response()->json([
            'num_etapa' => $etapa_num
        ]);
    }

    public function getEtapas($idtipotrabajo)
    {
        $etapa_num = nuevaetapa::join('tipotemas', 'tipotemas.idtipotema' ,'=', 'nuevaetapa.idtipotrabajo')
        ->join('ponderacion', 'ponderacion.idetapa' ,'=',  'nuevaetapa.idnuevaetapa')
        ->select('nuevaetapa.idnuevaetapa','nuevaetapa.idetapa','nuevaetapa.idnombreetapa', 'ponderacion.porcentaje','ponderacion.idponderacion','nuevaetapa.idnuevaetapa')
        ->where([['nuevaetapa.idtipotrabajo','=',$idtipotrabajo],['nuevaetapa.condicion','=',true]])->get();
        return response()->json([
            'etapas' => $etapa_num
        ]);
    }

}
