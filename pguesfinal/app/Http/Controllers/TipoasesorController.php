<?php
    namespace sispg\Http\Controllers;

    use Illuminate\Http\Request;

    use sispg\Http\Requests;
    use sispg\TipoAsesor;
    use sispg\Carrera;
    use Illuminate\Support\Facades\Redirect;
    use sispg\Http\Requests\TipoasesorFormRequest;
    use DB;
    use Validator;
    use Illuminate\Support\Facades\Input;
    use Response;

    class TipoasesorController extends Controller
    {

    public function __construct(){


    }

    protected $rules =
    [
        'tipoasesor' => 'required|min:2|max:75|regex:/^[a-z ,.\'-]+$/i',
       
       
    ];

    public function index(Request $request){


        $tasesor=TipoAsesor::all();
        $carreras=Carrera::all();

    	if($request){
    		$query=trim($request->get('searchText'));
    		$tasesor=DB::table('tipoasesores')->where('tipoasesor','LIKE','%'.$query.'%')          
    		->orderBy('idtipoasesor','desc')
    		->paginate(60);
    		return view('ues.tipoAsesores.index',["carreras"=>$carreras,"tasesor"=>$tasesor,"searchText"=>$query]);
    	}
    }

 

    public function create(){


    	return  view("ues.tipoAsesores.create");
    }

    public function store(TipoasesorFormRequest $request){


    	$tasesor=new TipoAsesor;

    	$tasesor->tipoasesor=$request->get('tipoasesor');
        $tasesor->idcarrera=Input::get('idcarrera');
    	$tasesor->condicion=1;
    	$tasesor->save();
            $notificacion = array(
            'message' => 'El Tipo de Asesor se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

    public function show($id){

    	return view("ues.tipoTemas.show",["tasesor"=>TipoAsesor::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.tipoTemas.edit",["tasesor"=>TipoAsesor::findOrFail($id)]);

    }

    public function update(TipoasesorFormRequest $request, $id){

    	$tasesor=TipoAsesor::findOrFail($id);
        $tasesor->tipoasesor=$request->get('tipoasesor');      
    	$tasesor->condicion=true;

    	$tasesor->update();

         $notificacion = array(
            'message' => 'El Tipo de Asesor se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/tipoAsesores')->with($notificacion);
    

    }


    public function destroy($id){

    	$tasesor=TipoAsesor::findOrFail($id);
        if ($tasesor->condicion==false) {
            $tasesor->condicion=true;

  $notificacion = array(
            'message' => 'El Tipo de Asesor se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $tasesor->condicion=false;
              $notificacion = array(
            'message' => 'El Tipo de Asesor se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$tasesor->update();
       
    	return Redirect::to('ues/tipoAsesores')->with($notificacion);;

    }

    }
