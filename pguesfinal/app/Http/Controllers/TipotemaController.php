<?php
    namespace sispg\Http\Controllers;


    use DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Input;
    use Illuminate\Support\Facades\Redirect;
    use Response;
    use Validator;
    use sispg\Http\Requests;
    use sispg\Http\Requests\TipotemaFormRequest;
    use sispg\TipoTema;
    use sispg\Poderacion;
    use sispg\nuevaetapa;
    use sispg\Carrera;

    class TipotemaController extends Controller
    {

    public function __construct(){


    }

    protected $rules =
    [
        'tema' => 'required|min:2|max:256|regex:/^[a-z ,.\'-]+$/i',
       
       
    ];

    public function index(Request $request){


        $ttemas=TipoTema::join('carreras','tipotemas.idcarrera','=','carreras.idcarrera')
        ->select('tema','carreras.idcarrera','idtipotema','tipotemas.condicion','carreras.nombre')
        ->get();
        //dd($ttemas);
        $etapas = nuevaetapa::all();
        $carrera=Carrera::all();
    	if($request){
    		$query=trim($request->get('searchText'));
    		$ttemas=TipoTema::join('carreras','tipotemas.idcarrera','=','carreras.idcarrera')
        ->select('tema','carreras.idcarrera','idtipotema','tipotemas.condicion','carreras.nombre')
        ->get();
    		return view('ues.tipoTemas.index',["ttemas"=>$ttemas,"searchText"=>$query])
        ->with('etapas',$etapas)
        ->with('carrera',$carrera);
    	}
    }

 

    public function create(){


    	return  view("ues.carreras.create");
    }

    public function store(TipotemaFormRequest $request){


    	$ttemas=new TipoTema;

    	$ttemas->tema=$request->get('tema');
        $ttemas->idcarrera=$request->get('idcarrera');
    	$ttemas->condicion=1;
    	$ttemas->save();
            $notificacion = array(
            'message' => 'El Tipo de Proceso de Graduación se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }

    public function show($id){

    	return view("ues.tipoTemas.show",["ttemas"=>TipoTema::findOrFail($id)]);
    }

    public function edit($id){
    	return view("ues.tipoTemas.edit",["ttemas"=>TipoTema::findOrFail($id)]);

    }

    public function update(TipotemaFormRequest $request, $id){

    	$ttemas=TipoTema::findOrFail($id);
        $ttemas->tema=$request->get('tema'); 
        $ttemas->idcarrera=$request->get('idcarrera');    
    	$ttemas->condicion=true;

    	$ttemas->update();

         $notificacion = array(
            'message' => 'El Tipo de Proceso de Graduación se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/tipoTemas')->with($notificacion);
    

    }


    public function destroy($id){

    	$ttemas=TipoTema::findOrFail($id);
        if ($ttemas->condicion==false) {
            $ttemas->condicion=true;

  $notificacion = array(
            'message' => 'El Tipo de Proceso de Graduación se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $ttemas->condicion=false;
              $notificacion = array(
            'message' => 'El Tipo de Proceso de Graduación se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$ttemas->update();
       
    	return Redirect::to('ues/tipoTemas')->with($notificacion);;

    }

    }
