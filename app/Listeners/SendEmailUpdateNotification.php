<?php

namespace App\Listeners;

use App\Events\UserEmailChanged;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailUpdateNotification
{
    public function handle(UserEmailChanged $event)
    {
        $event->user->sendEmailVerificationNotification();
    }
}
