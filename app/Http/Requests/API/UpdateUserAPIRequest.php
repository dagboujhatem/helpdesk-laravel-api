<?php

namespace App\Http\Requests\API;

use App\User;
use InfyOm\Generator\Request\APIRequest;

class UpdateUserAPIRequest extends APIRequest
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
            'identifiant' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|max:255|unique:users,email,'. $this->id .',id',
            'cin' => 'required',
            'telephone' => 'required',
            'adresse' => 'required',
            'departement' => 'required',
            'lieu_de_travail' => 'required',
            'date_d_embauche' => 'required',
            'role' => 'required'
        ];
    }
}
