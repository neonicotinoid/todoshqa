<?php

namespace App\Actions;

use App\Events\UserEmailChanged;
use App\Events\UserPasswordChanged;
use App\Models\User;
use Illuminate\Support\Arr;

class UpdateUserFromAttributesAction
{
    public function __invoke(User $user, array $attributes)
    {
        $user->fill($attributes)->save();

        if (Arr::exists($user->getChanges(), 'email')) {
            $user->markEmailAsUnverified();
            event(new UserEmailChanged($user));
        }

        if (Arr::exists($user->getChanges(), 'password')) {
            event(new UserPasswordChanged($user));
        }

        return $user;
    }
}
