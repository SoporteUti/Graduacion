<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
    use sispg\Categoria;
    use Illuminate\Support\Facades\Redirect;
    use sispg\Http\Requests\categoriasFormRequest;
    use DB;
    use Validator;
    use Illuminate\Support\Facades\Input;
    use Response;
    use sispg\Utils\UtilFunctions;

class categoriasController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
        UtilFunctions::authorizeRoles(['ADMINISTRADOR']);
    }
    
	public function index(Request $request){


        $categoria=Categoria::all();

    	if($request){
    		$query=trim($request->get('searchText'));
    		$categoria=DB::table('categorias')->where('nombrecat','LIKE','%'.$query.'%')          
    		->orderBy('idcategoria','desc')
    		->paginate(60);
    		return view('ues.categorias.index',["categoria"=>$categoria,"searchText"=>$query]);
    	}
    }


    public function create(){


    	return  view("ues.categorias.create");
    }


    public function store(categoriasFormRequest $request){


    	$categoria=new Categoria;

    	$categoria->nombrecat=$request->get('nombrecat');
    	$categoria->condicion=1;
    	$categoria->save();
            $notificacion = array(
            'message' => 'La categoria docente se ha registrado con éxito.', 
            'alert-type' => 'info'
        );

       return redirect()->back()->with($notificacion);

    }


    public function show($id){

    	return view("ues.categorias.show",["categoria"=>Categoria::findOrFail($id)]);
    }

    public function edit($id){

    	return view("ues.categorias.edit",["categoria"=>Categoria::findOrFail($id)]);

    }


public function update(categoriasFormRequest $request, $id){

    	$categoria=Categoria::findOrFail($id);
        $categoria->nombrecat=$request->get('nombrecat');     
    	$categoria->condicion=true;
    	$categoria->update();

         $notificacion = array(
            'message' => 'La categoria docente se ha modificado con éxito.', 
            'alert-type' => 'info'          
        );
         return redirect::to('ues/categorias')->with($notificacion);
    

    }


    public function destroy($id){

    	$categoria=Categoria::findOrFail($id);
        if ($categoria->condicion==false) {
            $categoria->condicion=true;

  $notificacion = array(
            'message' => 'La categoria docente se ha Dado de Alta.', 
            'alert-type' => 'info'
        );


        }else{
            $categoria->condicion=false;
              $notificacion = array(
            'message' => 'La categoria docente se ha Dado de Baja.', 
            'alert-type' => 'info'
        );
        }
    	
    	$categoria->update();
       
    	return Redirect::to('ues/categorias')->with($notificacion);;

    }

    }
