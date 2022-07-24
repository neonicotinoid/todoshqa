<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Project $project): bool|Response
    {
        return ($project->user->id === $user->id || $project->users->contains($user->id)) ?
            Response::allow() :
            Response::deny('You can\'t view this project');
    }

    public function create(User $user): bool|Response
    {
        return auth()->user()->hasVerifiedEmail();
    }

    public function update(User $user, Project $project): bool|Response
    {
        return $user->id === $project->user->id;
    }

    public function delete(User $user, Project $project): bool|Response
    {
        return $user->id === $project->user->id;
    }

    public function share(User $user, Project $project): bool|Response
    {
        return $project->user->id === $user->id;
    }

    public function restore(User $user, Project $project): bool|Response
    {
        return $project->user->id === $user->id;
    }

    public function forceDelete(User $user, Project $project): bool|Response
    {
        return $project->user->id === $user->id;
    }
}
