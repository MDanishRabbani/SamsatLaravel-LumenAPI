<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class AuthMail extends Mailable
{
    public $pin;

    public function __construct($pin)
    {
        $this->pin = $pin;
    }

    public function build()
    {
        return $this->view('emails.auth_pin')
                    ->with(['pin' => $this->pin])
                    ->subject('Your Login PIN');
    }
}
