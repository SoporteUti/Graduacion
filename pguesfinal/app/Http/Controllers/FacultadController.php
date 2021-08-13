<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade as PDF;
use sispg\Http\Requests;
use sispg\Facultad;
use sispg\Persona;
use sispg\Carrera;
use sispg\Docente;
use sispg\User; 
use sispg\Departamento;
use sispg\Bitacora;
use Dompdf\Dompdf;
use Auth;
use Illuminate\Support\Facades\Redirect;
use sispg\Http\Requests\FacultadFormRequest;
use DB;
use PDF;
use App;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use sispg\Utils\UtilFunctions;


class FacultadController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR']);
    }


    protected $rules =
    [
        'nombre' => 'required|min:2|max:32|regex:/^[a-z ,.\'-]+$/i',
       
    ];

    public function index(Request $request){

    	if($request){
    		
    		$facultades=DB::table('facultades')
    		//->where('condicion','=','1')
    		->orderBy('idfacultad','desc')
    		->paginate(60);
    		return view('ues.facultades.index',["facultades"=>$facultades]);
    	}
    }

    public function create(){

    	return  view("ues.facultades.create");
    }

    public function store(FacultadFormRequest $request){


    	$facultad=new Facultad;
      $date = new \DateTime();

        $facultad->codigo=$request->get('codigo');
    	$facultad->nombre=$request->get('nombre');
    	//$facultad->decano=$request->get('decano');
    	$facultad->telefono=$request->get('telefono');
    	$facultad->direccion=$request->get('direccion');
    	$facultad->condicion='1';
    	$facultad->save();
        $msjAdd="si";
        ////bitacora/////////
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Registró una nueva Facultad";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Código: ".$facultad->codigo." , "." Nombre: ".$facultad->nombre."  Telefóno: ".$facultad->telefono."     Direccion: ".$facultad->telefono;
        $bitacora->save();
        ////bitacora/////////
             $notificacion = array(
            'message' => 'La facultad se ha registrado con éxito.', 
            'alert-type' => 'info'
        );
            

       return redirect()->back()->with($notificacion);

    }

    public function show($id){

    	return view("ues.facultades.show",["facultad"=>Facultad::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.facultades.edit",["facultad"=>Facultad::findOrFail($id)]);

    }

    public function update(FacultadFormRequest $request, $id){

    	$facultad=Facultad::findOrFail($id);
      $date = new \DateTime();
        $facultad->codigo=$request->get('codigo');
    	$facultad->nombre=$request->get('nombre');
    	//$facultad->decano=$request->get('decano');
    	$facultad->telefono=$request->get('telefono');
    	$facultad->direccion=$request->get('direccion');
    	$facultad->update();

      ////bitacora/////////
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Editó una Facultad";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Código: ".$facultad->codigo." , "." Nombre: ".$facultad->nombre."  Telefóno: ".$facultad->telefono."     Direccion: ".$facultad->telefono;
        $bitacora->save();
        ////bitacora/////////

         $notificacion = array(
            'message' => 'La facultad se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/facultades')->with($notificacion);
    	//return Redirect::to('ues/facultades');

    }

    public function destroy($id){

    	$facultad=Facultad::findOrFail($id);
    	if ($facultad->condicion==false) {
            $facultad->condicion=true;

  $notificacion = array(
            'message' => 'La Facultad se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $facultad->condicion=false;
              $notificacion = array(
            'message' => 'La Facultad se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
        
        $facultad->update();

      
    	return Redirect::to('ues/facultades')->with($notificacion);;

    }

    /*--Valida Codigo facultad--*/
   public function postUserValid(Request $request)
   {

       $id=$request->input('id');
      
       if(isset($id)){
             $usuR=$request->input('codigo');
             $isAvailable=true;
             $resultado = Facultad::where('codigo','=',$usuR)->where('id','!=',$id)->count();
                if($resultado==1){
                     $isAvailable=false;
                 }
            echo json_encode(array(
            'valid' => $isAvailable,
       ));
     
       }
       else{
       $usuR=$request->input('codigo');
       $isAvailable=true;
       $resultado = Facultad::where('codigo','=',$usuR)->count();
       if($resultado==1){
       $isAvailable=false;
       }
       echo json_encode(array(
       'valid' => $isAvailable,
       ));

       }        
   }

    /*--Valida Telefono facultad--*/
   public function postTelefonoValid(Request $request)
   {

       $id=$request->input('id');
      
       if(isset($id)){
             $usuR=$request->input('telefono');
             $isAvailable=true;
             $resultado = Facultad::where('telefono','=',$usuR)->where('id','!=',$id)->count();
                if($resultado==1){
                     $isAvailable=false;
                 }
            echo json_encode(array(
            'valid' => $isAvailable,
       ));
     
       }
       else{
       $usuR=$request->input('telefono');
       $isAvailable=true;
       $resultado = Facultad::where('telefono','=',$usuR)->count();
       if($resultado==1){
       $isAvailable=false;
       }
       echo json_encode(array(
       'valid' => $isAvailable,
       ));

       }        
   }

/////PDF Lista de facultades
public function pdflistaFacultades(){

        $user=user::all();
        $facultades=Facultad::all();
        
 /*     return view("ues.facultades.listaFac",array('persona' =>$persona,'carreras' =>$carreras,'docentes' =>$docentes,'user'=>$user,'departamento'=>$departamento,'facultades'=>$facultades));*/

      $pdf=\PDF::loadview('ues.facultades.listaFac',  array('user' =>$user, 'facultades' => $facultades))->setPaper('letter','landscape');
      //$pdf->setOptions('isPhpEnabled', true);
    return $pdf->stream('Lista_Facultad_Activas.pdf');
  }

  /////PDF Lista de facultades
public function pdflistaFacultadesI(){
        $user=user::all();
        $facultades=Facultad::all();
        
    /*return view("ues.facultades.listaFacI",array('user'=>$user,'facultades'=>$facultades));

    $pdf = App::make('dompdf.wrapper');
    $view =  \View::make('ues.facultades.listaFacI', compact('user','facultades'))->render();
    $pdf->loadHTML($view)->setPaper('portrait');
    return $pdf->stream('listado_Facultades_Inacivas'.'pdf'); */

    $pdf=\PDF::loadview('ues.facultades.listaFacI',  array('user' =>$user, 'facultades' => $facultades))->setPaper('letter','landscape');
    return $pdf->stream('Lista_Facultad_Inactivas.pdf');
        // return $pdf->download('listado de docentes.pdf'); Paper orientation ('portrait' or 'landscape') //Estas son tus opciones
}

}
