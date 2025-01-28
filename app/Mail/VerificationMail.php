<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use SerializesModels;

    public $verificationCode;

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->view('emails.verify') // Указываем путь к view для письма
                    ->with([
                        'verificationCode' => $this->verificationCode,
                    ])
                    ->subject('Код подтверждения вашего email');
    }
}
