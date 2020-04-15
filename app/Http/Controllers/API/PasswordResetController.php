<?php

namespace App\Http\Controllers\API;

use App\Notifications\PasswordResetRequest;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class PasswordResetController extends AppBaseController
{
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
            return $this->sendError('We can\'t find a user with that e-mail address.',404);
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
        return $this->sendSuccess('We have e-mailed your password reset link!');
    }

    public function resetPassword(Request $request)
    {

    }
}
