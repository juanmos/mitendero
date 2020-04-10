<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Support\Facades\URL;
use Config;

class VerifyEmail extends VerifyEmailNotification
{
    protected function verificationUrl($notifiable)
    {
        return Config::get('app.url').'email/verify?' . http_build_query(
            [
                'verifyLink' => URL::temporarySignedRoute(
                    'verification.verify',
                    Carbon::now()->addMinutes(Config::get('auth.verification.expire', 120)),
                    [
                        'id' => $notifiable->getKey(),
                        'hash' => sha1($notifiable->getEmailForVerification()),
                    ]
                )
            ]
        );
    }
}
