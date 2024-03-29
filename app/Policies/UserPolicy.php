<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $editable_user)
    {
        return ($user->id === $editable_user->id) ? Response::allow() : Response::deny('You can\'t edit this user profile.');
    }
}
