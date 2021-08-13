<?php
    namespace sispg\Http\Controllers;

    use Illuminate\Http\Request;

    use sispg\Http\Requests;
    use sispg\Actividad;
    use Illuminate\Support\Facades\Redirect;
    use sispg\Http\Requests\ActividadFormRequest;
    use DB;
    use Validator;
    use sispg\Enunciado;
    use sispg\Solicitud;
    use sispg\Rol;
    use Illuminate\Support\Facades\Input;
    use Response;
    use sispg\Utils\UtilFunctions;
    class solisController extends Controller
    {

    public function __construct()
    {
        $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR']);
    }


    protected $rules =
    [
        'nombre' => 'required|min:2|max:75|regex:/^[a-z ,.\'-]+$/i',
       
       
    ];

    public function index(Request $request){


        $solicitud=Solicitud::all();
        $rol=Rol::all();
    	if($request){
    		$query=trim($request->get('searchText'));
    		$enunciado=DB::table('enunciado')->where('enunciado','LIKE','%'.$query.'%')          
    		->orderBy('idsolicitud','asc')
    		->paginate(60);
    		return view('ues.solis.index',["enunciado"=>$enunciado,"searchText"=>$query,"solicitud"=>$solicitud,"rol"=>$rol]);
    	}
    }

 

    public function create(){


    	return  view("ues.solis.create");
    }

    public function store(){


    
    }

    public function show($id){

    	return view("ues.solis.show",["enunciado"=>Enunciado::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.solis.edit",["enunciado"=>Enunciado::findOrFail($id)]);

    }

    public function update(Request $request, $id){

    	$enunciado=Enunciado::findOrFail($id);

        $enunciado->enunciado=$request->input('enunciado'); 
        $enunciado->update();        
         $notificacion = array(
            'message' => 'La Solicitud se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/solis')->with($notificacion);
    

    }


    public function destroy($id){

    	

    }

    }
