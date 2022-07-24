<?php

namespace App\Actions;

use App\Models\User;

class RemoveUserAvatarAction
{
    public function __invoke(User $user)
    {
        if ($user->hasMedia('avatar')) {
            $user->getFirstMedia('avatar')->delete();
        }
    }
}
