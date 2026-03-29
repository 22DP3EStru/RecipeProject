<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Apstiprini savu e-pastu | Vecmāmiņas Receptes')
            ->markdown('emails.verify-email', [
                'verificationUrl' => $verificationUrl,
                'userName' => $notifiable->name,
            ]);
    }
}