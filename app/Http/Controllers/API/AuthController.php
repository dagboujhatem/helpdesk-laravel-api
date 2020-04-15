<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Auth;
use Carbon\Carbon;

class AuthController extends AppBaseController
{

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $personalAccessTokenResult = $user->createToken('Help Desk REST API');
            $token = $personalAccessTokenResult->accessToken;
            $expiration = $personalAccessTokenResult->token->expires_at;
            $role = $user->getRoleNames()[0];
            $responseArray = [
            'role' => $role,
            'avatar' => $user->photo,
            'token_type' => 'Bearer',
            'expires_at' => $expiration,
            'access_token' => $token,
            ];

            return $this->sendResponse($responseArray, 'User authenticated successfully.');
        }
        else{
            return $this->sendError('The user credentials were incorrect.',401);
        }
    }

    public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();
        $accessToken->revoke();
        return $this->sendSuccess('Successfully logout.');
    }


}
