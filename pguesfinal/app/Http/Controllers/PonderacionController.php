<?php

namespace sispg\Http\Controllers;

use Illuminate\Http\Request;

use sispg\Http\Requests;
use sispg\Http\Requests\PonderacionRequest;
use sispg\Ponderacion;

class PonderacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PonderacionRequest $request)
    {
        $etapas = $request['etapas'];
        $sum=0;
        foreach ($etapas as $etapa) {
            $sum+=$etapa['porcentaje'];
        }

        if($sum == 100){
            foreach ($etapas as $etapa) {
                $ponderacion=Ponderacion::find($etapa['idponderacion']);
                $ponderacion->porcentaje=$etapa['porcentaje'];
                $ponderacion->save();
                $ponderacion=null;
            }

            $notificacion = array(
                'message' => 'Las ponderaciones de la etapa se han registrado con éxito.', 
                'alert-type' => 'info'
            );
        }else{
            $notificacion = array(
                'message' => 'Las ponderaciones de la etapa deben tener un total del 100%.', 
                'alert-type' => 'error'
            );
        }

       return redirect()->back()->with($notificacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
