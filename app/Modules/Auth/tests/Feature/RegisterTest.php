<?php

namespace Minix\Auth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Minix\Auth\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    /** @test */
    public function i_can_register()
    {
        $response = $this->requestRegistration();

        $newUser = User::all()->first();

        $this->assertNotEmpty($newUser->id);
        $this->assertStringStartsWith('usr_', $newUser->id);
        $this->assertTrue(Hash::check($this->user->password, $newUser->password));

        $response->assertJson([
            'object' => 'user',
            'data' => [
                'id' => $newUser->id,
                'name' => $newUser->name,
                'email' => $newUser->email,
            ],
        ])->assertStatus(201);
    }

    /**
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function requestRegistration()
    {
        $newUser = array_merge($this->user->toArray(), ['password' => $this->user->password]);

        return $this->postJson($this->getEndPoint('register'), $newUser);
    }

    /**
     * @param string $action
     *
     * @return string
     */
    private function getEndPoint($action)
    {
        return "api/v1/auth/{$action}";
    }
}
