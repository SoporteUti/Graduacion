<?php

namespace sispg\Http\Requests;

use sispg\Http\Requests\Request;

class solicitudCambioAsesorContaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['fechai'=>'required',
        'fechaf'=>'required',
        'codigo'=>'required',
        'razon'=>'required', 
            //
        ];
    }
}
