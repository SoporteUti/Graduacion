<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\Bitacora;
use sispg\User;
use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use sispg\Utils\UtilFunctions;

class asesoriaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        
        UtilFunctions::authorizeRoles(['ADMINISTRADOR','ASESOR']);
    }


     public function store(){


    	$asesoria=new Asesoria;
      $date = new \DateTime();
        ////bitacora/////////
        $bitacora=new Bitacora;
        $bitacora->idusuario= Auth::user()->id;
        $bitacora->accion="Registró un control de asesoría";
        $bitacora->fecha=$date->format('d-m-Y h:i:s');
        $bitacora->save();
        ////bitacora/////////
             $notificacion = array(
            'message' => 'El control de asesoría se ha registrado con éxito.', 
            'alert-type' => 'info'
        );
            

       return redirect()->back()->with($notificacion);

    }


}
