<?php

/**
 * CustomVerifyEmail paziņojuma klase nodrošina pielāgotu
 * e-pasta verifikācijas ziņojuma nosūtīšanu lietotājiem.
 *
 * Klase atbild par:
 * - e-pasta verifikācijas saites ģenerēšanu;
 * - pielāgota e-pasta virsraksta izveidi;
 * - Markdown e-pasta veidnes izmantošanu;
 * - lietotāja datu nodošanu e-pasta veidnei.
 */

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    /**
     * Izveido pielāgotu e-pasta verifikācijas ziņojumu.
     */
    public function toMail($notifiable): MailMessage
    {
        /**
         * Tiek ģenerēta unikāla e-pasta verifikācijas saite.
         */
        $verificationUrl = $this->verificationUrl($notifiable);

        /**
         * Tiek izveidots un atgriezts e-pasta ziņojums,
         * izmantojot Markdown e-pasta veidni.
         */
        return (new MailMessage)
            ->subject('Apstiprini savu e-pastu | Vecmāmiņas Receptes')
            ->markdown('emails.verify-email', [
                'verificationUrl' => $verificationUrl,
                'userName' => $notifiable->name,
            ]);
    }
}