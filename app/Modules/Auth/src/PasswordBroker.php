<?php

namespace Minix\Auth;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Minix\Auth\Models\User;
use Minix\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class PasswordBroker
{
    /**
     * The database table name.
     *
     * @var string
     */
    static $table = 'password_resets';

    /**
     * Creates the password reset record in the database and sends the reset link to the user's
     * email.
     *
     * @param User $user
     */
    public function sendResetLink($user)
    {
        $token = $this->create($user->email);

        $user->notify(new ResetPasswordNotification($token));
    }

    /**
     * Attempts to find the password reset record, deletes it and resets the user's password. If
     * the record cannot be found or deleted it, the function will return false.
     *
     * @param User   $user
     * @param string $password
     * @param string $token
     *
     * @return bool
     */
    public function reset($user, $password, $token)
    {
        if (!($this->exists($user->email, $token) && $this->delete($user->email))) {
            return false;
        }

        $user->password = $password;
        $user->save();

        return true;
    }

    /**
     * Checks if the email and token pair record exists in the database and that it hasn't expired.
     *
     * @param string $email
     * @param string $token
     *
     * @return bool
     */
    public function exists($email, $token)
    {
        $token = (array) $this->getTable()->where('email', $email)->where('token', $token)->first();

        return $token && (!$this->hasTokenExpired($token));
    }

    /**
     * Creates a new password reset token and overwrites the existing record.
     *
     * @param string $email
     *
     * @return string
     */
    private function create($email)
    {
        $this->delete($email);

        $token = $this->createNewToken();

        $this->getTable()->insert($this->getPayload($email, $token));

        return $token;
    }

    /**
     * Checks if a given password reset record has expired.
     *
     * @param array $token
     *
     * @return bool
     */
    private function hasTokenExpired($token)
    {
        $expiresAt = Carbon::parse($token['created_at'])->addSeconds((60 * 60));

        return $expiresAt->isPast();
    }

    /**
     * Deletes an existing password reset record.
     *
     * @param string $email
     *
     * @return bool
     */
    private function delete($email)
    {
        return $this->getTable()->where('email', $email)->delete();
    }

    /**
     * Gets the password reset payload.
     *
     * @param string $email
     * @param string $token
     *
     * @return array
     */
    private function getPayload($email, $token)
    {
        return ['email' => $email, 'token' => $token, 'created_at' => new Carbon()];
    }

    /**
     * Creates a new random password reset token.
     *
     * @return string
     */
    private function createNewToken()
    {
        return hash_hmac('sha256', Str::random(40), env('APP_KEY'));
    }

    /**
     * Get the database table to begin a query.
     *
     * @return Builder
     */
    private function getTable()
    {
        return DB::table(self::$table);
    }
}
