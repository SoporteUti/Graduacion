<?php
    namespace sispg\Http\Controllers;

    use Illuminate\Http\Request;

    use sispg\Http\Requests;
    use sispg\Carrera;
    use sispg\Departamento;
    use Illuminate\Support\Facades\Redirect;
    use sispg\Http\Requests\CarreraFormRequest;
    use DB;
    use Validator;
    use Illuminate\Support\Facades\Input;
    use Response;
    use sispg\Utils\UtilFunctions;
    use sispg\Bitacora;
    use sispg\Facultad;
    use sispg\Persona;
    use sispg\Docente;
    use sispg\User;
    use Auth;

    class CarreraController extends Controller
    {

         public function __construct()
    {
        $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR']);
    }
    

    protected $rules =
    [
        'nombre' => 'required|min:2|max:32|regex:/^[a-z ,.\'-]+$/i',
        'codigo' => 'required|min:2|max:32|regex:/^[a-z ,.\'-]+$/i',
       
    ];

    public function index(Request $request){


        $departamento=Departamento::all();

    	if($request){
    		$query=trim($request->get('searchText'));
    		$carreras=DB::table('carreras')->where('nombre','LIKE','%'.$query.'%')
            ->where('codigo','LIKE','%'.$query.'%')
            
    		->orderBy('idcarrera','desc')
    		->paginate(60);
    		return view('ues.carreras.index', compact('departamento'),["carreras"=>$carreras,"searchText"=>$query]);
    	}
    }

    public function create(){


    	return  view("ues.carreras.create");
    }

    public function store(CarreraFormRequest $request){


    	$carrera=new Carrera;
      $date = new \DateTime();
    	$carrera->nombre=$request->get('nombre');
    	$carrera->codigo=$request->get('codigo');
    	$carrera->iddepartamento=$request->get('iddep');//$request->get('iddep');
    	$carrera->condicion=1;
    	$carrera->save();

      ////bitacora/////////
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Registró una nueva Carrera";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Código: ".$carrera->codigo." , "." Nombre: ".$carrera->nombre;
        $bitacora->save();
        ////bitacora/////////
            $notificacion = array(
            'message' => 'La Carrera se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

    public function show($id){

    	return view("ues.carreras.show",["carrera"=>Carrera::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.carreras.edit",["carrera"=>Carrera::findOrFail($id)]);

    }

    public function update(CarreraFormRequest $request, $id){

    	$carrera=Carrera::findOrFail($id);
        $carrera->codigo=$request->get('codigo');
    	$carrera->nombre=$request->get('nombre');
    	$carrera->iddepartamento=$request->get('departamento');
        
    	$carrera->condicion=true;
      ////bitacora/////////
      $date = new \DateTime();
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Editó una Carrera";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->datos="Código: ".$carrera->codigo." , "." Nombre: ".$carrera->nombre;
        $bitacora->save();
        ////bitacora/////////
    	$carrera->update();

         $notificacion = array(
            'message' => 'La Carrera se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/carreras')->with($notificacion);
    

    }

    /*--Valida Codigo Carrera--*/
   public function postCodigoCaValid(Request $request)
   {

       $id=$request->input('id');
      
       if(isset($id)){
             $usuR=$request->input('codigo');
             $isAvailable=true;
             $resultado = Carrera::where('codigo','=',$usuR)->where('id','!=',$id)->count();
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
       $resultado = Carrera::where('codigo','=',$usuR)->count();
       if($resultado==1){
       $isAvailable=false;
       }
       echo json_encode(array(
       'valid' => $isAvailable,
       ));

       }        
   }


   /*--Valida Nombre Carrera--*/
   public function postNombreCaValid(Request $request)
   {

       $id=$request->input('id');
      
       if(isset($id)){
             $usuR=$request->input('nombre');
             $isAvailable=true;
             $resultado = Carrera::where('nombre','=',$usuR)->where('id','!=',$id)->count();
                if($resultado==1){
                     $isAvailable=false;
                 }
            echo json_encode(array(
            'valid' => $isAvailable,
       ));
     
       }
       else{
       $usuR=$request->input('nombre');
       $isAvailable=true;
       $resultado = Carrera::where('nombre','=',$usuR)->count();
       if($resultado==1){
       $isAvailable=false;
       }
       echo json_encode(array(
       'valid' => $isAvailable,
       ));

       }        
   }


    public function destroy($id)
    {

    	$carrera=Carrera::findOrFail($id);
      $carrera->motivo=Input::get('motivo');
      $carrera->fechadebaja=Input::get('fechadebaja');
      $carrera->acuerdoBaja=Input::get('acuerdoBaja');
        if ($carrera->condicion==false) {
            $carrera->condicion=true;

  $notificacion = array(
            'message' => 'La Carrera se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $carrera->condicion=false;
              $notificacion = array(
            'message' => 'La Carrera se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$carrera->update();
       
    	return Redirect::to('ues/carreras')->with($notificacion);;

    }

    /////PDF Lista de Carreras
public function pdflistaCarreras(){
 // $persona=Persona::findOrFail($id); 
    
        $carreras=Carrera::all();
        $user=user::all();
        $departamento=Departamento::all();
       

        $pdf=\PDF::loadview('ues.carreras.listaCar',  array('user'=>$user,'departamento'=>$departamento,'carreras'=>$carreras))->setPaper('letter','portrait');          return $pdf->stream('Lista_Carrreras_Activas.pdf');

}

 /////PDF Lista de Carreras
public function pdflistaCarrerasI(){
 // $persona=Persona::findOrFail($id); 
    
        $carreras=Carrera::all();
        $user=user::all();
        $departamento=Departamento::all();
       

        $pdf=\PDF::loadview('ues.carreras.listaCarI',  array('user'=>$user,'departamento'=>$departamento,'carreras'=>$carreras))->setPaper('letter','portrait');
          return $pdf->stream('Lista_Carrreras_Inactivas.pdf');

}

    }
