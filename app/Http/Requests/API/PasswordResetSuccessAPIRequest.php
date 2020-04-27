<?php

namespace App\Http\Requests\API;

use InfyOm\Generator\Request\APIRequest;

class PasswordResetSuccessAPIRequest extends APIRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required|string',
            'token' => 'required|string'
        ];
    }
}
