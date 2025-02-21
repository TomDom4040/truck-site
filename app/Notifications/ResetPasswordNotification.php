<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class ResetPasswordNotification extends Notification
{   protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function toMail($notifiable)
    {
        $url = URL::route('reset-password', ['token' => $this->token]);

        return (new MailMessage)
            ->subject('Сброс пароля')
            ->line('Вы получили этот email, потому что мы получили запрос на сброс пароля для вашей учётной записи.')
            ->action('Сбросить пароль', $url)
            ->line('Если вы не запрашивали сброс пароля, просто проигнорируйте это сообщение.');
    }
}
