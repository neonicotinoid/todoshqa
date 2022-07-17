<?php

namespace App\Listeners;

use App\Events\UserPasswordChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPasswordUpdateNotification
{
    public function handle(UserPasswordChanged $event)
    {
        $event->user->sendPasswordChangedNotification();
    }
}
