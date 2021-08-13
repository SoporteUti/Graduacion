<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use sispg\Http\Requests\departamentosFormRequest;
use DB;
use Validator;
use Response; 
use sispg\Utils\UtilFunctions;
use sispg\Facultad;
use sispg\Persona;
use sispg\Carrera;
use sispg\Docente;
use sispg\Departamento;
use sispg\Bitacora;
use sispg\User;
use Auth;
class departamentosController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR']);
    }
    
    public function index(Request $request ){
$facultades=Facultad::all();
			if($request){
    		$query=trim($request->get('searchText'));
    		$departamento=DB::table('departamentos')->where('nombre','LIKE','%'.$query.'%')
    		
    		->orderBy('nombre','asc')
    		->paginate();
    		return view('ues.departamentos.index',["departamento"=>$departamento,"searchText"=>$query], compact('facultades'));
    	}
    }




    public function show($id){

    	return view("ues.departamentos.show", ["departamento"=>departamento::findOrFail($id)]);
    }
    public function edit($id){
	return view("ues.departamentos.edit", ["departamento"=>departamento::findOrFail($id)]);
    	
    }
    public function create(){
        
return  view("ues.departamentos.create");
    	
    }
    public function destroy($id){

    	$departamento=Departamento::findOrFail($id);
      $count=0;
  $count+=count($departamento->carreras);
  //dd($count);

if ($count>0) {
   $notificacion = array(
            'message' => 'El Departamento tiene carreras activas', 
            'alert-type' => 'error'
        );
}
  else if($departamento->condicion==1){
            $departamento->condicion=0;

  $notificacion = array(
            'message' => 'El Departamento se ha Dado de baja.', 
            'alert-type' => 'info'
        );


        }

      else  if ($departamento->condicion==0) {
         $departamento->condicion=1;
              $notificacion = array(
            'message' => 'El Departamento se ha Dado de alta.', 
            'alert-type' => 'info'
        );
        }
           
        

        $departamento->update();

       return redirect()->back()->with($notificacion);
    }


    public function update(departamentosFormRequest $request,$id){
$date = new \DateTime();
    	$departamento=departamento::findOrFail($id);
    	$departamento->codigo=$request->get('codigo');
        $departamento->nombre=$request->get('nombre');
        $departamento->idfacultad=$request->get('facultad');
        $departamento->condicion=1;
    	$departamento->update();


         ////bitacora/////////
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Editó un Departamento";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Código: ".$departamento->codigo." , "." Nombre: ".$departamento->nombre;
        $bitacora->save();
        ////bitacora/////////
    	$notificacion = array(
            'message' => 'El Departamento se ha Actualizado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);
    }
    public function store(departamentosFormRequest $request){
$departamento=new departamento;
$date = new \DateTime();

    	$departamento->codigo=$request->get('codigo');
        $departamento->nombre=$request->get('nombre');
    	$departamento->idfacultad=$request->get('facultad');
    	$departamento->condicion=1;
    	$departamento->save();

        ////bitacora/////////
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Registró un nuevo Departamento";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Código: ".$departamento->codigo." , "." Nombre: ".$departamento->nombre;
        $bitacora->save();
        ////bitacora/////////


    	 $notificacion = array(
            'message' => 'El Departamento se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);
    	
    }


     /*--Valida Codigo depto--*/
   public function postCodigoDeptoValid(Request $request)
   {

       $id=$request->input('id');
      
       if(isset($id)){
             $usuR=$request->input('codigo');
             $isAvailable=true;
             $resultado = Departamento::where('codigo','=',$usuR)->where('id','!=',$id)->count();
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
       $resultado = Departamento::where('codigo','=',$usuR)->count();
       if($resultado==1){
       $isAvailable=false;
       }
       echo json_encode(array(
       'valid' => $isAvailable,
       ));

       }        
   }

   /////PDF Lista de Departamentos
public function pdflistaDepartamentos(){

        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all(); 
        
      //return view("ues.departamentos.listaDepto",array('user'=>$user,'departamento'=>$departamento,'facultades'=>$facultades));
          $pdf=\PDF::loadview('ues.departamentos.listaDepto',  array('user'=>$user,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Depto_Activos.pdf');

}
/////PDF Lista de Departamentos
public function pdflistaDepartamentosI(){

        $user=user::all();
        $departamento=Departamento::all();
        $facultades=Facultad::all(); 
        
      //return view("ues.departamentos.listaDepto",array('user'=>$user,'departamento'=>$departamento,'facultades'=>$facultades));
          $pdf=\PDF::loadview('ues.departamentos.listaDeptoI',  array('user'=>$user,'departamento'=>$departamento,'facultades'=>$facultades))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Depto_Inactivos.pdf');

}

}
