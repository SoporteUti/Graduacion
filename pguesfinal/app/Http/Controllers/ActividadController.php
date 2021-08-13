<?php
    namespace sispg\Http\Controllers;

    use Illuminate\Http\Request;

    use sispg\Http\Requests;
    use sispg\Actividad;
    use Illuminate\Support\Facades\Redirect;
    use sispg\Http\Requests\ActividadFormRequest;
    use DB;
    use Validator;
    use Illuminate\Support\Facades\Input;
    use Response;
    use sispg\Utils\UtilFunctions;
    class ActividadController extends Controller
    {

    public function __construct()
    {
        $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR','JEFE DE DEPARTAMENTO',
            'COORDINADOR GENERAL','ASESOR','DIRECTOR GENERAL']);
    }


    protected $rules =
    [
        'nombre' => 'required|min:2|max:75|regex:/^[a-z ,.\'-]+$/i',
       
       
    ];

    public function index(Request $request){


        $actividad=Actividad::all();

    	if($request){
    		$query=trim($request->get('searchText'));
    		$actividad=DB::table('actividades')->where('nombre','LIKE','%'.$query.'%')          
    		->orderBy('nombre','asc')
    		->paginate(60);
    		return view('ues.actividades.index',["actividad"=>$actividad,"searchText"=>$query]);
    	}
    }

 

    public function create(){


    	return  view("ues.actividades.create");
    }

    public function store(ActividadFormRequest $request){


    	$actividad=new Actividad;

    	$actividad->nombre=$request->get('nombre');
    	$actividad->condicion=true;
    	$actividad->save();
            $notificacion = array(
            'message' => 'La actividad se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

    public function show($id){

    	return view("ues.Actividades.show",["actividad"=>Actividad::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.Actividades.edit",["actividad"=>Actividad::findOrFail($id)]);

    }

    public function update(ActividadFormRequest $request, $id){

    	$actividad=Actividad::findOrFail($id);
        $actividad->nombre=$request->get('nombre');      
    	$actividad->condicion=true;

    	$actividad->update();

         $notificacion = array(
            'message' => 'La actividad se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/actividades')->with($notificacion);
    

    }


    public function destroy($id){

    	$actividad=Actividad::findOrFail($id);
        if ($actividad->condicion==false) {
            $actividad->condicion=true;

  $notificacion = array(
            'message' => 'La actividad se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $actividad->condicion=false;
              $notificacion = array(
            'message' => 'La actividad se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$actividad->update();
       
    	return Redirect::to('ues/actividades')->with($notificacion);;

    }

    }
