<?php

namespace sispg\Http\Requests;

use sispg\Http\Requests\Request;

class PonderacionRequest extends Request
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
            'idtipotrabajo'=>'required|integer',
            'etapas.*.idetapa'=>'required',
            'etapas.*.porcentaje'=>'required',

        ];
    }
}
