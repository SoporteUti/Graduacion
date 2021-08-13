<?php

namespace sispg\Http\Requests;

use sispg\Http\Requests\Request;

class GrupoFormRequest extends Request
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

          'tema'=>'required',
          // 'tema'=>'required | max:1024 |regex:/^([ a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([ a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'codigoG'=>'required | max:11',
            'idtipoT'=>'required' ,
            //'idtipoA'=>'required' ,
            'fecharegistro'=>'required',
            /*'propuesta'=>'required',*/
            
            
           

        ];
    }
}
