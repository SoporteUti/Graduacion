<?php

namespace sispg\Http\Requests;

use sispg\Http\Requests\Request;

class EstudianteFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'nombres'=>'required | max:100 |regex:/^([ a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([ a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'carnet'=>'required | max:100',
            'apellidos'=>'required | max:100 | regex:/^([ a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([ a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'sexo'=>'required' ,
            'correo'=>'required',
            'carrera'=>'required',
            'curriculum'=>'mimes:pdf| max:10000',
            'partida'=>'mimes:pdf| max:10000'

        ];
    }
}
