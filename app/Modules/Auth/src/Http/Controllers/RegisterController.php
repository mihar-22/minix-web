<?php

namespace Minix\Auth\Http\Controllers;

use Minix\Auth\Http\Requests\RegisterUser as RegisterUserRequest;
use Minix\Auth\Http\Resources\User as UserResource;
use Minix\Auth\Models\User;
use Minix\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller registers new users to the application.
    |
    */

    /**
     * @var User
     */
    private $users;

    /**
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Register the user with the application.
     *
     * @param RegisterUserRequest $request
     *
     * @return UserResource
     */
    protected function register(RegisterUserRequest $request)
    {
        $user = $this->users->create($request->all());

        return new UserResource($user);
    }
}
