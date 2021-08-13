<?php

namespace sispg\Http\Requests;

use sispg\Http\Requests\Request;

class FacultadFormRequest extends Request
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
            //estos son nombres no precisamente de campos de la base de datos
        //sino de los objetos del formulario que vamos a validar 
        //'codigo'=>'required | max:100',
        'nombre'=>'required | max:100',
       // 'decano'=>'required | max: 60',
        'telefono'=>'required | max: 9',
        'direccion'=>'required | max: 256',

        ];
    }
}
