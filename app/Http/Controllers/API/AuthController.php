<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\AuthUserAPIRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Auth;

class AuthController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/login",
     *      summary="User authentification",
     *      tags={"User"},
     *      description="User login",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User credentials",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="password",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *                  @SWG\Property(
     *                  property="data",
     *                      @SWG\Property(property="role", type="string"),
     *                      @SWG\Property(property="avatar",type="string"),
     *                      @SWG\Property(property="token_type",type="string"),
     *                      @SWG\Property(property="expires_at",type="string"),
     *                      @SWG\Property(property="access_token",type="string")
     *                  )
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function login(AuthUserAPIRequest $request){

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

            return $this->sendResponse($responseArray, 'L\'utilisateur s\'est authentifié avec succès.');
        }
        else{
            return $this->sendError('Ces identifiants ne correspondent pas à nos enregistrements. 
            SVP vérifier votre e-mail ou votre mot de passe.',401);
        }
    }
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/users/logout",
     *      summary="User logout",
     *      tags={"User"},
     *      description="User logout",
     *      produces={"application/json"},
     *
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();
        $accessToken->revoke();
        return $this->sendSuccess('Déconnexion réussie.');
    }


}
