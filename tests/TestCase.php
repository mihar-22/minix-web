<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;
use Minix\Auth\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param User  $user
     * @param array $scopes
     *
     * @return $this
     */
    protected function actAs($user, $scopes = ['*'])
    {
        Passport::actingAs($user, $scopes);

        return $this;
    }
}
