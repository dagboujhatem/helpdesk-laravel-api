<?php

namespace App\Http\Controllers\API;

use App\Notifications\PasswordResetRequest;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class PasswordResetController extends AppBaseController
{
    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/forgot-password",
     *      summary="User forgot password",
     *      tags={"User"},
     *      description="User forgot password",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User e-mail address",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="email",
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
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function forgotPassword(Request $request)
    {
        // request validate
        $request->validate([
            'email' => 'required|string|email',
        ]);

        // find user by e-mail address
        $user = User::where('email', $request->email)->first();
        if (!$user)
        {
            return $this->sendError('Nous ne pouvons pas trouver un utilisateur avec cette adresse e-mail!',
                400);
        }

        // create a token and send the mail
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => str_random(60)
             ]);

        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        // Return the JSON response
        return $this->sendSuccess(__('reset_password_request.successResponse'));
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/reset-password",
     *      summary="User reset password",
     *      tags={"User"},
     *      description="User reset password",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User reset password data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="token",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="newPassword",
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
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function resetPassword(Request $request)
    {

    }
}
