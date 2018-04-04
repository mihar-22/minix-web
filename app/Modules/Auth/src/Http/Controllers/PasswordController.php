<?php

namespace Minix\Auth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Minix\Auth\Http\Requests\ResetPassword as ResetPasswordRequest;
use Minix\Auth\Http\Requests\SendPasswordResetLink as SendPasswordResetLinkRequest;
use Minix\Auth\Models\User;
use Minix\Auth\Password\PasswordBroker;
use Minix\Http\Controllers\Controller;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests. It handles sending the
    | reset link email and resetting the password.
    |
    */

    /**
     * @var User
     */
    private $users;

    /**
     * @var PasswordBroker
     */
    private $broker;

    /**
     * @param User           $users
     * @param PasswordBroker $broker
     */
    public function __construct(User $users, PasswordBroker $broker)
    {
        $this->users = $users;
        $this->broker = $broker;
    }

    /**
     * Sends a password reset link to the user's email.
     *
     * @param SendPasswordResetLinkRequest $request
     *
     * @return JsonResponse
     */
    protected function sendResetLink(SendPasswordResetLinkRequest $request)
    {
        $user = $this->users->whereEmail($request->email)->first();

        $this->broker->sendResetLink($user);

        return response()->json()->setStatusCode(200);
    }

    /**
     * Resets the user's password.
     *
     * @param ResetPasswordRequest $request
     *
     * @return JsonResponse
     */
    protected function resetPassword(ResetPasswordRequest $request)
    {
        $user = $this->users->whereEmail($request->email)->first();

        if (!$this->broker->reset($user, $request->password, $request->token)) {
            return response()->error(
                'password_reset_failed',
                'There is no pending password reset matching the request, or it has expired.'
            )->setStatusCode(400);
        }

        return response()->json()->setStatusCode(200);
    }
}
