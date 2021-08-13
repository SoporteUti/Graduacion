<?php

namespace sispg\Http\Requests;

use sispg\Http\Requests\Request;

class LoginFormRequest extends Request
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
            'email'=> 'bail|required',
            'password'=>'bail|required'
            
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'El Correo electronico es requerido.',
            'password.required'=>'La contraseña es requerida.',
            'email.bail'=>'El Correo electronico es requerido.',
            'password.bail'=>'La contraseña es requerida.'
        ];
    }
}
