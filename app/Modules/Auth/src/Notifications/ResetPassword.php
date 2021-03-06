<?php

namespace Minix\Auth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->level('error')
            ->line(
                'You are receiving this email because we received a password reset request for '.
                'your account.'
            )
            ->action('Reset Password', url('password/reset', [$notifiable->email, $this->token]))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
