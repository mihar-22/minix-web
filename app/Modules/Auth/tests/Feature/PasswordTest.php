<?php


namespace Minix\Auth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Minix\Auth\Models\User;
use Minix\Auth\Password\PasswordBroker;
use Tests\MailTrap;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    /**
     * @var MailTrap
     */
    private $mailer;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->mailer = new MailTrap();
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->mailer->cleanInbox();
    }

    /** @test */
    public function i_can_request_a_password_reset_link()
    {
        $this->requestPasswordResetLink()
            ->assertJson([])
            ->assertStatus(200);

        $this->assertDatabaseHas(PasswordBroker::$table, ['email' => $this->user->email]);

        $this->mailer->fetchMostRecentMail()
            ->assertSentTo($this->user->email)
            ->assertSubjectIs('Reset Password')
            ->assertBodyContains($this->getPasswordResetLink());
    }

    /** @test */
    public function i_can_reset_my_password()
    {
        $this->requestPasswordResetLink();

        $token = $this->getPasswordResetToken();

        $this->requestPasswordReset($token, 'new_secret')
            ->assertJson([])
            ->assertStatus(200);

        $this->assertDatabaseMissing(PasswordBroker::$table,
            ['email' => $this->user->email, 'token' => $token]
        );

        $this->assertFalse(Auth::guard('web')->attempt([
            'email' => $this->user->email,
            'password' => 'secret',
        ]));

        $this->assertTrue(Auth::guard('web')->attempt([
            'email' => $this->user->email,
            'password' => 'new_secret',
        ]));
    }

    /** @test */
    public function i_cannot_reset_my_password_with_an_invalid_email_and_token_pair()
    {
        $this->requestPasswordReset('invalid_token', 'new_secret')
            ->assertJson([
                'object' => 'error',
                'id' => 'password_reset_failed',
            ])
            ->assertStatus(400);

        $this->assertTrue(Auth::guard('web')->attempt([
            'email' => $this->user->email,
            'password' => 'secret',
        ]));

        $this->assertFalse(Auth::guard('web')->attempt([
            'email' => $this->user->email,
            'password' => 'new_secret',
        ]));
    }

    /**
     * @return TestResponse
     */
    private function requestPasswordResetLink()
    {
        return $this->postJson($this->getEndPoint('reset/send'), ['email' => $this->user->email]);
    }

    /**
     * @param string $token
     * @param string $newPassword
     *
     * @return TestResponse
     */
    private function requestPasswordReset($token, $newPassword)
    {
        return $this->postJson($this->getEndPoint('reset'), [
            'email' => $this->user->email,
            'token' => $token,
            'password' => $newPassword,
        ]);
    }

    /**
     * @param string $action
     *
     * @return string
     */
    private function getEndPoint($action)
    {
        return "api/v1/auth/password/{$action}";
    }

    /**
     * @return string
     */
    private function getPasswordResetLink()
    {
        $encodedEmail = urlencode($this->user->email);

        return "password/reset/{$encodedEmail}/{$this->getPasswordResetToken()}";
    }

    /**
     * @return string
     */
    private function getPasswordResetToken()
    {
        return DB::table(PasswordBroker::$table)
            ->where('email', $this->user->email)
            ->first()
            ->token;
    }
}