<?php

namespace App\Http\Requests\API;

use App\CategorieMateriel;
use InfyOm\Generator\Request\APIRequest;

class UpdateCategorieMaterielAPIRequest extends APIRequest
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
        $rules = CategorieMateriel::$rules;
        
        return $rules;
    }
}
