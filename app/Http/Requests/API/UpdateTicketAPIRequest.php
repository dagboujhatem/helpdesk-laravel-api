<?php

namespace App\Http\Requests\API;

use App\Ticket;
use InfyOm\Generator\Request\APIRequest;

class UpdateTicketAPIRequest extends APIRequest
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
            'objet' => 'required',
            'element' => 'required',
            'nom' => 'required',
            'date_d_ouverture' => 'required',
            'date_d_echeance' => 'required',
            'categorie' => 'required',
            'impact' => 'required',
            'etat' => 'required',
            'lieu' => 'required',
            'description' => 'required',
        ];
    }
}
