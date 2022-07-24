<?php

namespace App\Listeners;

use App\Events\UserPasswordChanged;

class SendPasswordUpdateNotification
{
    public function handle(UserPasswordChanged $event)
    {
        $event->user->sendPasswordChangedNotification();
    }
}
